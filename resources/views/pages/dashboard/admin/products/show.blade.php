@extends('layouts.dashboard_layout')
@section('title', 'Product Details')
@section('content')

    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h3>Product Details</h3>
                        <table class="table table-bordered">
                            <tr>
                                <th>Title</th>
                                <td>{{ $product->title }}</td>
                            </tr>
                            <tr>
                                <th>Slug</th>
                                <td>{{ $product->slug }}</td>
                            </tr>
                            <tr>
                                <th>Summary</th>
                                <td>{!! $product->summary !!}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{!! $product->description !!}</td>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <td>{{ $product->category_name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Brand</th>
                                <td>{{ $product->brand_name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td>{{ $product->price }}</td>
                            </tr>
                            <tr>
                                <th>Stock</th>
                                <td>{{ $product->stock }}</td>
                            </tr>
                            <tr>
                                <th>Size</th>
                                <td>{{ $product->size }}</td>
                            </tr>
                            <tr>
                                <th>Condition</th>
                                <td>{{ $product->condition }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $product->status }}</td>
                            </tr>
                            <tr>
                                <th>Discount</th>
                                <td>{{ $product->discount }}</td>
                            </tr>
                            <tr>
                                <th>Featured</th>
                                <td>{{ $product->is_featured ? 'Yes' : 'No' }}</td>
                            </tr>
                            <tr>
                                <th>Photo</th>
                                <td>
                                    @if ($product->photo)
                                        @php
                                            $photos = json_decode($product->photo); // Decode the JSON array of image paths
                                        @endphp
                                        <div class="d-flex flex-wrap">
                                            @foreach ($photos as $photo)
                                                <img src="{{ asset($photo) }}" alt="Product Photo" class="img-fluid m-2"
                                                    style="max-width: 150px;">
                                            @endforeach
                                        </div>
                                    @else
                                        N/A
                                    @endif
                                </td>

                            </tr>
                        </table>
                        <div class="pt-3">
                            <a href="{{ route('products.index') }}" class="btn btn-primary">Back to Products</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
