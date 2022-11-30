<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Digikraaft\PaystackWebhooks\Http\Controllers\WebhooksController as paystackHookController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PaystackWebhookController extends PaystackWebhookController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handlechargesucess($payload)
    {
        $log_file = storage_path('app/log_file');
        Storage::put($log_file.'webhook.log',$payload);
        //error_log($payload,3,);
    }
}
