
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController; // Controller'ı import ettiğinden emin ol
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\SSSController;
    

// Laravel 11'de default gelen user rotası (kalsın zararı yok)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// SENİN EKLEDİĞİN ROTALAR
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{slug}', [CategoryController::class, 'show']);

Route::get('/sss', [SSSController::class, 'index']);
Route::get('/sss/{id}', [SSSController::class, 'show']);

Route::get('/sliders', [SliderController::class, 'index']);
Route::get('/sliders/{id}', [SliderController::class, 'show']);

Route::get('/settings', [SettingController::class, 'index']);
Route::get('/settings/{id}', [SettingController::class, 'show']);

Route::get('/sections', [SectionController::class, 'index']);
Route::get('/sections/{id}', [SectionController::class, 'show']);

Route::get('/languages', [LanguageController::class, 'index']);
Route::get('/languages/{id}', [LanguageController::class, 'show']);

Route::get('/galleries', [GalleryController::class, 'index']);
Route::get('/galleries/{id}', [GalleryController::class, 'show']);

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{slug}', [PostController::class, 'show']);

Route::get('/tags', [TagController::class, 'index']);
Route::get('/tags/{slug}', [TagController::class, 'show']);

Route::get('/contacts', [ContactController::class, 'index']);
Route::get('/contacts/{id}', [ContactController::class, 'show']);