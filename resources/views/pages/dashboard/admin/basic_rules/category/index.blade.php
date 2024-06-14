@extends('layouts.dashboard_layout')
@section('title', 'Categories')
@section('content')

    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h3>Categories</h3>
                        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Create Category</a>
                        @if (session('success'))
                            <p id="success" class="text-center" style="color: green">{{ session('success') }}</p>
                        @endif
                        @if ($categories->count())
                            <div style="max-height: 400px; overflow-y: auto;">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Description</th>
                                            <th>Photo</th>
                                            <th>is_featured</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->slug }}</td>
                                                <td>{!! $category->description !!}</td>
                                                <td>
                                                    @if ($category->photo)
                                                        <img src="{{ asset($category->photo) }}" alt="{{ $category->name }}"
                                                            class="img-fluid" style="max-width: 100px;">
                                                    @else
                                                        <img src="{{ asset('default-category.png') }}"
                                                            alt="Default Category" class="img-fluid"
                                                            style="max-width: 100px;">
                                                    @endif
                                                </td>
                                                <td>{{ ucfirst($category->is_featured) }}</td>
                                                <td>
                                                    <!-- Add your action buttons here, e.g., Edit and Delete -->
                                                    <a href="{{ route('categories.edit', $category->id) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                    <!-- Delete button with form for CSRF protection -->
                                                    <form action="{{ route('categories.destroy', $category->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination links -->
                            <div class="d-flex justify-content-center pt-3">
                                {{ $categories->links() }}
                            </div>
                        @else
                            <p>No categories found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
