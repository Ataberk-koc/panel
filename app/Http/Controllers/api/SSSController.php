<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SSSResource;
use App\Models\SSS;
use Illuminate\Http\Request;

class SSSController extends Controller
{
    public function index()
    {
        $sss = SSS::all();
        return SSSResource::collection($sss);
    }

    public function show($id)
    {
        $sss = SSS::findOrFail($id);
        return new SSSResource($sss);
    }
}
