<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendContactController extends Controller
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
            'name' => 'string|required',
            'email' => 'string|required',
            'phone' => 'string',
            'message' => 'required|string',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => isset($request->phone) ? $request->phone : 'Not Added',
            'message' => $request->message,
        ];

        Mail::to('info@amerintegrate.com')->send(new ContactFormMail($data));
        return response()->json([
            'status' => 'success',
            'data' => [
                'message' => 'mail sent',
            ]
        ]);
    }
}
