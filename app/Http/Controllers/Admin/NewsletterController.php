<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendbulkmailJob;
use App\Jobs\SendemailJob;
use App\Mail\NewsletterMail;
use App\Mail\sendBulkNewsletterMail;
use App\Models\Newsletter;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsletters = Newsletter::with('admin')->get();
        return view('admin.emails', ['newsletters' => $newsletters]);
    }
    
    public function allSubscribers(){
        $subscribers = Subscriber::all();
        return view('admin.createnewsletter', ['subscribers' => $subscribers]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createbulkemail');
    }
    
    /** create bulk email */
    
    public function createSingle($mail)
    {

        return view('admin.createemail', ['mail' => $mail]);
    }

    public function createResend()
    {

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /** send single email newsletter */


    public function sendEmail(Request $request)
    {

        //return $request->all();
        $request->validate([
            'reciever' => 'required|string',
            'subject' => 'required|string',
            'via' => 'required|string',
            'emailbody' => 'required|string',
        ]);
        $data = [
            'reciever' => $request->reciever,
            'subject' => $request->subject,
            'via' => $request->via,
            'emailbody' => $request->emailbody,
        ];

        //render mail
        // $mailable = new NewsletterMail($request->subject, $request->emailbody, $request->via);
        // return $mailable->render();
        //send Email
        //Mail::to($request->reciever)->send(new NewsletterMail($request));
        Mail::to($request->reciever)->send(new NewsletterMail($data));
        //dispatch(new SendemailJob($data));
        Newsletter::create([
            'admin_id' => auth()->user()->id,
            'subject' => $request->subject,
            'body' => $request->emailbody,
            'via' => $request->reciever,
            'send_status' => 'sent',
        ]);
        return back()->with('success', 'Email has been sent');
    }


    /** send bulk email */

    public function sendBulk(Request $request)
    {
        //return $request->all();
        $request->validate([
            'subject' => 'required|string',
            'via' => 'required|string',
            'emailbody' => 'required|string',
        ]);

        $data = [
            'subject' => $request->subject,
            'via' => $request->via,
            'emailbody' => $request->emailbody,
        ];

        //dispatch(new SendbulkmailJob($data));
        $subscribers = Subscriber::all();
        foreach ($subscribers as $subscriber) {
            $email = $subscriber->email;
            Mail::to($email)->send(new sendBulkNewsletterMail($data));
            //sleep(5);
        }
        Newsletter::create([
            'admin_id' => auth()->user()->id,
            'subject' => $request->subject,
            'body' => $request->emailbody,
            'via' => 'all_subscribers',
            'send_status' => 'sending',
        ]);
        return back()->with('success', 'emails are being sent in the background');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Newsletter $mail)
    {
        return view('admin.resendemail', ['newsletter' => $mail]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /** Resend A Edited newsletter */
    public function Resend(Request $request)
    {
        //return $request->all();
        $request->validate([
            'reciever' => 'required|string',
            'subject' => 'required|string',
            'via' => 'required|string',
            'emailbody' => 'required|string',
        ]);
        if($request->reciever === 'all_subscribers'){
            $data = [
                'subject' => $request->subject,
                'via' => $request->via,
                'emailbody' => $request->emailbody,
            ];

            dispatch(new SendbulkmailJob($data));
            Newsletter::create([
                'admin_id' => auth()->user()->id,
                'subject' => $request->subject,
                'body' => $request->body,
                'via' => 'all_subscribers',
                'send_status' => 'sending',
            ]);
            return back()->with('success', 'emails are being sent in the background');
        }
        $data = [
            'reciever' => $request->reciever,
            'subject' => $request->subject,
            'via' => $request->via,
            'emailbody' => $request->emailbody,
        ];
      	Mail::to($request->reciever)->send(new NewsletterMail($data));
        //dispatch(new SendemailJob($data));
        Newsletter::create([
            'admin_id' => auth()->user()->id,
            'subject' => $request->subject,
            'body' => $request->emailbody,
            'via' => $request->reciever,
            'send_status' => 'sending',
        ]);
        return back()->with('success', 'Email is being sent in the background');
    }
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Newsletter $mail)
    {
        $mail->delete();
        return back()->with('success', 'Message Deleted');
    }
}
