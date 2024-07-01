@extends('layouts.dashboard_layout')
@section('title', 'Orders List')

@section('content')
    <div class="container">
        @php
            $settings = App\Models\Setting::first();
        @endphp
        <div class="row">
            <div class="col-md-12">
                <h3>Orders List</h3>

                <!-- Filter Form -->
                <form method="GET" action="{{ route('admin.orders') }}" class="form-inline mb-4">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Customer Name"
                            value="{{ request('name') }}">
                    </div>
                    <div class="form-group mx-sm-3">
                        <input type="text" name="email" class="form-control" placeholder="Email"
                            value="{{ request('email') }}">
                    </div>
                    <div class="form-group">
                        <select name="status" class="form-control">
                            <option value="">All Status</option>
                            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing
                            </option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed
                            </option>
                        </select>
                    </div>
                    <div class="form-group mx-sm-3">
                        <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
                    </div>
                    <div class="form-group">
                        <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('admin.orders') }}" class="btn btn-secondary ml-2">Clear</a>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Total</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->amount }}<span
                                            style="font-size: 22px">{{ $settings->currency_symbol }}</span></td>
                                    <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                                    <td>
                                        <form action="{{ route('updateOrderStatus', $order->id) }}" method="POST"
                                            class="form-inline">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <select name="status" class="form-control">
                                                    <option value="processing"
                                                        {{ $order->status == 'processing' ? 'selected' : '' }}>Processing
                                                    </option>
                                                    <option value="pending"
                                                        {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                                    </option>
                                                    <option value="completed"
                                                        {{ $order->status == 'completed' ? 'selected' : '' }}>Completed
                                                    </option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm ml-2"
                                                {{ $order->status == 'completed' ? 'disabled' : '' }}>Update</button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.invoices', $order->id) }}"><button
                                                class="btn btn-primary">Invoice</button></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No orders found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div> <!-- .table-responsive -->

                <!-- Pagination Links -->
                <div class="d-flex justify-content-center">
                    {{ $orders->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        table {
            min-width: 100%;
        }

        table th,
        table td {
            text-align: center;
        }

        .form-inline {
            display: flex;
            align-items: center;
        }

        .form-group {
            margin-right: 10px;
        }
    </style>
@endpush
