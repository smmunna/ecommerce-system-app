@extends('layouts.app_layout')
@section('title', 'Home')
@section('content')

    @include('shared.banner.banner')
    @include('pages.home.new_products')
    @include('shared.hot_deals.hot_deals')
    @include('pages.home.featured_products')
    @include('pages.home.top_selling')

@endsection
