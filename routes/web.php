<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CuponController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
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

Route::get('/all-products', [ProductController::class, 'allProductPage'])->name('all_products');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authentication'])->name('login.user');

Route::get('/register', [UserController::class, 'create'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register.user');

// Product details
Route::get('/products-details/{slug}', [ProductController::class, 'oneProductDetails'])->name('product.details');
// Add to cart
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('addToCart');
Route::delete('/delete-from-cart/{id}', [CartController::class, 'deleteFromCart'])->name('deleteFromCart');
Route::delete('/update-cart', [CartController::class, 'updateCart'])->name('updateCart');

// Cupons
Route::post('/apply-coupon', [CartController::class, 'applyCoupon'])->name('applyCoupon');
// Checkout
Route::get('/checkout', [CheckoutController::class, 'checkoutPage'])->name('checkoutPage');

// Cart Items
Route::get('/cart', function () {
    return view('pages.cart.cart');
})->name('myCartItem');

// Wishlist 
Route::get('/wishlist', [WishlistController::class, 'wishlist'])->name('wishlist');
Route::post('/add-to-wishlist', [WishlistController::class, 'addToWishlist'])->name('add.wishlist');
Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'removeFromWishlist'])->name('remove.wishlist');

// Users
Route::resource('users', UserController::class);
// Reviews
Route::resource('reviews', ReviewController::class);


// Admin Routes
Route::middleware('checkUserRole:admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/profile', [AuthController::class, 'profile'])->name('admin.profile');
    Route::get('/edit-profile', [AuthController::class, 'editProfile'])->name('admin.edit.profile');
    // Categories
    Route::resource('categories', CategoryController::class);
    // Size
    Route::get('/size', [SizeController::class, 'index'])->name('admin.size');
    Route::post('/size', [SizeController::class, 'store'])->name('create.size');
    Route::delete('/sizes/{id}', [SizeController::class, 'destroy'])->name('sizes.destroy');
    // Settings
    Route::get('/settings', [SettingController::class, 'setting'])->name('settings');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    // Brand
    Route::resource('brands', BrandController::class);
    // Products
    Route::resource('products', ProductController::class);
    // Cupons
    Route::resource('cupons', CuponController::class);

    // Add more routes as needed...
});

// Update Profile
Route::put('/update-profile', [AuthController::class, 'updateProfile'])->name('update.profile');

// User Routes
Route::middleware('checkUserRole:user')->prefix('user')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/profile', [AuthController::class, 'profile'])->name('user.profile');
    Route::get('/edit-profile', [AuthController::class, 'editProfile'])->name('user.edit.profile');
    // Add more routes as needed...
});

// Logout User
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
