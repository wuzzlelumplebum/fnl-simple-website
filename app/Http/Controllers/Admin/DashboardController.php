<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Order, OrderItem, Product, ProductVariant, User, Review, News};
use App\Models\StockAlert;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $kpi = [
            'revenue_total'   => (int)Order::where('payment_status','paid')->sum('total'),
            'revenue_today'   => (int)Order::where('payment_status','paid')->whereDate('created_at',today())->sum('total'),
            'orders_total'    => Order::count(),
            'orders_pending'  => Order::where('status','pending')->count(),
            'customers_total' => User::where('role_id',3)->count(),
            'products_total'  => Product::count(),
            'low_stock_count' => ProductVariant::where('stock','<=',5)->count(),
            'out_of_stock'    => ProductVariant::where('stock',0)->count(),
        ];

        $revenueChart = collect(range(29,0))->map(fn($d)=>[
            'date'    => now()->subDays($d)->format('d/m'),
            'revenue' => (int)Order::whereDate('created_at',now()->subDays($d))->where('payment_status','paid')->sum('total'),
        ]);

        $bestSellers = OrderItem::select('product_id',DB::raw('SUM(quantity) as total_sold'),DB::raw('SUM(total_price) as total_revenue'))
            ->with('product')->groupBy('product_id')->orderByDesc('total_sold')->take(5)->get();

        $recentOrders = Order::with('user')->latest()->take(10)->get();

        $stockAlerts = ProductVariant::where('stock','<=',5)->with('product')->orderBy('stock')->take(10)->get();

        $salesByCategory = DB::table('order_items')
            ->join('products','order_items.product_id','products.id')
            ->join('categories','products.category_id','categories.id')
            ->select('categories.category',DB::raw('SUM(order_items.total_price) as revenue'))
            ->groupBy('categories.category')->orderByDesc('revenue')->get();

        return view('admin.dashboard',compact('kpi','revenueChart','bestSellers','recentOrders','stockAlerts','salesByCategory'));
    }
}
