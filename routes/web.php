<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarkerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('home');
});

Route::get('/maps', [MarkerController::class, 'index'])->name('markers.index');
Route::resource('markers', MarkerController::class);
Route::post('/markers/map', [MarkerController::class, 'storeFromMap'])->name('markers.storeFromMap');

Route::resource('blogs', BlogController::class);
Route::resource('comments', CommentController::class);

Route::resource('products', ProductController::class);

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::post('/cart/add/{product}', [CartController::class, 'store'])->name('cart.store');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/success', [OrderController::class, 'success'])->name('orders.success');
