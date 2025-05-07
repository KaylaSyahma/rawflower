<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;

// Route::get('/{any}', function () {
//     return file_get_contents(public_path('index.html'));
// })->where('any', '.*');

// Route::prefix('api')->group(function () {
//     Route::get('/category/{category:slug}', [CategoryController::class, 'show']);
//     Route::get('/categories', [CategoryController::class, 'index']);
// });

Route::get('/{any}', function () {
    return file_get_contents(public_path('index.html'));
})->where('any', '^(?!api).*$');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
