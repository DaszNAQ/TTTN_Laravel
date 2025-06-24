<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class ClientOrderLookupController extends Controller
{
    // Hiển thị danh sách đơn hàng của khách hàng đã đăng nhập
    public function form()
    {
        $customer = session('customer');
        if (!$customer) {
            return redirect()->route('customer.login')->with('error', 'Bạn cần đăng nhập để xem đơn hàng của mình.');
        }

        // Lấy tất cả đơn hàng của tài khoản đang đăng nhập
        $orders = Order::where('customer_id', $customer->id)
            ->with('items.product')
            ->orderByDesc('created_at')
            ->get();

        return view('client.orders.lookup', compact('orders'));
    }

    // Không cần hàm search nữa nếu dùng theo logic trên
}
