<?php

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

Route::get('/login', function () {
    return view('shared.login.login');
})->name('login');

Route::get('/register', function () {
    return view('shared.register.register');
})->name('register');


Route::get('/products-details', function () {
    return view('pages.product.product');
});

Route::get('/checkout', function () {
    return view('pages.checkout.checkout');
});
Route::get('/dashboard', function () {
    return view('pages.dashboard.dashboard');
});
Route::get('/cart', function () {
    return view('pages.cart.cart');
});
