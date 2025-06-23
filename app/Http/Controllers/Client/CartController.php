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
        $customer = session('customer');

        if (!$cart || count($cart) == 0) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống.');
        }

        if (!$customer) {
            return redirect()->route('customer.login')->with('error', 'Bạn cần đăng nhập để tiếp tục.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:500',
            'note' => 'nullable|string|max:1000',
            'payment_method' => 'required|in:cod,momo',
        ]);

        // Nếu chọn MoMo → chuyển sang route momo.pay
        if ($request->payment_method === 'momo') {
            // Lưu các thông tin vào session để sử dụng ở MomoController
            session([
                'checkout_info' => $request->only(['name', 'phone', 'email', 'address', 'note', 'payment_method']),
            ]);

            return redirect()->route('momo.pay');
        }

        // Xử lý cho COD (thanh toán khi nhận hàng)
        DB::beginTransaction();
        try {
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            $order = Order::create([
                'customer_id' => $customer->id,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'note' => $request->note,
                'payment_method' => 'cod',
                'payment_status' => 'unpaid',
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

            DB::commit();
            session()->forget('cart');
            return redirect()->route('home')->with('success', 'Đặt hàng thành công! Cảm ơn bạn.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi đặt hàng.');
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
