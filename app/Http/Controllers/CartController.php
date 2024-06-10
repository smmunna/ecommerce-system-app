<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //add to cart
    public function addToCart(Request $request)
    {
        // Validate the request
        $request->validate([
            'product_id' => 'required',
            'size' => 'required',
            'color' => 'required',
            'quantity' => 'required|integer|min:1',
            'amount' => 'required',
        ]);

        // Find the product
        $product = Product::find($request->product_id);

        // Check if the requested quantity is available
        if ($request->quantity > $product->stock) {
            return back()->with('failure', 'Not enough quantity in stock.');
        }

        // Add the item to the cart
        $cart = new Cart();
        $cart->product_id = $request->product_id;
        $cart->user_id = Auth::id();
        $cart->size = $request->size;
        $cart->color = $request->color;
        $cart->quantity = $request->quantity;
        $cart->amount = ($request->quantity * $request->amount);
        $cart->save();

        // Optionally, you can reduce the product stock here
        // $product->stock -= $request->quantity;
        // $product->save();

        return back()->with('success', 'Product added to cart successfully!');
    }

    // Update cart quantity and Price
    public function updateCart(Request $request)
    {
        $userId = Auth::id();

        foreach ($request->quantity as $cartItemId => $quantity) {
            $cartItem = Cart::where('id', $cartItemId)->where('user_id', $userId)->first();
            if ($cartItem) {
                $product = Product::find($cartItem->product_id);
                if ($quantity > 0 && $quantity <= $product->stock) {
                    $cartItem->quantity = $quantity;

                    // Calculate the new amount
                    $discountedPrice = $product->price - $product->discount;
                    $cartItem->amount = $discountedPrice * $quantity;

                    $cartItem->save();
                } else {
                    // Redirect back with an error message if the quantity is more than stock
                    return redirect()->route('myCartItem')->with('failure', 'Not enough stock for ' . $product->title);
                }
            }
        }

        return redirect()->route('myCartItem')->with('success', 'Cart updated successfully!');
    }



    // Delete a product from the cart
    public function deleteFromCart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();

        return back()->with('success', 'Product removed from cart successfully!');
    }

    // Applying the Cupon
    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon' => 'required|string|exists:cupons,cupon_code'
        ]);

        $coupon = Cupon::where('cupon_code', $request->coupon)->first();
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('carts.*', 'products.title', 'products.slug', 'products.photo', 'products.price', 'products.discount')
            ->get();

        $subtotal = $cartItems->sum(function ($cartItem) {
            $discountedPrice = $cartItem->price - $cartItem->discount;
            return $discountedPrice * $cartItem->quantity;
        });

        $totalAfterDiscount = $subtotal - $coupon->discount_price;
        if ($totalAfterDiscount > 0) {
            $remainingDiscount = $coupon->discount_price;
            foreach ($cartItems as $cartItem) {
                $discountedPrice = $cartItem->price - $cartItem->discount;
                $totalPrice = $discountedPrice * $cartItem->quantity;

                // Calculate the discount for this item proportionally
                $itemDiscount = ($totalPrice / $subtotal) * $remainingDiscount;
                $itemDiscountedAmount = $totalPrice - $itemDiscount;

                $cartItem->amount = $itemDiscountedAmount;
                $cartItem->save();
            }
        }

        return view('pages.cart.cart', compact('cartItems', 'subtotal', 'totalAfterDiscount', 'coupon'));
    }
}
