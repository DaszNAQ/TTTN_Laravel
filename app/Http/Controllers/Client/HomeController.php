<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; // Gọi model Product
use App\Models\Category; // Gọi model Category
use App\Models\Brand; // Gọi model Brand


class HomeController extends Controller
{
    public function index()
    {
        $latestProducts = Product::latest()->take(4)->get();
        $canonProducts = Product::whereHas('brand', fn($q) => $q->where('name', 'Canon'))->take(4)->get();
        $accessoryProducts = Product::whereHas('category', fn($q) => $q->where('name', 'Phụ kiện máy ảnh'))->take(4)->get();

        return view('client.index', compact(
            'latestProducts',
            'canonProducts',
            'accessoryProducts'
        ));
    }

    public function category($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->get();
        return view('client.category', compact('category', 'products'));
    }
    public function detail($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('client.product_detail', compact('product'));
    }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $products = Product::where('name', 'like', '%' . $keyword . '%')->get();
        return view('client.search_results', compact('products', 'keyword'));
    }
}
