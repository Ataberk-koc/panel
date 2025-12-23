<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController; // Controller'ı import ettiğinden emin ol
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\TagController;


// Laravel 11'de default gelen user rotası (kalsın zararı yok)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// SENİN EKLEDİĞİN ROTALAR
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{slug}', [CategoryController::class, 'show']);

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{slug}', [PostController::class, 'show']);

Route::get('/tags', [TagController::class, 'index']);
Route::get('/tags/{slug}', [TagController::class, 'show']);