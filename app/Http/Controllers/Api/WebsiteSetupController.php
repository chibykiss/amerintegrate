<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
  
  public function visitor_location(Request $request)
  {
     $clientip = $request->ip();
    $loc_data = http::get("http://ip-api.com/json/$clientip");
    $data = json_decode($loc_data->body());
    return response()->json([
    	'status' => 'success',
      	'ip' => $data->countryCode,
     ]);
  }
}
