@extends('layouts.dashboard_layout')
@section('title', 'Dashboard')
@section('content')

    @if (auth()->user()->role == 'admin')
        <h3>Admin Dashboard</h3>
    @endif

    @if (auth()->user()->role == 'user')
        <h3>User Dashboard</h3>
    @endif

@endsection
