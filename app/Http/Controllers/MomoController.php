<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;

class MomoController extends Controller
{
    public function createPayment(Request $request)
    {
        $cart = Session::get('cart');
        $customer = Session::get('customer');
        $checkoutInfo = Session::get('checkout_info');

        if (!$cart || count($cart) == 0) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống.');
        }

        if (!$customer || !$checkoutInfo) {
            return redirect()->route('customer.login')->with('error', 'Bạn cần đăng nhập để thanh toán.');
        }

        DB::beginTransaction();
        try {
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            $order = Order::create([
                'customer_id' => $customer->id,
                'name' => $checkoutInfo['name'],
                'phone' => $checkoutInfo['phone'],
                'email' => $checkoutInfo['email'],
                'address' => $checkoutInfo['address'],
                'note' => $checkoutInfo['note'] ?? '',
                'payment_method' => $checkoutInfo['payment_method'] ?? 'momo',
                'payment_status' => 'pending',
                'status' => 'pending',
                'total_price' => $total,
            ]);

            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            // 🔑 Lấy thông tin MoMo từ config
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = config('momo.partner_code');
            $accessKey   = config('momo.access_key');
            $secretKey   = config('momo.secret_key');

            $orderInfo = "Thanh toán đơn hàng Mã: " . $order->id;
            $amount = $total;
            $orderId = $order->id . '_' . time();
            $redirectUrl = route('momo.result');
            $ipnUrl = route('momo.ipn');
            $extraData = (string)$order->id;
            $requestId = time() . "";
            $requestType = "payWithATM";

            $rawHash = "accessKey=$accessKey&amount=$amount&extraData=$extraData&ipnUrl=$ipnUrl&orderId=$orderId&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$redirectUrl&requestId=$requestId&requestType=$requestType";
            $signature = hash_hmac("sha256", $rawHash, $secretKey);

            $data = [
                'partnerCode' => $partnerCode,
                'partnerName' => "MoMoTest",
                'storeId' => "LaravelMoMo",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            ];

            Log::debug('🔍 Request gửi MoMo:', $data);

            DB::commit();
            Session::put('momo_order_id', $order->id);

            $response = Http::withHeaders(['Content-Type' => 'application/json'])
                ->post($endpoint, $data);

            Log::debug('🔍 MoMo Response:', $response->json());

            if (isset($response['payUrl'])) {
                return redirect($response['payUrl']);
            }

            return redirect('/')->with('error', 'Không thể khởi tạo thanh toán MoMo.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('MoMo Payment Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Lỗi khi khởi tạo thanh toán.');
        }
    }

    public function handleIPN(Request $request)
    {
        $data = $request->all();
        $secretKey = config('momo.secret_key');

        $rawHash = "accessKey={$data['accessKey']}&amount={$data['amount']}&extraData={$data['extraData']}&message={$data['message']}&orderId={$data['orderId']}&orderInfo={$data['orderInfo']}&orderType={$data['orderType']}&partnerCode={$data['partnerCode']}&payType={$data['payType']}&requestId={$data['requestId']}&responseTime={$data['responseTime']}&resultCode={$data['resultCode']}&transId={$data['transId']}";
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        if ($signature === $data['signature'] && $data['resultCode'] == 0) {
            $orderId = $data['extraData'];
            Order::where('id', $orderId)->update([
                'payment_status' => 'paid',
                'status' => 'confirmed'
            ]);
            Log::info('✅ MoMo IPN Success:', $data);
        } else {
            Log::warning('❌ MoMo IPN Failed:', $data);
        }

        return response('OK', 200);
    }

    public function showResult(Request $request)
    {
        $orderId = Session::pull('momo_order_id');
        Session::forget('cart');

        if (!$orderId) {
            return redirect()->route('home')->with('error', 'Không tìm thấy đơn hàng.');
        }

        return redirect()->route('home')->with('success', 'Thanh toán MoMo thành công! Mã đơn: ' . $orderId);
    }
}
