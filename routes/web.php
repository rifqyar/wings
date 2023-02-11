<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\WhishlistsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware('auth')->group(function () {
    Route::get('/', [ProductsController::class, 'index']);
    Route::get('/dashboard', [ProductsController::class, 'index'])->name('dashboard');

    // Profile Route
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Product Route
    Route::get('/product/{id}/detail', [ProductsController::class, 'show'])->name('product.detail');

    // Chart Route
    Route::get('/cart', [CartsController::class, 'index'])->name('carts');
    Route::get('/cart/add/{id}', [CartsController::class, 'store'])->name('carts.store');
    Route::get('/cart/remove/{id}', [CartsController::class, 'destroy'])->name('carts.remove');

    // Transaction
    Route::post('/transaction/checkout', [TransactionsController::class, 'store'])->name('checkout');
    Route::get('/report', [TransactionsController::class, 'index'])->name('report');

    //Whishlist Route
    Route::get('/whishlist', [WhishlistsController::class, 'index'])->name('whishlist');
    Route::get('/whishlist/{id}', [WhishlistsController::class, 'store'])->name('whishlist.product');
    Route::get('/whishlist/remove/{id}', [WhishlistsController::class, 'destroy'])->name('whishlist.remove');
});

require __DIR__.'/auth.php';
