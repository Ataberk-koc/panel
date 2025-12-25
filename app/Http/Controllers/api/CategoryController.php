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
        // Sadece aktif olanları ve üst kategorisini getir
        $categories = Category::where('is_active', true)
            ->with('parent')
            ->get();

        // Resource ile paketleyip yolla
        return CategoryResource::collection($categories);
    }

    public function show($slug)
    {
        $category = Category::where('is_active', true)
            ->where('slug->' . app()->getLocale(), $slug)
            ->with('parent')
            ->firstOrFail();
        return new CategoryResource($category);
    }
}