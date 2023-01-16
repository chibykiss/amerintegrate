<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class VerifyWebhook
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
         // validate that callback is coming from Paystack
       	$allowed_ips = ['52.31.139.75', '52.49.173.169', '52.214.14.220'];
      	if(strtoupper($request->server('REQUEST_METHOD')) != 'POST' || !in_array($request->server('REMOTE_ADDR'),$allowed_ips)){
          	 Log::channel('webhook')->info($request->server('REQUEST_METHOD').' '.$request->server('REMOTE_ADDR'));
             throw new AccessDeniedHttpException("Invalid Request");
       	}
		// Log::channel('webhook')->info('before the second check');
      
        $input = $request->getContent();
        $paystack_key = env('PAYSTACK_SECRET');
        if ($request->server('HTTP_X_PAYSTACK_SIGNATURE') !== hash_hmac('sha512', $input, $paystack_key)) {
           Log::channel('webhook')->info('did not pass the second check');
           throw new AccessDeniedHttpException("Access Denied");
        }
		//Log::channel('webhook')->info('the event has been sent to the controller');
      	http_response_code(200);
        return $next($request);
    }
}
