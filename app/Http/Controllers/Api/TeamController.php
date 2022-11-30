<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $members = Team::where('published_at', '!=', null)->get();
        return response()->json([
            'status' => 'success',
            'data' => $members,
        ], 200);
    }
}
