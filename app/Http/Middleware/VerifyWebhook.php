<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
        if ((!$request->isMethod('post')) || !$request->header('HTTP_X_PAYSTACK_SIGNATURE', null)) {
            throw new AccessDeniedHttpException("Invalid Request");
        }

        $input = $request->getContent();
        $paystack_key = env('PAYSTACK_SECRET');
        if ($request->header('HTTP_X_PAYSTACK_SIGNATURE') !== hash_hmac('sha512', $input, $paystack_key)) {
            throw new AccessDeniedHttpException("Access Denied");
        }
        return $next($request);
    }
}
