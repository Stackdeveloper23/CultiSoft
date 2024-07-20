<?php

use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function(){
//public
   Route::get('/shop',[HomeController::class, 'index']);
   Route::get('/product',[ProductController::class, 'index']);
   Route::get('/product/{slug}', [ProductController::class, 'show']);
   Route::post('/auth/register', [AuthController::class, 'register']);
   Route::post('/auth/login',[AuthController::class, 'login'])->name('login');
   
   //private
   Route::group(['middleware' => 'auth:sanctum'], function (){

   //logout
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    
    Route::get('/shop',[CustomerController::class]);

//shopping Card

Route::get('/cart', [CartController::class, 'show']);
Route::post('/cart/add/{productId}', [CartController::class, 'add']);
Route::delete('/cart/remove/{itemId}', [CartController::class, 'remove']);
Route::post('/cart/clear', [CartController::class, 'clear']);


//Admin
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/admin', 'AdminController@index')->name('admin.index');
    
        Route::resource('/admin/products', ProductController::class);
        Route::resource('/admin/categories', CategoryController::class);
        //Route::apiResource('/admin/orders', [OrderController::class]);
        Route::resource('/admin/users', UserController::class);
    });
  });
});