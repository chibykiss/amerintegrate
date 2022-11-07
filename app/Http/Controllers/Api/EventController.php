<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('published_at','!=',null)->get();
        return response()->json([
            'status' => 'success',
            'data' => $events,
        ],200);
    }

    public function show($event)
    {
        $evnt = Event::where([
            ['id',$event],
            ['published_at', '!=', null],
        ])->first();
        return response()->json([
            'status' => 'success',
            'data' => $evnt,
        ],200);
    }
}
