@extends('layouts.dashboard_layout')
@section('title', 'Edit Brand')
@section('content')

    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h3>Edit Brand</h3>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('brands.update', $brand->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Brand Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $brand->name }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Brand</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
