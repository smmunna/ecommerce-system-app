<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query()
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->join('categories', 'products.cat_id', '=', 'categories.id')
            ->select('products.*', 'brands.name as brand_name', 'categories.name as category_name');

        if ($request->has('search')) {
            $search = $request->input('search');

            $query->where('products.id', 'like', "%{$search}%")
                ->orWhere('products.title', 'like', "%{$search}%")
                ->orWhere('products.stock', 'like', "%{$search}%")
                ->orWhere('products.condition', 'like', "%{$search}%")
                ->orWhere('products.price', 'like', "%{$search}%")
                ->orWhere('brands.name', 'like', "%{$search}%")
                ->orWhere('categories.name', 'like', "%{$search}%");
        }

        $products = $query->orderBy('products.created_at', 'desc')->paginate(10);

        return view('pages.dashboard.admin.products.index', compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('pages.dashboard.admin.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string',
            'summary' => 'nullable|string',
            'description' => 'nullable|string',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'stock' => 'nullable|integer',
            'size' => 'nullable|string',
            'condition' => 'nullable|string',
            'price' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'cat_id' => 'nullable|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
        ]);

        $product = new Product();
        $product->title = $request->input('title');
        $product->slug = Str::slug($request->input('title'), '-');
        $product->summary = $request->input('summary');
        $product->description = $request->input('description');
        $product->stock = $request->input('stock');
        $product->size = $request->input('size');
        $product->condition = strtolower($request->input('condition'));
        $product->price = $request->input('price');
        $product->discount = $request->input('discount');
        $product->cat_id = $request->input('cat_id');
        $product->brand_id = $request->input('brand_id');

        // Handling multiple file uploads
        if ($request->hasFile('photos')) {
            $photoPaths = [];
            foreach ($request->file('photos') as $photo) {
                // Generate a unique ID for the file name
                $uniqueId = uniqid();
                // Get the current date and time
                $currentDateTime = now()->format('Ymd_His');
                // Get the original file name
                $originalFileName = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                // Construct the new file name
                $fileName = $originalFileName . '_' . $currentDateTime . '_' . $uniqueId . '.' . $photo->getClientOriginalExtension();
                $path = $photo->storeAs('uploads/products', $fileName, 'public');
                $photoPaths[] = $path;
            }
            $product->photo = json_encode($photoPaths); // Storing paths as JSON
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = DB::table('products')
            ->leftJoin('categories', 'products.cat_id', '=', 'categories.id')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->select(
                'products.*',
                'categories.name as category_name',
                'brands.name as brand_name'
            )
            ->where('products.id', $id)
            ->first();

        if (!$product) {
            abort(404);
        }

        return view('pages.dashboard.admin.products.show', compact('product'));
    }

    // Product detail page for quick view and others individual product details
    public function oneProductDetails(string $slug)
    {
        $product = DB::table('products')
            ->leftJoin('categories', 'products.cat_id', '=', 'categories.id')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->select(
                'products.*',
                'categories.name as category_name',
                'brands.name as brand_name'
            )
            ->where('products.slug', $slug)
            ->first();

        if (!$product) {
            abort(404);
        }

        return view('pages.product.product', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        return view('pages.dashboard.admin.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string',
            'summary' => 'nullable|string',
            'description' => 'nullable|string',
            'photos' => 'nullable|array',
            'photos.*' => 'image',
            'stock' => 'nullable|integer',
            'size' => 'nullable|string',
            'condition' => 'nullable|string',
            'status' => 'nullable|string',
            'price' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'is_featured' => 'nullable|string',
            'cat_id' => 'nullable|string',
            'brand_id' => 'nullable|string',
        ]);

        $product = Product::findOrFail($id);
        $product->title = $request->input('title');
        $product->slug = Str::slug($request->input('title'), '-');
        $product->summary = $request->input('summary');
        $product->description = $request->input('description');
        $product->stock = $request->input('stock');
        $product->size = $request->input('size');
        $product->condition = $request->input('condition');
        $product->status = $request->input('status');
        $product->price = $request->input('price');
        $product->discount = $request->input('discount');
        $product->is_featured = $request->input('is_featured');
        $product->cat_id = $request->input('cat_id');
        $product->brand_id = $request->input('brand_id');

        if ($request->hasFile('photos')) {
            // Delete existing photos
            $existingPhotos = json_decode($product->photo);
            if ($existingPhotos) {
                foreach ($existingPhotos as $photo) {
                    Storage::disk('public')->delete($photo);
                }
            }

            // Store new photos
            $photoPaths = [];
            foreach ($request->file('photos') as $photo) {
                // Generate a unique ID for the file name
                $uniqueId = uniqid();
                // Get the current date and time
                $currentDateTime = now()->format('Ymd_His');
                // Get the original file name
                $originalFileName = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                // Construct the new file name
                $fileName = $originalFileName . '_' . $currentDateTime . '_' . $uniqueId . '.' . $photo->getClientOriginalExtension();

                $path = $photo->storeAs('uploads/products', $fileName, 'public');
                $photoPaths[] = $path;
            }

            $product->photo = json_encode($photoPaths);
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        if ($product->photo) {
            Storage::disk('public')->delete($product->photo);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    // Filtering for Product Page
    // public function allProductPage(Request $request)
    // {
    //     $query = Product::query()
    //         ->join('brands', 'products.brand_id', '=', 'brands.id')
    //         ->join('categories', 'products.cat_id', '=', 'categories.id')
    //         ->select('products.*', 'brands.name as brand_name', 'categories.name as category_name');

    //     // Sorting logic
    //     $sort = $request->input('sort', '0');
    //     $query->orderBy('products.created_at', $sort == '1' ? 'asc' : 'desc');

    //     // Category filtering
    //     if ($request->has('categories')) {
    //         $query->whereIn('products.cat_id', $request->input('categories'));
    //     }

    //     // Brand filtering
    //     if ($request->has('brands')) {
    //         $query->whereIn('products.brand_id', $request->input('brands'));
    //     }

    //     // Price range filtering
    //     if ($request->has(['price_min', 'price_max']) && is_numeric($request->input('price_min')) && is_numeric($request->input('price_max'))) {
    //         $priceMin = (float) $request->input('price_min');
    //         $priceMax = (float) $request->input('price_max');
    //         if ($priceMin <= $priceMax) {
    //             $query->whereBetween('products.price', [$priceMin, $priceMax]);
    //         }
    //     }

    //     // Pagination
    //     $perPage = $request->input('show', 20);
    //     $products = $query->paginate($perPage);

    //     return view('pages.product.all_product', compact('products'));
    // }

    public function allProductPage(Request $request)
    {
        $query = Product::query()
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->join('categories', 'products.cat_id', '=', 'categories.id')
            ->select('products.*', 'brands.name as brand_name', 'categories.name as category_name');

        // Sorting logic
        $sort = $request->input('sort', '0');
        $query->orderBy('products.created_at', $sort == '1' ? 'asc' : 'desc');

        // Category filtering
        if ($request->input('category') && $request->input('category') != '0') {
            $query->where('products.cat_id', $request->input('category'));
        }

        // Search term filtering (by slug or title)
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('products.title', 'like', '%' . $search . '%')
                    ->orWhere('products.slug', 'like', '%' . $search . '%');
            });
        }

        // Brand filtering
        if ($request->has('brands')) {
            $query->whereIn('products.brand_id', $request->input('brands'));
        }

        // Price range filtering
        if ($request->has(['price_min', 'price_max']) && is_numeric($request->input('price_min')) && is_numeric($request->input('price_max'))) {
            $priceMin = (float) $request->input('price_min');
            $priceMax = (float) $request->input('price_max');
            if ($priceMin <= $priceMax) {
                $query->whereBetween('products.price', [$priceMin, $priceMax]);
            }
        }

        // Pagination
        $perPage = $request->input('show', 20);
        $products = $query->paginate($perPage);

        return view('pages.product.all_product', compact('products'));
    }
}
