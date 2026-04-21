<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\CheckoutController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\Web\WishlistController;
use Illuminate\Support\Facades\Route;


Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('root');
    Route::get('/shop', 'shop')->name('shop');
    Route::get('/about', 'about')->name('about');
    Route::get('/faq', 'faq')->name('faq');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/compare', 'compare')->name('compare');
    Route::get('/product/{slug}', 'singleProduct')->name('singleProduct');
    Route::get('/get-produt-variant-inventory', 'getProdutVariantInventory')->name('getProdutVariantInventory');
    Route::get('/recently-view', 'recentViews')->name('recentViews');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'postLogin')->name('postLogin');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'postRegister')->name('postRegister');
});

Route::middleware('auth')->group(function () {
    // Dashboard Route
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/user/dashboard', 'index')->name('user.dashboard');
        Route::get('/user/orders', 'orders')->name('user.orders');
        Route::get('/order/{order}/details', 'orderDetails')->name('order-details');
        Route::get('/user/profile', 'profile')->name('user.profile');
        Route::post('/user/profile', 'updateProfile')->name('user.updateProfile');
        Route::get('/user/change-password', 'changePassword')->name('user.changePassword');
        Route::post('/user/change-password', 'updatePassword')->name('user.updatePassword');
    });

    // Cart Route
    Route::controller(CartController::class)->group(function () {
        Route::get('/cart', 'cart')->name('cart');
        Route::post('/cart', 'addToCart')->name('addToCart');
        Route::post('/cart/update', 'updateCart')->name('cart.update');
        Route::get('/cart/{cart}', 'destroy')->name('cart.destroy');
        Route::post('coupon/apply', 'applyCoupon')->name('coupon.apply');
    });

    // Wishlist Route
    Route::controller(WishlistController::class)->group(function () {
        Route::get('/wishlist', 'index')->name('wishlist');
        Route::get('/wishlist/{product}/add', 'wishlistStore')->name('wishlist.store');
        Route::get('/wishlist/{product}/delete', 'destroy')->name('wishlist.destroy');
    });

    // Checkout Route
    Route::controller(CheckoutController::class)->group(function () {
        Route::post('/checkout', 'index')->name('checkout.index');
        Route::get('/checkout', 'index')->name('checkout.index');
    });

    // Order Route
    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders/store', 'store')->name('orders.store');
        Route::get('/order/success', 'success')->name('order.success');
    });
});


// @include('admin.php');
require __DIR__ . '/admin.php';