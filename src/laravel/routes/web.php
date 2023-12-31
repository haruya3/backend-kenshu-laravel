<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group( function () {
    Route::get('/posts', [\App\Http\Controllers\PostController::class, 'indexAndCreate']);
    Route::post('/posts', [\App\Http\Controllers\PostController::class, 'createPost']);
    Route::get('posts/{id}', [\App\Http\Controllers\PostController::class, 'getDetailPage']);
    Route::get('posts/{id}/edit', [\App\Http\Controllers\PostController::class, 'getEditPage']);
    Route::put('/posts/{id}', [\App\Http\Controllers\PostController::class, 'update']);
    Route::delete('/posts/{id}', [\App\Http\Controllers\PostController::class, 'delete']);
});
