<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\API\APIAuthController; // <- tambahin ini buat login via API
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ✅ AUTH SANCTUM: login & register versi API
Route::post('/register', [RegisteredUserController::class, 'register']); // opsional, kalo kamu bikin juga
Route::post('/login', [APIAuthController::class, 'login']);

// ✅ Route untuk dapetin data user yg udah login (via token)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json($request->user());
});

// ✅ Logout (hapus token)
Route::middleware('auth:sanctum')->post('/logout', [APIAuthController::class, 'logout']);

// ✅ CATEGORY
Route::get('/category/{category:slug}', [CategoryController::class, 'show']);
Route::apiResource('/categories', CategoryController::class);

// ✅ PRODUCT
Route::get('/products/popular', [ProductController::class, 'popular']);
Route::get('/products/{id}/detail', [ProductController::class, 'showDetail'])->name('detail');
Route::apiResource('/products', ProductController::class);

// ✅ BLOG
Route::apiResource('/blogs', BlogController::class);
