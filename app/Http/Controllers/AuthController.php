<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    //Login view
    public function login()
    {
        return view('shared.login.login');
    }

    // Login functionality
    public function authentication(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication successful
            $user = Auth::user();
            switch ($user->role) {
                case 'admin':
                    // Redirect to the admin dashboard
                    return redirect()->route('admin.dashboard');
                    break;
                case 'user':
                    // Redirect to the user dashboard
                    return redirect()->route('user.dashboard');
                    break;
                default:
                    // Redirect to the default dashboard or the intended URL
                    return redirect()->intended('/');
                    break;
            }
        }
        // Authentication failed
        return redirect()->back()->with('failure', 'Invalid username or password');
    }

    // Profile Information
    public function profile()
    {
        return view('pages.dashboard.profile.profile');
    }

    public function editProfile()
    {
        return view('pages.dashboard.profile.edit_profile');
    }
    public function updateProfile(Request $request)
    {
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Fetch the user model based on the authenticated user's ID
        $user = User::findOrFail($userId);

        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            'password' => 'nullable|string|min:6', // Nullable password field
        ]);

        // Update name, phone, and address
        $user->name = $validatedData['name'];
        $user->phone = $validatedData['phone'];
        $user->address = $validatedData['address'];

        // Handle photo upload and rename
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $uniqueId = uniqid();
            $currentDateTime = now()->format('Ymd_His');
            $originalFileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $originalFileName . '_' . $currentDateTime . '_' . $uniqueId . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads/users', $fileName, 'public');

            // Delete existing photo
            if ($user->photo) {
                Storage::delete('public/' . $user->photo);
            }

            // Update user photo with new filename
            $user->photo = $path;
        }

        // Update password if provided
        if ($validatedData['password']) {
            $user->password = Hash::make($validatedData['password']);
        }

        // Save the updated user profile
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
