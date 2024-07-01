@extends('layouts.dashboard_layout')
@section('title', 'Orders Report')
@section('content')

    <div class="container pt-3">
        <h3>Orders Report</h3>
        @php
            $settings = App\Models\Setting::first();
        @endphp
        <!-- Filter Form -->
        <form method="GET" action="{{ route('orders.reports') }}" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <select name="filter" class="form-control">
                            <option value="" {{ request('filter') == '' ? 'selected' : '' }}>Choose Option</option>
                            <option value="today" {{ request('filter') == 'today' ? 'selected' : '' }}>Today</option>
                            <option value="last_7_days" {{ request('filter') == 'last_7_days' ? 'selected' : '' }}>Last 7
                                Days</option>
                            <option value="last_month" {{ request('filter') == 'last_month' ? 'selected' : '' }}>Last Month
                            </option>
                            <option value="current_month" {{ request('filter') == 'current_month' ? 'selected' : '' }}>
                                Current Month</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
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
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Customer Name"
                            value="{{ request('name') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Email"
                            value="{{ request('email') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary btn-block">Filter</button>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('orders.reports') }}" class="btn btn-secondary btn-block">Clear</a>
                </div>
            </div>
        </form>
        <div id="report-table" class="report-table">
            <!-- Display Total Amount -->
            <div class="mb-4">
                <h4>Total Amount: {{ $totalAmount }}<span style="font-size: 28px">{{ $settings->currency_symbol }}</span>
                </h4>
            </div>

            <!-- Orders Table -->
            <div>
                <table class="table table-bordered">
                    <thead>
                        <tr style="background-color: #4CAF50">
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Total</th>
                            <th>Order Date</th>
                            <th>Status</th>
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
                                <td>{{ ucfirst($order->status) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No orders found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Conditionally show Print button -->
                @if ($orders->count() > 0)
                    <div class="d-flex justify-content-center mt-3">
                        <button onclick="printTable()" class="print-btn btn btn-success">Print Now</button>
                    </div>
                @endif
            </div> <!-- .table-responsive -->
        </div>
    </div>

@endsection

@push('styles')
    <style>
        .print-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .print-btn:hover {
            background-color: #45a049;
        }

        .report-table {
            margin: 0 auto;
            max-width: 1200px;
            text-align: center;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .report-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .report-table th,
        .report-table td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }

        .report-table th {
            background-color: green;
            color: whitesmoke
        }

        .report-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }


        @media print {
            body * {
                visibility: hidden;
            }

            #report-table,
            #report-table * {
                visibility: visible;
            }

            #report-table {
                position: absolute;
                left: 0;
                top: 0;
            }

            .report-options {
                text-align: center;
                margin-bottom: 20px;
            }

            .print-btn {
                display: none;
            }

            .print-btn:hover {
                background-color: #45a049;
            }

            #report-table table {
                width: 1040px !important;
                border-collapse: collapse;
            }

            /* .report-table {
                                    margin: 0 auto;
                                    max-width: 100%;
                                    max-width: none !important;
                                    text-align: center;
                                } */

            .report-table th,
            .report-table td {
                border: 1px solid #dddddd;
                padding: 8px;
                text-align: left;
            }

            .report-table th {
                background-color: green !important;
                /* Apply background color and override other styles */
                color: whitesmoke !important;
                /* Apply text color and override other styles */
            }

            .report-table tr:nth-child(even) {
                background-color: #f2f2f2;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        function printTable() {
            window.print();
        }
    </script>
@endpush
