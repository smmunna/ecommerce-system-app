@extends('layouts.app_layout')
@section('title', 'Product Details')
@section('content')
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="active">{{ $product->title }}</li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    @include('pages.product.product_details', ['relatedProducts' => $product])
    @include('pages.product.reated_products', ['cat_id' => $product->cat_id])



@endsection
