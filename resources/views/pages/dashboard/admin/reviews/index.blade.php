@extends('layouts.dashboard_layout')
@section('title', 'Reviews')
@section('content')
    <div class="container pt-4">
        <div class="row mb-3">
            <div class="col-md-12">
                <form action="{{ route('admin.reviews.index') }}" method="GET" class="form-inline">
                    <div class="form-group mb-2">
                        <label for="search" class="sr-only">Search</label>
                        <input type="text" class="form-control" id="search" name="search"
                            placeholder="Search by email, name, product, or rating"
                            value="{{ request()->input('search') }}">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="start_date" class="sr-only">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date"
                            value="{{ request()->input('start_date') }}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="end_date" class="sr-only">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date"
                            value="{{ request()->input('end_date') }}">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Search</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if ($reviews->isEmpty())
                    <div class="alert alert-info" role="alert">
                        No reviews available.
                    </div>
                @else
                    <div style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Review</th>
                                    <th>Rating</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $review)
                                    <tr>
                                        <td>{{ $review->id }}</td>
                                        <td>{{ $review->product_title }}</td>
                                        <td>{{ $review->user_name ?? 'Guest' }}</td>
                                        <td>{{ $review->email }}</td>
                                        <td>{{ $review->review }}</td>
                                        <td>{{ $review->rating }}</td>
                                        <td>{{ $review->created_at }}</td>
                                        <td>
                                            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $reviews->appends(request()->input())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
