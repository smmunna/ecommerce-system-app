@extends('layouts.dashboard_layout')
@section('title', 'Products')
@section('content')

    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h3>Products</h3>
                        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Create Product</a>

                        <!-- Search Form -->
                        <form action="{{ route('products.index') }}" method="GET" class="form-inline mb-3">
                            <input type="text" name="search" class="form-control mr-2" placeholder="Search products...">
                            <button type="submit" class="btn btn-secondary">Search</button>
                        </form>

                        @if (session('success'))
                            <div id="success" class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->category_name ?? 'N/A' }}</td>
                                        <td>{{ $product->brand_name ?? 'N/A' }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>
                                            <a href="{{ route('products.show', $product->id) }}"
                                                class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('products.edit', $product->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pt-3">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
