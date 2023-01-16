<?php

namespace App\Http\Controllers\Admin;

use App\Events\ApproveConsultationEvent;
use App\Http\Controllers\Controller;
use App\Mail\sendConsultationEmail;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ConsultationController extends Controller
{
    //
    public function index()
    {
        $consulatations = Consultation::orderBy('id', 'desc')->get();
        return view('admin.consultations', ['consultations' => $consulatations]);
    }

    public function approve($id)
    {
        $consultate = Consultation::find($id);
        $approved = $consultate->update([
            'approved' => 1,
        ]);
        // $data = [
        //     'reciever' => $id->email,
        //     'name' => $id->fullname,
        //     'service_type' => $id->service_type,
        //     'date' => $id->consult_date,
        // ];
        if($approved){
            ApproveConsultationEvent::dispatch($consultate);
            return back()->with('success', 'Consultation time Approved');
        }
        return back()->with('fail', 'consulation approval failed');
    }

    public function consultEmail($email){
        return view('admin.consultemail', ['email' => $email]);
    }

    public function sendConsultEmail(Request $request)
    {
        //return $request->all();
        $request->validate([
            'reciever' => 'required|string',
            'subject' => 'required|string',
            'via' => 'required|string',
            'emailbody' => 'required|string',
        ]);
        $data = [
            'subject' => $request->subject,
            'via' => $request->via,
            'emailbody' => $request->emailbody,
        ];

        /** Send Mail */
        try {
            Mail::to($request->reciever)->send(new sendConsultationEmail($data));
            return redirect('consultation')->with('success', 'Email sent');
        } catch (\Exception $e) {
           return $e->getMessage();
            return redirect('consultation')->with('fail', $e->getMessage());
        }
      
    
    }
}
