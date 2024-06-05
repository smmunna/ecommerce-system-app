@extends('layouts.dashboard_layout')
@section('title', 'Size')
@section('content')

    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h3>Add New Size</h3>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('success'))
                            <div id="success" class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('create.size') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Size Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Size</button>
                        </form>
                    </div>
                </div>

                <!-- Sizes List -->
                <div class="card mt-4 shadow-sm border-0">
                    <div class="card-body">
                        <h3>Sizes List</h3>
                        @if ($sizes->isEmpty())
                            <p>No sizes available.</p>
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sizes as $size)
                                        <tr>
                                            <td>{{ $size->name }}</td>
                                            <td>
                                                <form action="{{ route('sizes.destroy', $size->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this size?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination Links -->
                            {{ $sizes->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
