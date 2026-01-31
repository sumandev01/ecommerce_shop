<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Web\HomeController;
use Illuminate\Support\Facades\Route;

// Route::controller(AdminController::class)->group(function () {
//     Route::get('/', 'index')->name('admin.root');
// });

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


@include('admin.php');