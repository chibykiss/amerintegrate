<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Traits\Uploadable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VideoController extends Controller
{
    use Uploadable;
    public function index()
    {
        $videos = Video::orderBy('id', 'DESC')->get();
        return view('admin.videos', ['videos' => $videos]);
    }
    public function create()
    {
        return view('admin.createvideo');
    }


    public function store(Request $request)
    {
        //return $request->link_path;
        $request->validate([
            'title' => 'string|required',
            'detail' => 'string|required',
            'via' => 'string|required',
            'video_path' => 'file|mimes:mp4,mov,ogg,qt|max:20000',
            'link_path' => 'nullable|string',
        ]);
        $filepath = $request->hasFile('video_path')
        ? $this->UserImageUpload($request->file('video_path'),'videos')
        : null;
        
        $created = Video::create([
            'admin_id' => auth()->user()->id,
            'title' => $request->title,
            'detail' => $request->detail,
            'via' => $request->via,
            'link_path' => $request->link_path,
            'video_path' => $filepath,
        ]);
        if($created) return back()->with('success', 'Video Created');
        return back()->with('fail', 'video creation failed');
    }  
    
    public function destroy(Video $video)
    {
        //return $video;
        /*   DELETE IMAGE ASSOCIATED WITH EVENT   */
        $imgpath = storage_path("app/public/videos/" . $video->event_pic);
        if (File::exists($imgpath)) {
            File::delete($imgpath);
        };
        /*   DELETE  EVENT   */
        $video->delete();
        return back()->with('success', 'video deleted deleted');
    }
}
