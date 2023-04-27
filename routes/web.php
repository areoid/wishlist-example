<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WishlistController;

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
});

Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/category/add', [WishlistController::class, 'storeCategory'])->name('wishlist.storeCategory');
Route::get('/wishlist/category', [WishlistController::class, 'category'])->name('wishlist.category');
Route::get('/wishlist/data', [WishlistController::class, 'data'])->name('wishlist.data');
Route::get('/wishlist/shop', [WishlistController::class, 'shop'])->name('wishlist.shop');