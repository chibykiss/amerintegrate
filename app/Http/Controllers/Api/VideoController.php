<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::where('published_at', '!=', null)->get();
        return response()->json([
            'status' => 'success',
            'data' => $videos,
        ], 200);
    }

    public function show($video)
    {
        $vid = Video::where([
            ['id', $video],
            ['published_at', '!=', null],
        ])->first();
        return response()->json([
            'status' => 'success',
            'data' => $vid,
        ], 200);
    }
}
