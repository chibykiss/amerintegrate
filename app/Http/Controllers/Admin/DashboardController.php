<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\Donatation;
use App\Models\Event;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $posts = Post::where('published_at','!=',null)->count();
        $consultation = Consultation::where('approved',0)->count();
        $events = Event::where('published_at','!=',null)->count();
        $donations_naria = Donatation::where('currency','NGN')->get();
        $donations_dollar = Donatation::where('currency','USD')->get();
        $total_naira = 0;
        $total_dollar = 0;
        foreach($donations_naria as $naira){
            $total_naira = $total_naira+$naira->amount;
        }
        foreach($donations_dollar as $dollar){
            $total_dollar = $total_dollar+$dollar->amount;
        }
        // Log::channel('webhook')->info('info about the api',[
        //     'no of posts' => $posts
        // ]);
        return view('admin.dashboard', [
            'posts' => $posts, 
            'consultations' => $consultation,
            'events' => $events,
            'total_naira' => $total_naira,
            'total_dollar' => $total_dollar,
        ]);
    }
  
}
