<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [RegisteredUserController::class, 'register']);
Route::post('/login', [AuthenticatedSessionController::class, 'login']);

// Route untuk mendapatkan data user yang sedang login (Authenticated User)
Route::middleware('auth:sanctum')->get('user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->post('/logout', [AuthenticatedSessionController::class, 'destroy']);