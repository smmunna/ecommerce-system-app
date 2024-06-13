@php
    $totalWishlistItem = 0;

    if (auth()->check()) {
        $totalWishlistItem = DB::table('wishlists')
            ->where('user_id', auth()->user()->id)
            ->count();
    }
@endphp

<div>
    <a href="{{ route('wishlist') }}">
        <i class="fa fa-heart-o"></i>
        <span>Your Wishlist</span>
        <div class="qty">{{ $totalWishlistItem }}</div>
    </a>
</div>
