<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('reviews')
            ->join('products', 'reviews.product_id', '=', 'products.id')
            ->leftJoin('users', 'reviews.email', '=', 'users.email')
            ->select('reviews.*', 'products.title as product_title', 'users.name as user_name')
            ->orderBy('reviews.created_at', 'desc');

        // Combined search query
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->input('search') . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('reviews.email', 'like', $searchTerm)
                    ->orWhere('users.name', 'like', $searchTerm)
                    ->orWhere('products.title', 'like', $searchTerm)
                    ->orWhere('reviews.rating', 'like', $searchTerm);
            });
        }

        // Date range filter
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('reviews.created_at', [$request->input('start_date'), $request->input('end_date')]);
        }

        $reviews = $query->paginate(10);

        return view('pages.dashboard.admin.reviews.index', compact('reviews'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'review' => 'required|string',
            'rating' => 'required|min:1|max:5',
        ]);

        $review = new Review();
        $review->product_id = $request->input('product_id');
        $review->email = $request->input('email');
        $review->review = $request->input('review');
        $review->rating = $request->input('rating');
        $review->save();

        return redirect()->back()->with('success', 'Review submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $review = DB::table('reviews')->where('id', $id)->first();
        if (!$review) {
            return redirect()->route('reviews.index')->with('failure', 'Review not found.');
        }
        DB::table('reviews')->where('id', $id)->delete();
        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully.');
    }
}
