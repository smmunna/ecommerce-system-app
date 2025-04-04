<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
    public function getAllOrders(Request $request)
    {
        $query = Order::query();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->has('email') && $request->email != '') {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->has('from_date') && $request->has('to_date') && $request->from_date != '' && $request->to_date != '') {
            $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(10); // Pagination with 10 items per page

        return view('pages.dashboard.admin.orders.orders', compact('orders'));
    }

    // Update order status
    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:processing,pending,completed',
        ]);

        $order = Order::findOrFail($id);
        $previousStatus = $order->status; // Store the previous status

        $order->status = $request->status;
        $order->save();

        // If the status is changed to completed, deduct the product quantities
        if ($previousStatus !== 'completed' && $order->status === 'completed') {
            // Get the order items
            $orderItems = DB::table('order_items')->where('order_id', $id)->get();

            foreach ($orderItems as $item) {
                // Deduct the product stock using raw queries
                DB::table('products')
                    ->where('id', $item->product_id)
                    ->decrement('stock', $item->quantity);
            }
        }

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

    // Orders report
    public function ordersReport(Request $request)
    {
        $query = Order::query();

        $filter = $request->input('filter', 'today');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $status = $request->input('status');
        $name = $request->input('name');
        $email = $request->input('email');

        if ($filter == 'today') {
            $query->whereDate('created_at', Carbon::today());
        } elseif ($filter == 'last_7_days') {
            $query->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()]);
        } elseif ($filter == 'last_month') {
            $query->whereMonth('created_at', Carbon::now()->subMonth()->month);
        } elseif ($filter == 'current_month') {
            $query->whereMonth('created_at', Carbon::now()->month);
        } elseif ($from_date && $to_date) {
            $query->whereBetween('created_at', [$from_date, $to_date]);
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        if ($email) {
            $query->where('email', 'like', '%' . $email . '%');
        }


        $orders = $query->orderBy('created_at', 'desc')->paginate(10);
        $totalAmount = $query->sum('amount');

        return view('pages.dashboard.admin.reports.report', compact('orders', 'totalAmount'));
    }
}
