@extends('layouts.dashboard_layout')
@section('title', 'User Details')
@section('content')
    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Details</div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <img src="{{ $user->photo ? asset($user->photo) : asset('default-photo.png') }}"
                                    alt="{{ $user->name }}" class="img-fluid rounded" width="150">
                            </div>
                            <div class="col-md-8">
                                <h4>{{ $user->name }}</h4>
                                <p><strong>Email:</strong> {{ $user->email }}</p>
                                <p><strong>Phone:</strong> {{ $user->phone }}</p>
                                <p><strong>Address:</strong> {{ $user->address }}</p>
                                <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
                                <p><strong>Registered at:</strong> {{ $user->created_at->format('d M Y, H:i') }}</p>
                                <p><strong>Updated at:</strong> {{ $user->updated_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.users.editPassword', $user->id) }}" class="btn btn-warning mb-2">Edit
                            Password</a>
                        <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST" class="form-inline">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="role" class="sr-only">Role</label>
                                <select name="role" class="form-control">
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="subadmin" {{ $user->role == 'subadmin' ? 'selected' : '' }}>Subadmin
                                    </option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-secondary ml-2">Change Role</button>
                        </form>
                        <a href="{{ route('admin.users') }}" class="btn btn-primary mt-3">Back to Users List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
