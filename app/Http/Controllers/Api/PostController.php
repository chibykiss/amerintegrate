<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::withCount('comments')->where('published_at', '!=', null)->get();
        return response()->json([
            'status' => 'success',
            'data' => $posts,
        ], 200);
    }

    public function show($post)
    {
        $pst = Post::with('comments.replies')->where([
            ['id', $post],
            ['published_at', '!=', null],
        ])->first();
        return response()->json([
            'status' => 'success',
            'data' => $pst,
        ], 200);
    }
    public function latest()
    {
        $latest = Post::latest()->where('published_at', '!=', null)->take(3)->get();
        return response()->json([
            'status' => 'success',
            'data' => $latest,
        ], 200);
    }
}
