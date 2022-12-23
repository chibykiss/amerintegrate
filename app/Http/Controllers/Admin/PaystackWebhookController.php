<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donatation;
use Illuminate\Http\Request;
use Digikraaft\PaystackWebhooks\Http\Controllers\WebhooksController as paystackHookController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PaystackWebhookController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request)
    {
        $input = $request->getContent();
      	Log::channel('webhook')->info($input);
        $event = json_decode($input);
        if ($event->event == 'charge.success') {
            if ($event->data->status == 'success') {
                Log::channel('webhook')->info('store now');
                $user_email = $event->data->customer->email;
                $signature = $event->data->authorization->signature;
                $username = $event->data->metadata->custom_field[0]->value;
                $gateway = 'paystack';
                $amount = $event->data->amount / 100;
                $currency = $event->data->currency;
                $status = $event->data->status;
                //$check = Donatation::where('signature',$signature);
                //if(!Donatation::where('signature','=',$signature)->exists()){
                $info = Donatation::firstOrCreate(
                    [
                        'signature' => $signature,
                    ],
                    [
                        'name' => $username,
                        'email' => $user_email,
                        'currency' => $currency,
                        'amount' => $amount,
                        'gateway' => $gateway,
                        'status' => $status,
                    ],
                );
                //}

            }
        }
    }
}
