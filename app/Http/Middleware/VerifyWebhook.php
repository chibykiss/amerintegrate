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
        // if ((!$request->isMethod('post')) || !$request->header('HTTP_X_PAYSTACK_SIGNATURE', null)) {
        //     throw new AccessDeniedHttpException("Invalid Request");
        // }

        $input = $request->getContent();
        $paystack_key = env('PAYSTACK_SECRET');
        if ($request->header('HTTP_X_PAYSTACK_SIGNATURE') !== hash_hmac('sha512', $input, $paystack_key)) {
            throw new AccessDeniedHttpException("Access Denied");
        }
        return $next($request);
    }
}
