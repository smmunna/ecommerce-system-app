@extends('layouts.dashboard_layout')
@section('title', 'Create Product')
@section('content')
    @php
        // Fetch the first settings record from the database
        $settings = App\Models\Setting::first();
    @endphp
    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h3>Create Product</h3>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ old('title') }}" placeholder="Your Product title">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="stock">Stock</label>
                                    <input type="number" class="form-control" id="stock" name="stock"
                                        value="{{ old('stock') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="size">Size</label>
                                    <input type="text" class="form-control" id="size" name="size"
                                        value="{{ old('size') }}" placeholder="lg, md, 20MB..">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="condition">Condition</label>
                                    <input type="text" class="form-control" id="condition" name="condition"
                                        value="{{ old('condition') }}" placeholder="New">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="price">Price</label>
                                    <input type="number" step="0.01" class="form-control" id="price" name="price"
                                        value="{{ old('price') }}" placeholder="100{{ $settings->currency_symbol }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="discount">Discount</label>
                                    <input type="number" step="0.01" class="form-control" id="discount" name="discount"
                                        value="{{ old('discount') }}" placeholder="50{{ $settings->currency_symbol }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="cat_id">Category</label>
                                    <select class="form-control" id="cat_id" name="cat_id">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('cat_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="brand_id">Brand</label>
                                    <select class="form-control" id="brand_id" name="brand_id">
                                        <option value="">Select Brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="photo">Photo</label>
                                    <input type="file" class="form-control-file" id="photos" name="photos[]" multiple>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="summary">Summary</label>
                                    <textarea class="form-control summernote" id="summary" name="summary">{{ old('summary') }}</textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="description">Description</label>
                                    <textarea class="form-control summernote" id="description" name="description">{{ old('description') }}</textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
