<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'comment' => 'required|string',
            'post_id' => 'required|numeric|exists:posts,id'
        ]);

        Comment::create([
            'post_id' => $request->post_id,
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
        ]);
        return response()->json([
            'status' => 'success',
            'data' => [
                'message' => 'comment added successfully',
            ]
        ]);
    }
    public function reply(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'reply' => 'required|string',
            'comment_id' => 'required|numeric|exists:comments,id'
        ]);

        Reply::create([
            'comment_id' => $request->comment_id,
            'name' => $request->name,
            'email' => $request->email,
            'reply' => $request->reply,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => [
                'message' => 'comment replied successfully',
            ]
        ]);

    }
}
