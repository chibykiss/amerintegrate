<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Donatation;
use Illuminate\Http\Request;

class PaypalStorePaymentDetailsController extends Controller
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
            'id' => 'required|unique:donatations,signature',
            'name' => 'required|string',
            'email' => 'required|email',
            'currency' => 'required|string',
            'amount' => 'required|string',
            'status' => 'required|string',
        ]);

        $donate = Donatation::create([
            'signature' => $request->id,
            'name' => $request->name,
            'email' => $request->email,
            'currency' => $request->currency,
            'amount' => $request->amount,
            'gateway' => 'paypal',
            'status' => $request->status,
        ]);

        if($donate){
            return response()->json([
                'status' => 'success',
                'data' => [
                    'message' => 'stored successfully'
                ]
            ]);
        }
        return response()->json([
            'status' => 'fail',
            'data' => [
                'message' => 'not stored'
            ]
        ]);
    }
}
