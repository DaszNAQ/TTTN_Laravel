<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += 1;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
    }
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }
    // Hiển thị giỏ hàng
    public function index()
    {
        return view('client.cart.index');
    }

    // Xoá 1 sản phẩm khỏi giỏ
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Đã xoá sản phẩm khỏi giỏ hàng.');
    }
    // Cập nhật số lượng sản phẩm
    public function update(Request $request)
    {
        $cart = session()->get('cart', []);

        foreach ($request->quantities as $id => $quantity) {
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = max(1, (int) $quantity); // tối thiểu là 1
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Đã cập nhật giỏ hàng thành công.');
    }
    // Hiển thị form đặt hàng
    public function checkout()
    {
        if (!session('cart') || count(session('cart')) == 0) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống.');
        }
        return view('client.cart.checkout');
    }


    public function processCheckout(Request $request)
    {
        $cart = session('cart');

        // Nếu giỏ hàng trống
        if (!$cart || count($cart) == 0) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống.');
        }

        // Kiểm tra đăng nhập khách hàng
        $sessionCustomer = Session::get('customer');
        if (!$sessionCustomer) {
            return redirect()->route('customer.login')->with('error', 'Bạn cần đăng nhập để tiếp tục đặt hàng.');
        }

        // Validate dữ liệu đầu vào
        $request->validate([
            'name'           => 'required|string|max:255',
            'phone'          => 'required|string|max:20',
            'email'          => 'required|email|max:255',
            'address'        => 'required|string|max:500',
            'note'           => 'nullable|string|max:1000',
            'payment_method' => 'required|in:cod,vnpay,momo',
        ]);

        DB::beginTransaction();

        try {
            // Lấy thông tin customer từ session
            $customer = Customer::findOrFail($sessionCustomer->id);

            // Cập nhật lại thông tin nếu người dùng thay đổi
            $customer->update([
                'name'    => $request->name,
                'email'   => $request->email,
                'phone'   => $request->phone,
                'address' => $request->address,
            ]);

            // Tạo đơn hàng
            $order = Order::create([
                'customer_id'    => $customer->id,
                'note'           => $request->note,
                'payment_method' => $request->payment_method,
                'payment_status' => $request->payment_method === 'cod' ? 'pending' : 'paid',
            ]);

            // Lưu sản phẩm trong giỏ hàng vào order_items
            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $productId,
                    'price'      => $item['price'],
                    'quantity'   => $item['quantity'],
                ]);
            }

            // Xóa giỏ hàng sau khi đặt
            session()->forget('cart');
            DB::commit();

            // Nếu chọn VNPay thì chuyển hướng sang trang thanh toán
            if ($request->payment_method === 'vnpay') {
                return redirect()->route('vnpay.payment', ['order' => $order->id]);
            }

            // Nếu chọn Momo (giả lập)
            if ($request->payment_method === 'momo') {
                return redirect()->route('thankyou')->with('success', 'Đặt hàng bằng Momo (giả lập).');
            }

            // Nếu chọn COD thì chuyển về trang cảm ơn
            session()->flash('last_order_id', $order->id);
            return redirect()->route('thankyou')->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Lỗi khi xử lý đơn hàng: ' . $e->getMessage());
        }
    }



    public function handlePayment(Request $request)
    {
        $method = $request->payment_method;
        $order = Order::latest()->where('user_id', auth()->id())->first();

        if (!$order) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn hàng.');
        }

        $order->payment_method = $method;
        $order->payment_status = $method === 'cod' ? 'pending' : 'paid';
        $order->save();

        return redirect()->route('thankyou')->with('success', 'Thanh toán thành công!');
    }
}
