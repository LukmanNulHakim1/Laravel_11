<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\DistributorController;


// Guest Route
Route::group(['middleware' => 'guest'], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/post-register', [AuthController::class, 'post_register'])->name('post.register');
    Route::post('/post-login', [AuthController::class, 'login']);
});

// Admin Route
Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Product Routes for Admin
    Route::get('/product', [ProductController::class, 'index'])->name('admin.product');
    Route::get('/admin-logout', [AuthController::class, 'admin_logout'])->name('admin.logout');

    // Routes distributor


    Route::get('/distributor', [DistributorController::class, 'index'])->name('admin.distributor');
    Route::post('/distributor/import', [DistributorController::class, 'import'])->name('distributor.import');
    Route::get('/distributor/export', [DistributorController::class, 'export'])->name('distributor.export');
    Route::post('/distributor/store', [DistributorController::class, 'store'])->name('distributor.store');
    Route::get('/distributor/create', [DistributorController::class, 'create'])->name('distributor.create');
    Route::get('/distributor/edit/{id}', [DistributorController::class, 'edit'])->name('distributor.edit');
    Route::post('/distributor/update/{id}', [DistributorController::class, 'update'])->name('admin.distributor.update');
    Route::delete('/distributor/delete/{id}', [DistributorController::class, 'delete'])->name('distributor.delete');
});

// User Route
Route::group(['middleware' => 'web'], function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/user-logout', [AuthController::class, 'user_logout'])->name('user.logout');
});

// Product Routes
// Admin
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('/admin/product/detail/{id}', [ProductController::class, 'detail'])->name('product.detail');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

// Distributor

// User
Route::get('/user/product/detail/{id}', [UserController::class, 'detail_produk'])->name('user.detail.product');
Route::get('/product/purchase/{productId}/{userId}', [UserController::class, 'purchase']);
