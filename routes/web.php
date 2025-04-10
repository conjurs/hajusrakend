<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarkerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\MonsterPageController;
use App\Http\Controllers\ApiViewerController;

Route::get('/', function () {
    return view('home');
});

Route::get('/maps', [MarkerController::class, 'index'])->name('maps.index');
Route::resource('markers', MarkerController::class);
Route::post('/markers/map', [MarkerController::class, 'storeFromMap'])->name('markers.storeFromMap');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('blogs', BlogController::class);
Route::resource('comments', CommentController::class);

Route::middleware(['web', 'auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/users/{user}/ban', [AdminController::class, 'banUser'])->name('admin.users.ban');
    Route::post('/admin/users/{user}/unban', [AdminController::class, 'unbanUser'])->name('admin.users.unban');
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
});

Route::resource('products', ProductController::class);

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::post('/cart/add/{product}', [CartController::class, 'store'])->name('cart.store');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/success', [OrderController::class, 'success'])->name('orders.success');

Route::get('/weather', [WeatherController::class, 'index'])->name('weather.index');
Route::get('/weather/get', [WeatherController::class, 'getWeather'])->name('weather.get');

Route::get('/monsters', [MonsterPageController::class, 'index'])->name('monsters.index');
Route::post('/monsters', [MonsterPageController::class, 'store'])->name('monsters.store');
Route::delete('/monsters/{monster}', [MonsterPageController::class, 'destroy'])
    ->middleware(['auth', 'admin'])
    ->name('monsters.destroy');

Route::get('/api-viewer', [ApiViewerController::class, 'index'])->name('api-viewer.index');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
});
    