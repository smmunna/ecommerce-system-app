@extends('layouts.app_layout')
@section('title', 'Cart')
@section('content')
    @php
        use Illuminate\Support\Facades\Auth;
        use App\Models\Cart;
        use App\Models\Product;

        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select(
                'carts.*',
                'products.title',
                'products.slug',
                'products.photo',
                'products.price',
                'products.discount',
            )
            ->get();

        $totalQuantity = $cartItems->sum('quantity');
        $subtotal = $cartItems->sum(function ($cartItem) {
            $discountedPrice = $cartItem->price - $cartItem->discount;
            return $discountedPrice * $cartItem->quantity;
        });

        // Check if a coupon was applied
        $totalAfterDiscount = $totalAfterDiscount ?? $subtotal;
        $discount = $subtotal - $totalAfterDiscount;
    @endphp

    <div class="container mt-5">
        <h1 class="mb-4">Shopping Cart</h1>
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                @if ($cartItems->isEmpty())
                    <p>No items in your cart.</p>
                @else
                    <form action="{{ route('updateCart') }}" method="POST">
                        @csrf
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                    @php
                                        $discountedPrice = $item->price - $item->discount;
                                        $totalPrice = $discountedPrice * $item->quantity;
                                        $photos = json_decode($item->photo, true);
                                        $firstPhoto = $photos[0] ?? 'default-image.jpg';
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="{{ route('product.details', $item->slug) }}">
                                                    <p class="product-name">{{ $item->title }}</p>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-img">
                                                <img src="{{ asset($firstPhoto) }}" alt="{{ $item->title }}" width="100"
                                                    height="100">
                                            </div>
                                        </td>
                                        <td>{{ number_format($discountedPrice, 2) }} ৳</td>
                                        <td>
                                            <input type="number" name="quantity[{{ $item->id }}]"
                                                value="{{ $item->quantity }}" min="1" class="form-control"
                                                style="width: 60px;">
                                        </td>
                                        <td>{{ number_format($totalPrice, 2) }} ৳</td>
                                        <td>
                                            <button type="submit" name="update" value="{{ $item->id }}"
                                                class="btn btn-primary btn-sm">Update</button>
                                            <form action="{{ route('deleteFromCart', $item->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Apply Coupon</h5>
                            <form action="{{ route('applyCoupon') }}" method="POST" class="form-inline">
                                @csrf
                                <div class="form-group mb-2">
                                    <input type="text" class="form-control" id="coupon" name="coupon"
                                        placeholder="Enter coupon code">
                                </div>
                                <button type="submit" class="btn btn-primary mb-2 ml-2">Apply</button>
                            </form>
                        </div>
                    </div>

                    <div class="mt-4 text-right">
                        <h4>Subtotal: ৳{{ number_format($subtotal, 2) }}</h4>
                        @if (isset($discount) && $discount > 0)
                            <h4>Discount: ৳{{ number_format($discount, 2) }}</h4>
                        @endif
                        <h4>Total: ৳{{ number_format($totalAfterDiscount, 2) }}</h4>
                        <a href="#" class="btn btn-success">Proceed to Checkout</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection


@push('styles')
    <style>
        table {
            margin-bottom: 30px;
        }

        .product-img img {
            max-width: 50px;
            height: auto;
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
