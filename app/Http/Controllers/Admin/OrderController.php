<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('customer')->orderBy('id', 'ASC')->paginate(5);
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('admin.orders.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'note' => 'nullable|string',
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        Order::create([
            'customer_id' => $request->customer_id,
            'note' => $request->note,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.orders.index')->with('success', 'Đã thêm đơn hàng thành công!');
    }

    public function edit(Order $order)
    {
        $order->load('customer', 'items.product');
        return view('admin.orders.form', [
            'order' => $order,
            'customers' => Customer::all(),
            'readonly' => false,          // ← cho phép chỉnh sửa
            'editStatusOnly' => false     // ← cho phép chỉnh sửa toàn bộ
        ]);
    }


    public function update(Request $request, Order $order)
    {
        $data = $request->only(['status', 'customer_id', 'note']);

        if ($request->has('status') && !$request->has('customer_id')) {
            // Chỉ cập nhật trạng thái
            $request->validate([
                'status' => 'required|in:pending,processing,completed,cancelled',
            ]);
            $order->update(['status' => $request->status]);
        } else {
            // Cập nhật toàn bộ
            $request->validate([
                'customer_id' => 'required|exists:customers,id',
                'note' => 'nullable|string',
                'status' => 'required|in:pending,processing,completed,cancelled',
            ]);
            $order->update($data);
        }

        return redirect()->route('admin.orders.index')->with('success', 'Cập nhật đơn hàng thành công!');
    }


    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Đã chuyển đơn hàng vào thùng rác!');
    }

    public function trash()
    {
        $orders = Order::onlyTrashed()->with('customer')->orderBy('id', 'DESC')->paginate(10);
        return view('admin.orders.trash', compact('orders'));
    }

    public function restore($id)
    {
        $order = Order::onlyTrashed()->findOrFail($id);
        $order->restore();
        return redirect()->route('admin.orders.trash')->with('success', 'Khôi phục đơn hàng thành công!');
    }

    public function forceDelete($id)
    {
        $order = Order::onlyTrashed()->findOrFail($id);
        $order->forceDelete();
        return redirect()->route('admin.orders.trash')->with('success', 'Đã xoá đơn hàng vĩnh viễn!');
    }

    public function show(Order $order)
    {
        $order->load('customer', 'items.product');

        return view('admin.orders.form', [
            'order' => $order,
            'customers' => Customer::all(),
            'readonly' => true,
            'editStatusOnly' => true,
        ]);
    }
}
