<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Create a query builder instance
        $query = User::query();
    
        // Check if the 'search' query parameter is present
        if ($request->has('search')) {
            $search = $request->input('search');
            // Filter users by name or email
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
        }
    
        // Fetch the filtered users with pagination
        $users = $query->orderBy('created_at', 'desc')->paginate(10);
    
        // Return the view with the users data
        return view('pages.dashboard.admin.users.index', compact('users'));
    }
    

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,admin,subadmin',
        ]);

        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.users')->with('success', 'User role updated successfully.');
    }

    public function editPassword(User $user)
    {
        return view('pages.dashboard.admin.users.edit_password', compact('user'));
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Password updated successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shared.register.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:6|required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);

        if ($request->hasFile('photo')) {
            // Get the file from the request
            $image = $request->file('photo');

            // Generate a unique ID for the file name
            $uniqueId = uniqid();

            // Get the current date and time
            $currentDateTime = now()->format('Ymd_His');

            // Get the original file name
            $originalFileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);

            // Construct the new file name
            $fileName = $originalFileName . '_' . $currentDateTime . '_' . $uniqueId . '.' . $image->getClientOriginalExtension();

            // Store the image in the storage directory with the constructed file name
            $path = $image->storeAs('uploads/users', $fileName, 'public');

            // Update the user's image field in the database
            $user->photo = $path;
        }

        $user->save();

        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('pages.dashboard.admin.users.user_details', compact('user'));
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
    public function destroy(string $id)
    {
        //
    }
}
