<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Traits\Uploadable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{
    use Uploadable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return view('admin.events', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createevent');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'edate' => ['required', 'string'],
            'epic' => ['required', 'image', 'mimes:png,jpg,jpeg,gif,svg', 'max:2048'],
            'edetail' => ['required', 'string'],
        ]);
        $filepath = $this->UserImageUpload($request->file('epic'),'event_pic');
        Event::create([
            'admin_id' => auth()->user()->id,
            'title' => $request->title,
            'event_date' => $request->edate,
            'event_pic' => $filepath,
            'event_detail' => $request->edetail,
        ]);
        return redirect('event')->with('success', 'Event Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('admin.editevent', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Event $event)
    {
        $request->validate([
            'title' => 'required|string',
            'edate' => 'required|string',
            'epic' => 'image|mimes:png,jpg,jpeg,gif,svg|max:2048',
            'edetail' => 'required|string',
        ]);
        // if($request->hasFile('epic')){
        //     $filepath = $this->UserImageUpload($request->file('epic'),'event_pic',$event->event_pic);
        // }else{
        //     $filepath = $event->event_pic;
        // }
        $filepath = $request->hasFile('epic') 
        ? $this->UserImageUpload($request->file('epic'),'event_pic',$event->event_pic)
        : $event->event_pic;

        $updated = $event->update([
            'admin_id' => auth()->user()->id,
            'title' => $request->title,
            'event_date' => $request->edate,
            'event_pic' => $filepath,
            'event_detail' => $request->edetail,
        ]);
        if($updated) return redirect('event')->with('success', 'Event Updated');
        return back()->with('fail', 'Event not Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        /*   DELETE IMAGE ASSOCIATED WITH EVENT   */
        $imgpath = storage_path("app/public/images/event_pic/" . $event->event_pic);
        if (File::exists($imgpath)) {
            File::delete($imgpath);
        };  
        /*   DELETE  EVENT   */
        $event->delete();
        return back()->with('success', 'Event deleted');
    }
}
