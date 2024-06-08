@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Cart;
    use App\Models\Product;

    $userId = Auth::id();
    $cartItems = Cart::where('user_id', $userId)
        ->join('products', 'carts.product_id', '=', 'products.id')
        ->select('carts.*', 'products.title', 'products.slug', 'products.photo', 'products.price', 'products.discount')
        ->get();

    $totalQuantity = $cartItems->sum('quantity');
    $subtotal = $cartItems->sum(function ($cartItem) {
        $discountedPrice = $cartItem->price - $cartItem->discount;
        return $discountedPrice * $cartItem->quantity;
    });
@endphp


<!-- Cart -->
<div class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
        <i class="fa fa-shopping-cart" style="cursor: pointer"></i>
        <span>Your Cart</span>
        <div class="qty">{{ $totalQuantity }}</div>
    </a>
    <div class="cart-dropdown">
        <!-- Check if there are any items in the cart -->
        <div class="cart-list">
            @foreach ($cartItems as $item)
                @php
                    $discountedPrice = $item->price - $item->discount;
                    $photos = json_decode($item->photo, true);
                    $firstPhoto = $photos[0] ?? 'techzaint-2022.jpg';
                @endphp
                <div class="product-widget">
                    <div class="product-img">
                        <img src="{{ asset($firstPhoto) }}" alt="{{ $item->title }}">
                    </div>
                    <div class="product-body">
                        <h3 class="product-name"><a
                                href="{{ route('product.details', $item->slug) }}">{{ $item->title }}</a></h3>
                        <h4 class="product-price">
                            <span class="qty">{{ $item->quantity }}x</span>
                            ৳{{ number_format($discountedPrice, 2) }}
                            @if ($item->discount > 0)
                                <del>৳{{ number_format($item->price, 2) }}</del>
                            @endif
                        </h4>
                    </div>
                    <div>
                        {{-- Delete from the cart --}}
                        <form id="deleteForm" action="{{ route('deleteFromCart', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn btn btn-danger" style="width: 100%;"><i
                                    class="fa fa-close"></i></button>
                        </form>
                    </div>

                </div>
            @endforeach
        </div>
        <div class="cart-summary">
            <small>{{ $totalQuantity }} Item(s) selected</small>
            <h5>SUBTOTAL: ৳{{ number_format($subtotal, 2) }}</h5>
        </div>
        <div class="cart-btns">
            <a href="{{route('myCartItem')}}">View Cart</a>
            <a href="#">Checkout <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<!-- /Cart -->
