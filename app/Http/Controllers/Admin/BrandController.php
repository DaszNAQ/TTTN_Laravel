<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('id', 'ASC')->paginate(5);
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Brand::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.brands.index')->with('success', 'Đã thêm thương hiệu thành công!');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $brand->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.brands.index')->with('success', 'Đã cập nhật thương hiệu thành công!');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin.brands.index')->with('success', 'Đã chuyển thương hiệu vào thùng rác!');
    }

    public function trash()
    {
        $brands = Brand::onlyTrashed()->orderBy('id', 'DESC')->paginate(10);
        return view('admin.brands.trash', compact('brands'));
    }

    public function restore($id)
    {
        $brand = Brand::onlyTrashed()->findOrFail($id);
        $brand->restore();
        return redirect()->route('admin.brands.trash')->with('success', 'Khôi phục thành công!');
    }

    public function forceDelete($id)
    {
        $brand = Brand::onlyTrashed()->findOrFail($id);
        $brand->forceDelete();
        return redirect()->route('admin.brands.trash')->with('success', 'Đã xoá vĩnh viễn!');
    }
}
