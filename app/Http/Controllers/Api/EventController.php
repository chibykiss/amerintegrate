<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;
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

    public function getPastEvents()
    {
        $pastEvent = Event::where([
            ['event_date', '<', Carbon::now()],
            ['published_at', '!=', null],
            ])->get();
        return response()->json([
            'status' => 'success',
            'data' => $pastEvent,
        ],200);
    }

    public function getFutureEvents()
    {
        $futureEvent = Event::where([
            ['event_date', '>', Carbon::now()],
            ['published_at', '!=', null],
        ])->get();
        return response()->json([
            'status' => 'success',
            'data' => $futureEvent,
        ], 200);
    }
}
