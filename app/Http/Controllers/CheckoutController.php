<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    //showing checkout page
    public function checkoutPage(Request $request)
    {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('carts.*', 'products.title')
            ->get();

        $total = $cartItems->sum('amount');

        return view('pages.checkout.checkout', compact('cartItems', 'total'));
    }
}
