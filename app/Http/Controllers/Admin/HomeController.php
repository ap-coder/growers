<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Order;
use App\Models\Client;
use App\Models\User;
use App\Models\ContentPage;
use Carbon\Carbon;

class HomeController
{
    public function index()
    {
        // Product Stats
        $totalProducts = Product::count();
        $publishedProducts = Product::where('published', true)->count();
        $dummyProducts = Product::where('is_fake', true)->count();
        $lowStockProducts = Product::where('quantity', '<', 10)->count();

        // Order Stats
        $totalOrders = Order::count();
        $newOrders = Order::where('status', 'new')->count();
        $processingOrders = Order::where('status', 'processing')->count();
        $thisMonthOrders = Order::whereMonth('created_at', Carbon::now()->month)->count();
        $thisMonthRevenue = Order::whereMonth('created_at', Carbon::now()->month)->sum('total_price');

        // Client Stats
        $totalClients = Client::count();
        $activeClients = Client::where('published', true)->count();
        $dummyClients = Client::where('is_fake', true)->count();

        // User Stats
        $totalUsers = User::count();
        $activeUsers = User::whereNotNull('email_verified_at')->count();

        // Recent Orders
        $recentOrders = Order::with('client')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Recent Products
        $recentProducts = Product::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Monthly Revenue Chart Data (last 6 months)
        $monthlyRevenue = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $revenue = Order::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('total_price');
            $monthlyRevenue[] = [
                'month' => $month->format('M Y'),
                'revenue' => $revenue
            ];
        }

        return view('home', compact(
            'totalProducts',
            'publishedProducts',
            'dummyProducts',
            'lowStockProducts',
            'totalOrders',
            'newOrders',
            'processingOrders',
            'thisMonthOrders',
            'thisMonthRevenue',
            'totalClients',
            'activeClients',
            'dummyClients',
            'totalUsers',
            'activeUsers',
            'recentOrders',
            'recentProducts',
            'monthlyRevenue'
        ));
    }
}
