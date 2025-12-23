<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        return SectionResource::collection($sections);
    }

    public function show($id)
    {
        $section = Section::findOrFail($id);
        return new SectionResource($section);
    }
}
