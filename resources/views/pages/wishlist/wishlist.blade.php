@extends('layouts.app_layout')
@section('title', 'Wishlist')
@section('content')

    @php
        // Fetch the first settings record from the database
        $settings = App\Models\Setting::first();
    @endphp

    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Wishlist</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="active">Wishlist</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /BREADCRUMB -->

    <!-- WISHLIST -->
    <div class="section">
        <div class="container">
            <div class="row">
                @if ($wishlistItems->isEmpty())
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            Your wishlist is empty.
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wishlistItems as $product)
                                    <tr>
                                        <td>
                                            <img src="{{ asset(json_decode($product->photo)[0]) }}" alt=""
                                                style="width: 100px; height: 100px;">
                                        </td>
                                        <td>{{ $product->title }}</td>
                                        <td>
                                            @if ($product->discount > 0)
                                                @php
                                                    $newPrice = $product->price - $product->discount;
                                                    $discountPercentage = round(
                                                        ($product->discount / $product->price) * 100,
                                                        2,
                                                    );
                                                @endphp
                                            @endif
                                            @if ($product->discount > 0)
                                                {{ $newPrice ?? $product->price }}{{ $settings->currency_symbol }}
                                            @else
                                                {{ $product->price }}{{ $settings->currency_symbol }}
                                            @endif
                                            @if ($product->discount > 0)
                                                <del
                                                    class="product-old-price">{{ $product->price }}{{ $settings->currency_symbol }}</del>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('product.details', $product->slug) }}"
                                                class="btn btn-primary btn-sm">View</a>
                                            <form action="{{ route('remove.wishlist', $product->id) }}" method="post"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">X</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- /WISHLIST -->

@endsection
