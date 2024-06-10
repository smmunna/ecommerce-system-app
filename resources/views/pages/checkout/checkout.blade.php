@extends('layouts.app_layout')
@section('title', 'Checkout')
@section('content')

    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Checkout</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="active">Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /BREADCRUMB -->

    <!-- SECTION -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title">Billing address</h3>
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="name" value="{{ auth()->user()->name }}" disabled
                                placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <input class="input" type="email" name="email" value="{{ auth()->user()->email }}" disabled
                                placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input class="input" type="tel" name="phone" value="{{ auth()->user()->phone }}" disabled
                                placeholder="Phone">
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="address" value="{{ auth()->user()->address }}"
                                placeholder="Address">
                        </div>
                    </div>
                    <div class="order-notes">
                        <textarea class="input" placeholder="Order Notes or any important message"></textarea>
                    </div>
                </div>

                <div class="col-md-5 order-details">
                    <div class="section-title text-center">
                        <h3 class="title">Your Order</h3>
                    </div>
                    <div class="order-summary">
                        <div class="order-col">
                            <div><strong>PRODUCT</strong></div>
                            <div><strong>TOTAL</strong></div>
                        </div>
                        <div class="order-products">
                            @foreach ($cartItems as $item)
                                <div class="order-col">
                                    <div>{{ $item->quantity }}x {{ $item->title }}</div>
                                    <div>{{ number_format($item->amount, 2) }}৳</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="order-col">
                            <div>Shipping</div>
                            <div><strong>FREE</strong></div>
                        </div>
                        <div class="order-col">
                            <div><strong>TOTAL</strong></div>
                            <div><strong class="order-total">{{ number_format($total, 2) }}৳</strong></div>
                        </div>
                    </div>
                    <div class="payment-method">
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-1" value="bkash">
                            <label for="payment-1">
                                <span></span>
                                Bkash
                            </label>
                            <hr>
                            @php
                                // Fetch the first settings record from the database
                                $settings = App\Models\Setting::first();
                            @endphp
                            <div class="caption">
                                <h5>Send Money with Bkash App</h5>
                                <hr>
                                <ol>
                                    <li>Login to your Bkash App</li>
                                    <li>Send Money</li>
                                    <li>Phone Number: <span class="text-danger"
                                            style="font-weight: bold">{{ $settings->phone }}</span></li>
                                    <li>Enter Amount: <span
                                            style="font-weight: bold">{{ number_format($total, 2) }}৳</span>
                                    </li>
                                    <li>Reference: name/email/phone</li>
                                    <li>Enter PIN</li>
                                </ol> <br>
                                <h5>Send Money Manually</h5>
                                <hr>
                                <ol>
                                    <li>Dial *247#</li>
                                    <li>Enter 1 to Send Money</li>
                                    <li>Enter receiver account no: <span class="text-danger"
                                            style="font-weight: bold">{{ $settings->phone }}</span></li>
                                    <li>Enter Amount: <span
                                            style="font-weight: bold">{{ number_format($total, 2) }}৳</span></li>
                                    <li>Enter Reference: name/email/phone</li>
                                    <li>Enter your PIN to confirm</li>
                                </ol>
                                <hr>
                                <p class="text-danger">---Wait 24 hours for the Approval---</p>
                                <hr>
                                <div class="form-group" id="transaction-id-group">
                                    <label for="">After Send Money, Give your Transaction ID</label>
                                    <input class="input" type="text" name="transaction_id"
                                        placeholder="Enter Transaction ID">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="input-radio">
                            <input type="radio" name="payment" id="payment-2">
                            <label for="payment-2">
                                <span></span>
                                Cheque Payment
                            </label>
                            <div class="caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div> --}}
                    </div>
                    <div class="input-checkbox">
                        <input type="checkbox" id="terms">
                        <label for="terms">
                            <span></span>
                            I've read and accept the <a href="#">terms & conditions</a>
                        </label>
                    </div>
                    <a href="#" class="primary-btn order-submit">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    </div>

@endsection
