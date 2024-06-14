@extends('layouts.dashboard_layout')
@section('title', 'Dashboard')
@section('content')

    @if (auth()->user()->role == 'admin')
        @include('pages.dashboard.admin.dashboard.dashboard', [
            'totalRegisterUser' => $totalRegisterUser,
            'totalReviews' => $totalReviews,
            'totalOrders' => $totalOrders,
            'totalEarnings' => $totalEarnings,
            'recentOrders' => $recentOrders,
        ])
    @endif

    @if (auth()->user()->role == 'user')
        @include('pages.dashboard.user.dashboard.dashboard', [
            'totalCostByUser' => $totalCostByUser,
            'totalOrdersByUser' => $totalOrdersByUser,
            'myOrders' => $myOrders,
        ])
    @endif

@endsection
