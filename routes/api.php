<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('/password/reset', 'resetPassword');

});

Route::controller(ProductController::class)->group(function () {
    Route::get('products', 'index')->middleware('auth:api');
    Route::post('product', 'store');
    Route::get('product/{id}', 'show')->middleware('auth:api');
    Route::put('product/{id}', 'update');
    Route::delete('product/{id}', 'destroy');
});

Route::controller(UserController::class)->group(function () {
    Route::get('users', 'index')->middleware('auth:api');
    Route::get('user/{id}', 'show')->middleware('auth:api');
    Route::put('user/{id}', 'update')->middleware('auth:api');
    Route::delete('user/{id}', 'destroy');
});
