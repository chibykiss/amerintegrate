<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetup;
use Illuminate\Http\Request;

class WebsiteSetupController extends Controller
{
    public function address()
    {
        $website_address = WebsiteSetup::select('website_address')->first();
        return response()->json([
            'status' => 'success',
            'data' => $website_address,
        ], 200);
    }
}
