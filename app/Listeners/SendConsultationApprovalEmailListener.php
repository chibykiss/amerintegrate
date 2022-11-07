<?php

namespace App\Listeners;

use App\Events\ApproveConsultationEvent;
use App\Mail\ConsultationApprovalMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendConsultationApprovalEmailListener
{
  
    /**
     * Handle the event.
     *
     * @param  \App\Events\ApproveConsultationEvent  $event
     * @return void
     */
    public function handle(ApproveConsultationEvent $event)
    {
        $details = $event->consult;
        info('important stuff: '.$details->fullname);
        Mail::to($details['email'])->send(new ConsultationApprovalMail($details));
    }
}
