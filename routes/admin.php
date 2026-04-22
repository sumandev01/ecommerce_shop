<?php

use App\Enums\AuthEnums;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductInventoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AdminAuthController;
use Illuminate\Support\Facades\Route;


Route::controller(AdminAuthController::class)->prefix('admin')->group(function () {
    Route::get('/login', 'login')->name('admin.login');
    Route::post('/login', 'postLogin')->name('admin.postLogin');
    Route::get('/logout', 'logout')->name('admin.logout');
});

Route::middleware(['auth', 'role:' . AuthEnums::Admin->value])->prefix('admin')->group(function () {
    
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('admin.dashboard');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('user.index');
        Route::get('/users/create', 'create')->name('user.create');
        Route::post('/users/store', 'store')->name('user.store');
        Route::get('/users/{user}/view', 'view')->name('user.view');
        Route::get('/users/{user}/edit', 'edit')->name('user.edit');
        Route::put('/users/{user}/update', 'update')->name('user.update');
        Route::delete('/users/{user}/delete', 'destroy')->name('user.destroy');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('category.index');
        Route::post('/categories/store', 'store')->name('category.store');
        Route::get('/categories/{category}/edit', 'edit')->name('category.edit');
        Route::put('/categories/{category}/update', 'update')->name('category.update');
        Route::delete('/categories/{category}/delete', 'destroy')->name('category.destroy');
    });

    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/sub-categories', 'index')->name('subcategory.index');
        Route::post('/sub-categories/store', 'store')->name('subcategory.store');
        Route::get('/sub-categories/{subcategory}/edit', 'edit')->name('subcategory.edit');
        Route::put('/sub-categories/{subcategory}/update', 'update')->name('subcategory.update');
        Route::delete('/sub-categories/{subcategory}/delete', 'destroy')->name('subcategory.destroy');
    });

    Route::controller(BrandController::class)->group(function () {
        Route::get('/brands', 'index')->name('brand.index');
        Route::post('/brands/store', 'store')->name('brand.store');
        Route::get('/brands/{brand}/edit', 'edit')->name('brand.edit');
        Route::put('/brands/{brand}/update', 'update')->name('brand.update');
        Route::delete('/brands/{brand}/delete', 'destroy')->name('brand.destroy');
    });

    Route::controller(ColorController::class)->group(function () {
        Route::get('/colors', 'index')->name('color.index');
        Route::post('/colors/store', 'store')->name('color.store');
        Route::get('/colors/{color}/edit', 'edit')->name('color.edit');
        Route::put('/colors/{color}/update', 'update')->name('color.update');
        Route::delete('/colors/{color}/delete', 'destroy')->name('color.destroy');
    });

    Route::controller(SizeController::class)->group(function () {
        Route::get('/sizes', 'index')->name('size.index');
        Route::post('/sizes/store', 'store')->name('size.store');
        Route::get('/sizes/{size}/edit', 'edit')->name('size.edit');
        Route::put('/sizes/{size}/update', 'update')->name('size.update');
        Route::delete('/sizes/{size}/delete', 'destroy')->name('size.destroy');
    });

    Route::controller(TagController::class)->group(function () {
        Route::get('/tags', 'index')->name('tag.index');
        Route::post('/tags/store', 'store')->name('tag.store');
        Route::get('/tags/{tag}/edit', 'edit')->name('tag.edit');
        Route::put('/tags/{tag}/update', 'update')->name('tag.update');
        Route::delete('/tags/{tag}/delete', 'destroy')->name('tag.destroy');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('product.index');
        Route::get('/products/create', 'create')->name('product.create');
        Route::get('/products/{category}/subCategories', 'subCategories')->name('product.subCategories');
        Route::post('/products/store', 'store')->name('product.store');
        Route::get('/products/{product}/view', 'view')->name('product.view');
        Route::get('/products/{product}/categories', 'categories')->name('product.categories'); // ajax
        Route::get('/products/{product}/edit', 'edit')->name('product.edit');
        Route::put('/products/{product}/update', 'update')->name('product.update');
        Route::delete('/products/{product}/delete', 'destroy')->name('product.destroy');
    });

    Route::controller(ProductInventoryController::class)->group(function () {
        Route::get('/products/{product}/inventory', 'inventory')->name('product.inventory');
        Route::post('/products/{product}/inventory/store', 'store')->name('inventory.store');
        Route::post('/products/{inventory}/update', 'update')->name('inventory.update');
        Route::delete('/inventories/{inventory}/delete', 'destroy')->name('inventory.destroy');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders', 'index')->name('admin.order.index');
        Route::get('/orders/{order}/view', 'view')->name('admin.order.view');
        Route::get('/orders/{order}/edit', 'edit')->name('admin.order.edit');
        Route::put('/orders/{order}/update', 'update')->name('admin.order.update');
        Route::delete('/orders/{order}/delete', 'destroy')->name('admin.order.destroy');
    });

    Route::controller(CouponController::class)->group(function () {
        Route::get('/coupons', 'index')->name('coupon.index');
        Route::post('/coupons/store', 'store')->name('coupon.store');
        Route::get('/coupons/{coupon}/edit', 'edit')->name('coupon.edit');
        Route::post('/coupons/{coupon}/update', 'update')->name('coupon.update');
        Route::delete('/coupons/{coupon}/delete', 'destroy')->name('coupon.destroy');
    });

});