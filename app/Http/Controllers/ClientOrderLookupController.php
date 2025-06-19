<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class ClientOrderLookupController extends Controller
{
    public function form()
    {
        return view('client.orders.lookup');
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string'
        ]);

        $input = $request->input('query'); // sửa tại đây

        $orders = Order::whereHas('customer', function ($q) use ($input) {
            $q->where('email', $input)
                ->orWhere('phone', $input);
        })
            ->with('customer', 'items.product')
            ->orderByDesc('created_at')
            ->get();

        return view('client.orders.lookup', compact('orders', 'input'));
    }
}
