<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Sadece aktif olanları getir
        $categories = Category::where('is_active', true)->get();

        // Resource ile paketleyip yolla
        return CategoryResource::collection($categories);
    }

    public function show($slug)
    {
        $category = Category::where('is_active', true)
            ->where('slug->' . app()->getLocale(), $slug)
            ->firstOrFail();
        return new CategoryResource($category);
    }
}