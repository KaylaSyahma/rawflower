<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\API\APIAuthController; // <- tambahin ini buat login via API
use App\Http\Controllers\Api\CustomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [RegisteredUserController::class, 'register']);
Route::post('/login', [APIAuthController::class, 'login']);

// route untuk mendapatkan data user yang sedang login (authenticated User)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });
    
    Route::get('/custom', [CustomController::class, 'index']);
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/add', [CartController::class, 'add']);
    Route::patch('/cart/update/{itemId}', [CartController::class, 'update']);
    Route::delete('/cart/remove/{itemId}', [CartController::class, 'remove']);
    Route::post('/cart/checkout', [CartController::class, 'checkout']);
});

Route::middleware('auth:sanctum')->post('/logout', [AuthenticatedSessionController::class, 'destroy']);

Route::apiResource('/slider', SliderController::class);

Route::get('/category/{category:slug}', [CategoryController::class, 'show']);
Route::apiResource('/categories', CategoryController::class);

Route::get('/custom', [CustomController::class, 'index']);

// ✅ PRODUCT
Route::get('/products/popular', [ProductController::class, 'popular']);
Route::get('/products/{id}/detail', [ProductController::class, 'showDetail'])->name('detail');
Route::apiResource('/products', ProductController::class);

// ✅ BLOG
Route::apiResource('/blogs', BlogController::class);
Route::get('/blogs/{id}', [BlogController::class, 'show']);