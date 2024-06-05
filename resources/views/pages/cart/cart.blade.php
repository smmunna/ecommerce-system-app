@extends('layouts.app_layout')
@section('title', 'Cart')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Shopping Cart</h1>
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Item</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Product 1</td>
                            <td>$10.00</td>
                            <td>2</td>
                            <td>$20.00</td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm">Remove</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Product 2</td>
                            <td>$15.00</td>
                            <td>1</td>
                            <td>$15.00</td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm">Remove</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Product 3</td>
                            <td>$7.50</td>
                            <td>3</td>
                            <td>$22.50</td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm">Remove</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Apply Coupon</h5>
                        <form action="#" method="POST" class="form-inline">
                            <div class="form-group mb-2">
                                <label for="coupon" class="sr-only">Coupon Code</label>
                                <input type="text" class="form-control" id="coupon" name="coupon"
                                    placeholder="Enter coupon code">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2 ml-2">Apply</button>
                        </form>
                    </div>
                </div>
                <div class="mt-4 text-right">
                    <h4>Total: $57.50</h4>
                    <button type="button" class="btn btn-success">Proceed to Checkout</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        table {
            margin-bottom: 30px;
        }

        .card {
            margin-top: 20px;
        }

        .form-inline .form-control {
            width: auto;
            display: inline-block;
        }

        .form-inline .btn {
            margin-left: 10px;
        }
    </style>
@endpush
