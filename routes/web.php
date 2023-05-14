<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ProductController::class, 'welcome']);
Route::get('/product/{product}', [ProductController::class, 'prod_details']);


Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout']);


// Admin route

Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);

    // Admin Products Route
    Route::get('/admin/products', [ProductController::class, 'all']);
    Route::get('/admin/lowstocks', [ProductController::class, 'lowstocks']);
    Route::get('/admin/product/{product}', [ProductController::class, 'details']);
    Route::get('/admin/newproduct', [ProductController::class, 'createForm']);
    Route::post('/admin/newproduct', [ProductController::class, 'store']);
    Route::get('/admin/edit/{product}', [ProductController::class, 'editForm']);
    Route::patch('/admin/edit/{product}', [ProductController::class, 'update']);
    Route::patch('/admin/stock/{product}', [ProductController::class, 'addstock']);
    Route::delete('/admin/delete/{product}', [ProductController::class, 'destroy']);
});

// User route

Route::group(['middleware' => ['auth', 'user']], function () {

    Route::get('/dashboard', [UserController::class, 'dashboard']);

    // Wishlist Routes
    Route::delete('/wishdelete/{wishlist}', [WishlistController::class, 'destroy']);

    Route::get('/wishlist', [WishlistController::class, 'show']);
    Route::post('/wishlist', [WishlistController::class, 'store']);
});
