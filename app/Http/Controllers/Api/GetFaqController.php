<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class GetFaqController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $faqs = Faq::where('published_at', '!=', null)->get();
        return response()->json([
            'status' => 'success',
            'data' => $faqs,
        ], 200);
    }
}
