@extends('layouts.dashboard_layout')
@section('title', 'Add Category')
@section('content')

    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h3>Add Category</h3>
                        <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control summernote @error('description') is-invalid @enderror" id="description" name="description"
                                    required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="photo">Photo</label>
                                <input type="file" class="form-control-file @error('photo') is-invalid @enderror"
                                    id="photo" name="photo">
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status">is_featured</label>
                                <select class="form-control @error('is_featured') is-invalid @enderror" id="is_featured"
                                    name="is_featured" required>
                                    <option value="">Select Status</option>
                                    <option value="yes" {{ old('status') == 'yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="no" {{ old('status') == 'no' ? 'selected' : '' }}>No
                                    </option>
                                </select>
                                @error('is_featured')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
