@extends('layouts.dashboard_layout')
@section('title', 'Profile')
@section('content')

    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-4 text-center">
                                <!-- Profile Picture -->
                                @if (auth()->user()->photo)
                                    <img src="{{ asset(auth()->user()->photo) }}" alt="Profile Picture"
                                        class="img-fluid rounded-circle shadow" style="max-width: 150px;">
                                @else
                                    <img src="{{ asset('default-profile.png') }}" alt="Default Profile Picture"
                                        class="img-fluid rounded-circle shadow" style="max-width: 150px;">
                                @endif
                            </div>
                        </div>
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ auth()->user()->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ auth()->user()->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ auth()->user()->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ auth()->user()->address }}</td>
                                </tr>
                                <tr>
                                    <th>Role</th>
                                    <td>{{ auth()->user()->role }}</td>
                                </tr>
                                <tr>
                                    <th>Register Date</th>
                                    <td>{{ auth()->user()->created_at->format('Y-m-d') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center pt-3">
                            @if (auth()->user()->role == 'admin')
                                <a href="{{ route('admin.edit.profile') }}" class="btn btn-primary">Edit Profile</a>
                            @else
                                <a href="{{ route('user.edit.profile') }}" class="btn btn-primary">Edit Profile</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .profile-img-container {
            position: relative;
        }

        .profile-img-container img {
            border: 3px solid #fff;
        }

        .card {
            background-color: #f8f9fa;
            border-radius: 10px;
        }

        th {
            width: 25%;
            text-align: left;
            font-weight: 600;
            background-color: #f2f2f2;
        }

        td {
            width: 75%;
            text-align: left;
        }
    </style>

@endsection
