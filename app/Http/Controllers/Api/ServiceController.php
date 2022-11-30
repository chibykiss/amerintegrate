<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function getServiceName()
    {
        $service_names = Services::select('name')->where('published_at','!=',null)->get();
        return response()->json([
            'status' => 'success',
            'data' => $service_names,
        ], 200);
    }
    
    public function index()
    {
        $services = Services::where('published_at','!=',null)->get();
        return response()->json([
            'status' => 'success',
            'data' => $services,
        ], 200);

    }
}
