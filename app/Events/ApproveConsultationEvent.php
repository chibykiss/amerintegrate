<?php

namespace App\Events;

use App\Models\Consultation;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ApproveConsultationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $consult;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Consultation $consult)
    {
        $this->consult = $consult;
    }

   
}
