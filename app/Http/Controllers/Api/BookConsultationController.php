<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ConsultationNotificationMail;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookConsultationController extends Controller
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
            'fullname' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'string|required',
            'date' => 'string|required',
            'country' => 'required|string',
            'state' => 'required|string',
            'service_type' => 'string|required|',
          	'consultation_type' => 'string|required',
        ]);

        $check = Consultation::where([
            ['email', $request->email],
            ['service_type', $request->service_type],
          	['consultation_type',$request->consultation_type],
        ]);
        if($check->exists()){
            return response()->json([
                'status' => 'fail',
                'data' => [
                    'message' => 'already booked',
                ]
            ],409);
        }
        $create = Consultation::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'consult_date' => $request->date,
            'country' => $request->country,
            'state' => $request->state,
            'service_type' => $request->service_type,
          	'consultation_type' => $request->consultation_type,
           
        ]);
        if (!$create) {
            return response()->json([
                'status' => 'fail',
                'data' => [
                    'message' => 'booking request not sent',
                ]
            ]);
        }
    
        //return new ConsultationNotificationMail($request->all());
        //return $request->all();
        $data = $create->toArray();
        //return $data;
        try {
            Mail::to('info@amerintegrate.net')->send(new ConsultationNotificationMail($data));
            return response()->json([
                'status' => 'success',
                'data' => [
                    'email' => 'sent',
                    'message' => 'booking request submitted',
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'email' => $e->getMessage(),
                    'message' => 'booking request submitted',
                ]
                ]);
        }
    }
}
