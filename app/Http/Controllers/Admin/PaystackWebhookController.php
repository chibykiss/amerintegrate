<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Donatation;
use Illuminate\Support\Facades\Log;

class PaystackWebhookController extends Controller
{
    public function handle(Request $request)
    {
      	$input = $request->getContent();
        $event = json_decode($input);
     	$signature = $event->data->authorization->signature;
      	Log::channel('webhook')->info($input);
   
     if ($event->event == 'charge.success') {
            if ($event->data->status == 'success') {
               // Log::channel('webhook')->info('store now');
                $user_email = $event->data->customer->email;
                //$signature = $event->data->authorization->signature;
              	$signature = $event->data->id;
                $username = $event->data->metadata->custom_field[0]->value;
                $gateway = 'paystack';
                $amount = $event->data->amount/100;
                $currency = $event->data->currency;
                $status = $event->data->status;
              	$check = Donatation::where('signature',$signature)->count();
              	Log::channel('webhook')->info($check);
              	//if(!Donatation::where('signature','=',$signature)->exists()){
                Donatation::Create([
                    'signature' => $signature,
                    'name' => $username,
                    'email' => $user_email,
                    'currency' => $currency,
                    'amount' => $amount,
                    'gateway' => $gateway,
                    'status' => $status,
                ]);
                //}
            
            }
        }
        //foreach($request->server() as $key => $value){
            // error_log("$key: $value<br>\n", 3, $log_file);
          //Log::channel('webhook')->info("$key: $value<br>\n");
       // }
   
     
      
    }
}
