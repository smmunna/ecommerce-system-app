@extends('layouts.dashboard_layout')
@section('title', 'Edit Product')
@section('content')

    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h3>Edit Product</h3>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('products.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ old('title', $product->title) }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="stock">Stock</label>
                                    <input type="number" class="form-control" id="stock" name="stock"
                                        value="{{ old('stock', $product->stock) }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="size">Size</label>
                                    <input type="text" class="form-control" id="size" name="size"
                                        value="{{ old('size', $product->size) }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="condition">Condition</label>
                                    <input type="text" class="form-control" id="condition" name="condition"
                                        value="{{ old('condition', $product->condition) }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price" name="price"
                                        value="{{ old('price', $product->price) }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="discount">Discount</label>
                                    <input type="number" class="form-control" id="discount" name="discount"
                                        value="{{ old('discount', $product->discount) }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="cat_id">Category</label>
                                    <select class="form-control" id="cat_id" name="cat_id">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('cat_id', $product->cat_id) == $category->id ? 'selected' : '' }}>
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
                                                {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="photo">Photos</label>
                                    <input type="file" class="form-control-file" id="photo" name="photos[]" multiple>
                                    @if ($product->photo)
                                        @php
                                            $photos = json_decode($product->photo);
                                        @endphp
                                        <div class="mt-2">
                                            @foreach ($photos as $photo)
                                                <img src="{{ asset($photo) }}" alt="Product Photo" class="img-fluid"
                                                    style="max-width: 100px; margin-right: 10px;">
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="summary">Summary</label>
                                    <textarea class="form-control summernote" id="summary" name="summary">{{ old('summary', $product->summary) }}</textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="description">Description</label>
                                    <textarea class="form-control summernote" id="description" name="description">{{ old('description', $product->description) }}</textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="status">Status</label>
                                    <input type="checkbox" id="status" name="status"
                                        {{ old('status', $product->status) ? 'checked' : '' }}>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="is_featured">Is Featured</label>
                                    <input type="checkbox" id="is_featured" name="is_featured"
                                        {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
