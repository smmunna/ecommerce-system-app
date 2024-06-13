<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //Place order from user
    public function placeOrder(Request $request)
    {
        // Validate the request data
        $request->validate([
            'transaction_id' => 'required',
        ]);

        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->get();

        // Create a new order
        $order = Order::create([
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'phone' => Auth::user()->phone,
            'amount' => $cartItems->sum('amount'),
            'address' => $request->input('address'),
            'status' => 'pending',
            'transaction_id' => $request->input('transaction_id'),
            'currency' => 'BDT',
            'order_note' => $request->input('order_note'),
        ]);

        // Create order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->amount,
            ]);
        }

        // Clear the user's cart
        Cart::where('user_id', $userId)->delete();

        // Redirect to a confirmation page
        // return redirect()->route('orderConfirmation', $order->id);
        return redirect()->route('home')->with('success', 'Product ordered successfully');
    }

    // Get all orders for admin
    public function getAllOrders()
    {
        $orders = Order::orderBy('created_at', 'desc')->get(); // Fetch all orders and order by created_at in descending order
        return view('pages.dashboard.admin.orders.orders', compact('orders'));
    }

    // Update order status
    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:processing,pending,completed',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }

    // Invoice for admin
    public function invoiceAdmin($id)
    {
        // Use a raw SQL query to join orders, order_items, and products tables
        $orderDetails = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select(
                'orders.id as order_id',
                'orders.name',
                'orders.email',
                'orders.phone',
                'orders.amount',
                'orders.address',
                'orders.status',
                'orders.transaction_id',
                'orders.currency',
                'orders.order_note',
                'orders.created_at',
                'order_items.id as item_id',
                'order_items.quantity',
                'order_items.price',
                'products.title as product_title'
            )
            ->where('orders.id', $id)
            ->get();

        return view('pages.dashboard.admin.invoice.invoice', compact('orderDetails'));
    }
}
