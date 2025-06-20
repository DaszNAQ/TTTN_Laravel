<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class PaymentController extends Controller
{
    public function createPayment($orderId)
    {
        $order = Order::with('items')->findOrFail($orderId);

        $vnp_Url = env('VNP_URL');
        $vnp_Returnurl = env('VNP_RETURN_URL');
        $vnp_TmnCode = env('VNP_TMN_CODE');
        $vnp_HashSecret = env('VNP_HASH_SECRET');

        $vnp_TxnRef = $order->id;
        $vnp_OrderInfo = 'Thanh Toan Don Hang Ma' . $order->id;
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $order->items->sum(fn($i) => $i->price * $i->quantity) * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = request()->ip();

        $inputData = [
            "vnp_Version"    => "2.1.0",
            "vnp_TmnCode"    => $vnp_TmnCode,
            "vnp_Amount"     => $vnp_Amount,
            "vnp_Command"    => "pay",
            "vnp_CreateDate" => now()->format('YmdHis'),
            "vnp_CurrCode"   => "VND",
            "vnp_IpAddr"     => $vnp_IpAddr,
            "vnp_Locale"     => $vnp_Locale,
            "vnp_BankCode"   => $vnp_BankCode,
            "vnp_OrderInfo"  => $vnp_OrderInfo,
            "vnp_OrderType"  => $vnp_OrderType,
            "vnp_ReturnUrl"  => $vnp_Returnurl,
            "vnp_TxnRef"     => $vnp_TxnRef,
        ];


        ksort($inputData);

        $hashData = implode('&', array_map(fn($k, $v) => "$k=$v", array_keys($inputData), $inputData));
        $vnp_SecureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $redirectUrl = $vnp_Url . '?' . $hashData . '&vnp_SecureHash=' . $vnp_SecureHash;

        // ✅ Đặt dd() ở đây!
        // dd([
        //     'hash_input_keys' => array_keys($inputData),
        //     'hash_input_full' => $hashData,
        //     'secure_hash' => $vnp_SecureHash,
        //     'redirect_url' => $redirectUrl,
        // ]);

        return redirect($redirectUrl);
    }

    public function vnpayReturn(Request $request)
    {
        $vnp_HashSecret = env('VNP_HASH_SECRET');
        $vnp_SecureHash = $request->vnp_SecureHash;

        $inputData = $request->except(['vnp_SecureHash', 'vnp_SecureHashType']);
        ksort($inputData);
        $hashData = implode('&', array_map(fn($k, $v) => "$k=$v", array_keys($inputData), $inputData));
        $checkHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        $orderId = $request->vnp_TxnRef;
        $order = Order::find($orderId);

        if (!$order) {
            return redirect()->route('home')->with('error', 'Không tìm thấy đơn hàng.');
        }

        if ($checkHash === $vnp_SecureHash && $request->vnp_ResponseCode === '00') {
            $order->payment_status = 'paid';
            $order->save();
            session()->flash('last_order_id', $order->id);
            return redirect()->route('thankyou')->with('success', 'Thanh toán VNPay thành công!');
        }

        return redirect()->route('home')->with('error', 'Thanh toán thất bại hoặc bị hủy.');
    }
}
