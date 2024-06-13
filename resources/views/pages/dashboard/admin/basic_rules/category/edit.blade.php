@extends('layouts.dashboard_layout')
@section('title', 'Edit Category')
@section('content')

    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h3>Edit Category</h3>
                        <form action="{{ route('categories.update', $category->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $category->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control summernote @error('description') is-invalid @enderror" id="description" name="description"
                                    required>{!! old('description', $category->description) !!}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="photo">Photo</label>
                                @if ($category->photo)
                                    <div class="mb-2">
                                        <img src="{{ asset($category->photo) }}" alt="{{ $category->name }}"
                                            class="img-fluid" style="max-width: 150px;">
                                    </div>
                                @endif
                                <input type="file" class="form-control-file @error('photo') is-invalid @enderror"
                                    id="photo" name="photo">
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="is_featured">isFeatured</label>
                                <select class="form-control @error('is_featured') is-invalid @enderror" id="is_featured"
                                    name="is_featured" required>
                                    <option value="yes"
                                        {{ old('is_featured', $category->is_featured) == 'yes' ? 'selected' : '' }}>Yes
                                    </option>
                                    <option value="no"
                                        {{ old('is_featured', $category->is_featured) == 'no' ? 'selected' : '' }}>No
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
