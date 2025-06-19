<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function index()
    {
        $orderItems = OrderItem::with('order', 'product')->orderBy('id', 'DESC')->paginate(10);
        return view('admin.order_items.index', compact('orderItems'));
    }

    public function create()
    {
        $orders = Order::all();
        $products = Product::all();
        return view('admin.order_items.create', compact('orders', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        OrderItem::create($request->only('order_id', 'product_id', 'quantity', 'price'));

        return redirect()->route('admin.order_items.index')->with('success', 'Đã thêm chi tiết đơn hàng thành công!');
    }

    public function edit(OrderItem $orderItem)
    {
        $orders = Order::all();
        $products = Product::all();
        return view('admin.order_items.edit', compact('orderItem', 'orders', 'products'));
    }

    public function update(Request $request, OrderItem $orderItem)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $orderItem->update($request->only('order_id', 'product_id', 'quantity', 'price'));

        return redirect()->route('admin.order_items.index')->with('success', 'Đã cập nhật chi tiết đơn hàng thành công!');
    }

    public function destroy(OrderItem $orderItem)
    {
        $orderItem->delete();
        return redirect()->route('admin.order_items.index')->with('success', 'Đã chuyển vào thùng rác!');
    }

    public function trash()
    {
        $orderItems = OrderItem::onlyTrashed()->with('order', 'product')->orderBy('id', 'DESC')->paginate(10);
        return view('admin.order_items.trash', compact('orderItems'));
    }

    public function restore($id)
    {
        $orderItem = OrderItem::onlyTrashed()->findOrFail($id);
        $orderItem->restore();
        return redirect()->route('admin.order_items.trash')->with('success', 'Khôi phục thành công!');
    }

    public function forceDelete($id)
    {
        $orderItem = OrderItem::onlyTrashed()->findOrFail($id);
        $orderItem->forceDelete();
        return redirect()->route('admin.order_items.trash')->with('success', 'Đã xoá vĩnh viễn!');
    }
}
