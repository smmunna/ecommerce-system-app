<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10); // Adjust pagination as needed
        return view('pages.dashboard.admin.basic_rules.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.dashboard.admin.basic_rules.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Store the new category
        $category = new Category();
        $category->name = $request->input('name');
        $category->slug = Str::slug($request->input('name')); // Generate slug from name
        $category->description = $request->input('description');
        $category->status = $request->input('status');

        // Handle photo upload and rename
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $uniqueId = uniqid();
            $currentDateTime = now()->format('Ymd_His');
            $originalFileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $originalFileName . '_' . $currentDateTime . '_' . $uniqueId . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads/categories', $fileName, 'public');
            $category->photo = $path;
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category added successfully.');
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
        $category = Category::findOrFail($id);
        return view('pages.dashboard.admin.basic_rules.category.edit', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        // Validate request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $category->name = $request->input('name');
        $category->slug = Str::slug($request->input('name')); // Generate slug from name
        $category->description = $request->input('description');
        $category->status = $request->input('status');

        // Handle photo upload and replace existing photo
        if ($request->hasFile('photo')) {
            // Delete the old photo if exists
            if ($category->photo) {
                Storage::disk('public')->delete($category->photo);
            }

            $image = $request->file('photo');
            $uniqueId = uniqid();
            $currentDateTime = now()->format('Ymd_His');
            $originalFileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $originalFileName . '_' . $currentDateTime . '_' . $uniqueId . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads/categories', $fileName, 'public');
            $category->photo = $path;
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        // Delete the associated photo if it exists
        if ($category->photo) {
            Storage::disk('public')->delete($category->photo);
        }

        // Delete the category
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
