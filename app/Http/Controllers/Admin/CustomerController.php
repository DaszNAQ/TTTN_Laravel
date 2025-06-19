<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('id', 'ASC')->paginate(5);
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15|unique:customers',
            'email' => 'required|email|unique:customers',
            'address' => 'nullable|string',
        ]);

        Customer::create($request->only('name', 'phone', 'email', 'address'));

        return redirect()->route('admin.customers.index')->with('success', 'Đã thêm khách hàng thành công!');
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15|unique:customers,phone,'.$customer->id,
            'email' => 'required|email|unique:customers,email,'.$customer->id,
            'address' => 'nullable|string',
        ]);

        $customer->update($request->only('name', 'phone', 'email', 'address'));

        return redirect()->route('admin.customers.index')->with('success', 'Đã cập nhật khách hàng thành công!');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('admin.customers.index')->with('success', 'Đã chuyển khách hàng vào thùng rác!');
    }

    public function trash()
    {
        $customers = Customer::onlyTrashed()->orderBy('id', 'DESC')->paginate(10);
        return view('admin.customers.trash', compact('customers'));
    }

    public function restore($id)
    {
        $customer = Customer::onlyTrashed()->findOrFail($id);
        $customer->restore();
        return redirect()->route('admin.customers.trash')->with('success', 'Khôi phục thành công!');
    }

    public function forceDelete($id)
    {
        $customer = Customer::onlyTrashed()->findOrFail($id);
        $customer->forceDelete();
        return redirect()->route('admin.customers.trash')->with('success', 'Đã xoá vĩnh viễn!');
    }
}
