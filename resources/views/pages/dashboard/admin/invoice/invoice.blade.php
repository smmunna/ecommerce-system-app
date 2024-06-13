@extends('layouts.dashboard_layout')
@section('title', 'Invoice')

@section('content')
    <style>
        @media print {

            .no-print,
            .no-print * {
                display: none !important;
            }

            .invoice {
                border: 1px solid #000;
                padding: 20px;
                margin: 20px auto;
                width: 80%;
                background-color: #fff;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
            }

            .signature-section {
                margin-top: 40px;
                display: flex;
                justify-content: space-between;
            }

            .signature-box {
                border: 1px solid #000;
                width: 200px;
                height: 100px;
                text-align: center;
                line-height: 100px;
                font-size: 14px;
            }

            .page-header,
            .invoice-info,
            .payment-methods,
            .totals {
                margin-bottom: 20px;
            }

            .page-header h2,
            .invoice-info h3,
            .totals h3 {
                margin: 0;
                padding: 5px;
            }
        }
    </style>

    @php
        $settings = App\Models\Setting::first();
    @endphp

    <section id="invoice" class="invoice p-3">
        <div class="row">
            <div class="col-12">
                <h2 class="page-header">
                    <i class="fas fa-globe"></i> {{ $settings->title }}, Inc.
                    <small class="float-right">Date: {{ now()->format('d/m/Y') }}</small>
                </h2>
            </div>
        </div>
        <div class="row invoice-info">
            <div class="col-sm-4">
                <h3>From</h3>
                <address>
                    <strong>{{ $settings->title }}, Inc.</strong><br>
                    {{ $settings->address }}<br>
                    Phone: {{ $settings->phone }}<br>
                    Email: {{ $settings->email }}
                </address>
            </div>
            <div class="col-sm-4">
                <h3>To</h3>
                <address>
                    <strong>{{ $orderDetails[0]->name }}</strong><br>
                    {{ $orderDetails[0]->address }}<br>
                    Phone: {{ $orderDetails[0]->phone }}<br>
                    Email: {{ $orderDetails[0]->email }}
                </address>
            </div>
            <div class="col-sm-4">
                <h3>Invoice Details</h3>
                <p><b>Invoice #{{ $orderDetails[0]->order_id }}</b></p>
                <p><b>Order ID:</b> {{ $orderDetails[0]->transaction_id }}</p>
                <p><b>Order Date:</b> {{ $orderDetails[0]->created_at }}</p>
                <p><b>Currency:</b> {{ $orderDetails[0]->currency }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h3>Products</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Product ID #</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderDetails as $detail)
                                <tr>
                                    <td>{{ $detail->item_id }}</td>
                                    <td>{{ $detail->product_title }}</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>{{ number_format($detail->price * $detail->quantity, 2) }}
                                        {{ $settings->currency_symbol }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row payment-methods">
            <div class="col-6">
                <p class="lead">Payment Methods:</p>
                <img src="{{ asset('dashboard_files/dist/img/credit/visa.png') }}" alt="Visa">
                <img src="{{ asset('dashboard_files/dist/img/credit/mastercard.png') }}" alt="Mastercard">
                <img src="{{ asset('dashboard_files/dist/img/credit/american-express.png') }}" alt="American Express">
                <img src="{{ asset('dashboard_files/dist/img/credit/paypal2.png') }}" alt="Paypal">
            </div>
            <div class="col-6">
                <div class="totals">
                    <h3>Total Amount</h3>
                    <table class="table">
                        <tr>
                            <th>Shipping:</th>
                            <td>Free</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td>{{ number_format($orderDetails[0]->amount, 2) }} {{ $settings->currency_symbol }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <hr>
        <div class="signature-section" style="display: flex; justify-content: space-around; gap:12px">
            <div class="signature-box"
                style="border: 1px solid #000;
            width: 200px;
            height: 100px;
            text-align: center;
            line-height: 100px;
            font-size: 14px;">
                <p>Customer Signature</p>
            </div>
            <div class="signature-box"
                style="border: 1px solid #000;
            width: 200px;
            height: 100px;
            text-align: center;
            line-height: 100px;
            font-size: 14px;">
                <p>Admin Signature</p>
            </div>
        </div>

        <button class="no-print btn btn-primary" onclick="printInvoice()">Print Invoice</button>
    </section>
@endsection

@push('scripts')
    <script>
        function printInvoice() {
            var originalContents = document.body.innerHTML;
            var invoiceContent = document.getElementById('invoice').innerHTML;

            document.body.innerHTML = invoiceContent;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
@endpush
