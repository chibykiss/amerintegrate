<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaystackConfirmPaymentController extends Controller
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
            'trnxref' => 'string|required'
        ]);
        try {
            
            $response = Http::withToken(env('PAYSTACK_SECRET'))->get("https://api.paystack.co/transaction/verify/$request->trnxref");
            return response()->json([
                'status' => 'success',
                'data' => json_decode($response->body())
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
