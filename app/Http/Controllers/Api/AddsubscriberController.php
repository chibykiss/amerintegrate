<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class AddsubscriberController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email'
        ]);
        $add = Subscriber::create([
            'email' => $request->email,
        ]);
        if(!$add){
            return response()->json([
                'status' => 'fail',
                'data' => [
                    'message' => 'subscriber email not added',
                ]
            ]);
        }
        return response()->json([
            'status' => 'success',
            'data' => [
                'message' => 'subscriber email added',
            ]
        ]);
       
    }
}
