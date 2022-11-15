<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\Event;
use App\Models\Post;
use Illuminate\Http\Request;

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
        return view('admin.dashboard', [
            'posts' => $posts, 
            'consultations' => $consultation,
            'events' => $events,
        ]);
    }
  
}
