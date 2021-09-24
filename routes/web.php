<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PurchaseController;
use \App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);


Route::get('/', function () {
    return view('welcome');
})->name('login');

//\Illuminate\Support\Facades\Auth::logout();

Route::get('/users', [UserController::class, 'index']);

Route::group(['middleware' => 'auth'], function () {

    Route::post('/users', [UserController::class, 'store']);

// admin log in and add product routes.

    Route::get('/guest/cart', [CartController::class,'index']);

    Route::post('/guest/cart/{product}', [CartController::class, 'store']);

    Route::group(['middleware' => 'admin'], function () {

        Route::resources([
            '/admins/categories' => CategoryController::class,
            '/admins' => AdminController::class,
        ]);



        Route::post('/admins/{purchase}/confirm', [AdminController::class, 'confirm']);

        Route::post('/admins/products/create', [ProductController::class, 'store']);

    });

    Route::get('/guest', [GuestController::class, 'index']);

    Route::get('/guest/search', [ProductController::class, 'search']);


    Route::post('/guest/{purchase}/cancel', [GuestController::class, 'cancel']);

    Route::post('/purchase', [PurchaseController::class, 'store']);


});




