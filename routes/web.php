<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\Auth\AuthController;


Route::get('/', function () {
    return view('welcome');
});


// Guest Route
Route::group(['middleware' => 'guest'], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::post('/post-login', [AuthController::class, 'login']);
        
})->middleware('guest');

// Admin Route
Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', function () {
        return view('pages.admin.index');
    })->name('admin.dashboard');

    Route::get('/admin-logout', [AuthController::class, 'admin_logout'])
        ->name('admin.logout')
        ->middleware('admin');
})->middleware('admin');

// User Route
Route::group(['middleware' => 'web'], function () {
    Route::get('/user', function () {
        return view('pages.user.index');
    })->name('user.dashboard');

    Route::get('/user-logout', [AuthController::class, 'user_logout'])
        ->name('user.logout');
        
})->middleware('web');