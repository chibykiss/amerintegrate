<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donatation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $donations = Donatation::orderBy('created_at','DESC')->get();
        return view('admin.donations', ['donations' => $donations]);
    }
}
