<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\MessageController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth (Breeze)
require __DIR__.'/auth.php';

// Public
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Authenticated customer routes
Route::middleware(['auth'])->group(function () {
    Route::get('/review',   [ReviewController::class, 'create'])->name('review.create');
    Route::post('/review',  [ReviewController::class, 'store'])->name('review.store');
    Route::get('/cart',     [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add',[CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{rowId}',[CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{rowId}',[CartController::class, 'remove'])->name('cart.remove');
    Route::get('/checkout',    [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/midtrans-token',[CheckoutController::class,'createMidtransToken'])->name('checkout.midtransToken');
    Route::post('/checkout/stripe-intent',[CheckoutController::class,'createStripeIntent'])->name('checkout.stripeIntent');
    Route::get('/checkout/success',[CheckoutController::class,'success'])->name('checkout.success');
    Route::get('/orders',          [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}',  [OrderController::class, 'show'])->name('orders.show');
});

// Webhooks (no CSRF)
Route::post('/midtrans/notification',[CheckoutController::class,'midtransWebhook'])
     ->name('midtrans.webhook')
     ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::post('/stripe/webhook',[CheckoutController::class,'stripeWebhook'])
     ->name('stripe.webhook')
     ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

// Admin routes
Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/',[Admin\DashboardController::class,'index'])->name('dashboard');
    Route::resource('products', Admin\ProductController::class);
    Route::resource('users',    Admin\UserController::class);
    Route::resource('news',     Admin\NewsController::class);
    Route::resource('messages', Admin\MessageController::class);
    Route::resource('reviews',  Admin\ReviewController::class)->only(['index','show','destroy']);
    Route::resource('orders',   Admin\OrderController::class)->only(['index','show']);
    Route::patch('orders/{order}/status',[Admin\OrderController::class,'updateStatus'])->name('orders.updateStatus');
    Route::patch('variants/{variant}/stock',[Admin\ProductController::class,'updateStock'])->name('variants.stock');
});