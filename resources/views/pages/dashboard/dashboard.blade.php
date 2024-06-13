@extends('layouts.dashboard_layout')
@section('title', 'Dashboard')
@section('content')

    @if (auth()->user()->role == 'admin')
        @include('pages.dashboard.admin.dashboard.dashboard', [
            'totalRegisterUser' => $totalRegisterUser,
            'totalReviews' => $totalReviews,
        ])
    @endif

    @if (auth()->user()->role == 'user')
        <h3>User Dashboard</h3>
    @endif

@endsection
