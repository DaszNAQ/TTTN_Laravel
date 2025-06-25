<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Tổng số sản phẩm và đơn hàng
        $totalProducts = Product::count();
        $totalOrders = Order::count();

        // Tổng doanh thu từ đơn hàng hoàn tất (tính theo order_items)
        $totalRevenue = Order::where('status', 'completed')->with('items')->get()
            ->flatMap->items
            ->sum(fn($item) => $item->price * $item->quantity);

        // Doanh thu theo ngày (chỉ đơn completed)
        // $revenues = DB::table('orders')
        //     ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        //     ->select(DB::raw('DATE(orders.created_at) as day'), DB::raw('SUM(order_items.price * order_items.quantity) as revenue'))
        //     ->where('orders.status', 'completed')
        //     ->groupBy(DB::raw('DATE(orders.created_at)'))
        //     ->orderBy('day')
        //     ->get();

        // $chartLabels = $revenues->pluck('day')->map(fn($d) => Carbon::parse($d)->format('d/m'))->toArray();
        // $chartValues = $revenues->pluck('revenue')->toArray();

        return view('admin.dashboard', compact(
            'totalProducts', 'totalOrders', 'totalRevenue',
            // 'chartLabels', 'chartValues'
        ));
    }
}
