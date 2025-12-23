<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return TagResource::collection($tags);
    }

    public function show($slug)
    {
        $tag = Tag::where('slug->' . app()->getLocale(), $slug)->firstOrFail();
        return new TagResource($tag);
    }
}
