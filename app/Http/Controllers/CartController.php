<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
        $cart->save();

        // Optionally, you can reduce the product stock here
        // $product->stock -= $request->quantity;
        // $product->save();

        return back()->with('success', 'Product added to cart successfully!');
    }

    // Update cart quantity
    public function updateCart(Request $request)
    {
        $userId = Auth::id();

        foreach ($request->quantity as $cartItemId => $quantity) {
            $cartItem = Cart::where('id', $cartItemId)->where('user_id', $userId)->first();
            if ($cartItem) {
                $product = Product::find($cartItem->product_id);
                if ($quantity > 0 && $quantity <= $product->stock) {
                    $cartItem->quantity = $quantity;
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
}
