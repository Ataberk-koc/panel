<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['categories', 'tags'])->where('is_active', true)->get();
        return PostResource::collection($posts);
    }

    public function show($slug)
    {
        $post = Post::with(['categories', 'tags'])
            ->where('is_active', true)
            ->where('slug->' . app()->getLocale(), $slug)
            ->firstOrFail();
        return new PostResource($post);
    }
}
