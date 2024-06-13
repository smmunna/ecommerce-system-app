@extends('layouts.dashboard_layout')
@section('title', 'Users List')
@section('content')
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-12">
                <h3>Users List</h3>

                <!-- Search Form -->
                <form action="{{ route('admin.users') }}" method="GET" class="form-inline mb-3">
                    <div class="form-group mb-2">
                        <input type="text" class="form-control" name="search" placeholder="Search by name or email"
                            value="{{ request()->input('search') }}">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Search</button>
                </form>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('d M Y, H:i A') }}</td>
                                <td>
                                    <a href="{{ route('admin.users.show', $user->id) }}"
                                        class="btn btn-info btn-sm">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $users->appends(['search' => request()->input('search')])->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
