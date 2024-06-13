<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    //showing wishlist products
    public function wishlist()
    {
        // Fetch the wishlist items for the logged-in user
        $wishlistItems = Wishlist::where('user_id', Auth::id())
            ->join('products', 'wishlists.product_id', '=', 'products.id')
            ->select('products.id', 'products.title', 'products.slug', 'products.photo', 'products.price', 'products.discount')
            ->get();

        return view('pages.wishlist.wishlist', compact('wishlistItems'));
    }
    // Add to wishlist
    public function addToWishlist(Request $request)
    {
        // Check if the product is already in the wishlist for the authenticated user
        $existingWishlistItem = Wishlist::where('product_id', $request->product_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingWishlistItem) {
            // If the product is already in the wishlist, return with a message
            return back()->with('failure', 'You have already added this product to your wishlist!');
        } else {
            // Add the item to the wishlist
            $wishlist = new Wishlist();
            $wishlist->product_id = $request->product_id;
            $wishlist->user_id = Auth::id();
            $wishlist->save();

            // Optionally, you can reduce the product stock here
            // $product->stock -= $request->quantity;
            // $product->save();

            return back()->with('success', 'Product added to wishlist successfully!');
        }
    }

    public function removeFromWishlist($id)
    {
        // Find the wishlist item by product_id and user_id
        $wishlistItem = Wishlist::where('product_id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if ($wishlistItem) {
            // If the wishlist item exists, delete it
            $wishlistItem->delete();
            return back()->with('success', 'Product removed from wishlist successfully!');
        } else {
            // If the wishlist item does not exist, return with an error message
            return back()->with('failure', 'Product not found in your wishlist.');
        }
    }
}
