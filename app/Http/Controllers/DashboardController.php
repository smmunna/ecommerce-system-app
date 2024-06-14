<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //for admin access dashboard
    public function dashboard()
    {
        $totalRegisterUser = DB::table('users')->count();
        $totalReviews = DB::table('reviews')->count();
        $totalOrders = DB::table('orders')->count();
        $totalEarnings = DB::table('orders')->where('status', 'completed')->sum('amount');
        $recentOrders = Order::orderBy('created_at', 'desc')->take(5)->get();

        // for user dashboard
        $totalCostByUser = DB::table('orders')
            ->where('status', 'completed')
            ->where('email', auth()->user()->email)
            ->sum('amount');
        $totalOrdersByUser = DB::table('orders')
            ->where('email', auth()->user()->email)
            ->count();
        $myOrders = DB::table('orders')
            ->where('email', auth()->user()->email)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view(
            'pages.dashboard.dashboard',
            [
                'totalRegisterUser' => $totalRegisterUser,
                'totalReviews' => $totalReviews,
                'totalOrders' => $totalOrders,
                'totalEarnings' => $totalEarnings,
                'recentOrders' => $recentOrders,
                'totalCostByUser' => $totalCostByUser,
                'totalOrdersByUser' => $totalOrdersByUser,
                'myOrders' => $myOrders

            ]
        );
    }
}
