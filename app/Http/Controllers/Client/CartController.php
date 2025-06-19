<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

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

        if (!$cart || count($cart) == 0) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống.');
        }

        // Validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:500',
            'note' => 'nullable|string|max:1000',
        ]);

        DB::beginTransaction();
        try {
            // Tìm hoặc tạo khách hàng theo email
            $customer = \App\Models\Customer::firstOrCreate(
                ['email' => $request->email],
                [
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'address' => $request->address,
                ]
            );

            // Tạo đơn hàng mới
            $order = \App\Models\Order::create([
                'customer_id' => $customer->id,
                'note' => $request->note,
            ]);

            // Lưu từng sản phẩm trong giỏ hàng
            foreach ($cart as $productId => $item) {
                \App\Models\OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $productId,
                    'price'      => $item['price'],
                    'quantity'   => $item['quantity'],
                ]);
            }

            // Xoá giỏ hàng
            session()->forget('cart');
            DB::commit();

            return redirect()->route('home')->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            dd($e->getMessage()); // tạm thời để debug
            DB::rollBack();
            return redirect()->back()->with('error', 'Lỗi khi xử lý đơn hàng');
        }
    }
}
