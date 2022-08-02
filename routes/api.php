<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * 
 * PUBLIC ROUTES
 * 
 **/

// essential middlewares
Route::group(['middleware' => ['cors', 'json.response']], function () {


    // USER
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'store']);
    Route::get('/users', [UserController::class, 'index']);

    //CATEGORY
    Route::get('/categories', [CategoryController::class, 'index']);

    //PRODUCT
    Route::get('/products', [ProductController::class, 'index']);


    /**
     * 
     * PRIVATE ROUTES
     * 
     **/

    Route::group(['middleware' => ['auth:sanctum']], function () {


        // USER
        Route::post('logout', [UserController::class, 'logout']);
        Route::post('/users/{user}', [UserController::class, 'update']);
        Route::get('/users/{user}', [UserController::class, 'show']);
        Route::delete('/users/{user}', [UserController::class, 'destroy']);


        //CATEGORY
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::post('/categories/{category}', [CategoryController::class, 'update']);
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

        Route::get('/wishlists', [WishlistController::class, 'index']);
        Route::post('/wishlists', [WishlistController::class, 'store']);
        Route::get('/wishlists/{wishlist}', [WishlistController::class, 'show']);
        Route::delete('/wishlists/{wishlist}', [WishlistController::class, 'destroy']);


        //PRODUCT
        Route::post('/products', [ProductController::class, 'store']);
        Route::get('/products/{product}', [ProductController::class, 'show']);
        Route::post('/products/{product}', [ProductController::class, 'update']);
        Route::delete('/products/{product}', [ProductController::class, 'destroy']);

        //ORDERS
        Route::get('/orders', [OrderController::class, 'index']);
        Route::post('/orders', [OrderController::class, 'store']);
        Route::post('/orders/{order}', [OrderController::class, 'update']);
        Route::delete('/orders/{order}', [OrderController::class, 'destroy']);


        /**
         * 
         * ADMIN ONLY ROUTES
         * things like creating post and viewing 
         * all orders should be allowed to admin only
         * 
         **/

        Route::group(['middleware' => ['admin']], function () {
            Route::get('/hi', function () {
                return 'hi';
            });
        });
    });
});