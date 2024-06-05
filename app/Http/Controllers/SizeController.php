<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    //showing the size 
    public function index()
    {
        $sizes = Size::orderBy('created_at', 'desc')->paginate(10);
        return view('pages.dashboard.admin.basic_rules.size.index', compact('sizes'));
    }

    // Creating the size
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255|unique:sizes,name',
        ]);

        // Create a new size
        $size = new Size();
        $size->name = $request->input('name');
        $size->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Size created successfully.');
    }

    // Deleting the size
    public function destroy($id)
    {
        $size = Size::findOrFail($id);
        $size->delete();

        return redirect()->back()->with('success', 'Size deleted successfully.');
    }
}
