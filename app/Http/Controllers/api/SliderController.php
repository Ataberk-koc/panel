<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResource;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return SliderResource::collection($sliders);
    }

    public function show($id)
    {
        $slider = Slider::findOrFail($id);
        return new SliderResource($slider);
    }
}
