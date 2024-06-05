<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/products-all', function () {
    return view('pages.product.all_product');
})->name('all_products');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authentication'])->name('login.user');

Route::get('/register', [UserController::class, 'create'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register.user');


Route::get('/products-details', function () {
    return view('pages.product.product');
});

Route::get('/checkout', function () {
    return view('pages.checkout.checkout');
});

Route::get('/cart', function () {
    return view('pages.cart.cart');
});


Route::resource('users', UserController::class);

// Admin Routes
Route::middleware('checkUserRole:admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('/edit-profile', [AuthController::class, 'editProfile'])->name('edit.profile');
    // Categories
    Route::resource('categories', CategoryController::class);
    // Add more routes as needed...
});

// User Routes
Route::middleware('checkUserRole:user')->prefix('user')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('/edit-profile', [AuthController::class, 'editProfile'])->name('edit.profile');
    Route::put('/update-profile', [AuthController::class, 'updateProfile'])->name('update.profile');
    // Add more routes as needed...
});

// Logout User
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
