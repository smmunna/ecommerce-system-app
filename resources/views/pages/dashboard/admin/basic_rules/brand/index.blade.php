@extends('layouts.dashboard_layout')
@section('title', 'Brands')
@section('content')

<div class="container pt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h3>Brands</h3>
                    @if (session('success'))
                        <div id="success" class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <a href="{{ route('brands.create') }}" class="btn btn-primary mb-3">Create Brand</a>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr>
                                    <td>{{ $brand->name }}</td>
                                    <td>{{ $brand->slug }}</td>
                                    <td>{{ $brand->status }}</td>
                                    <td>
                                        <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('brands.destroy', $brand->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pt-3">
                        {{ $brands->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
