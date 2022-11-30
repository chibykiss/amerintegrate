<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Services;
use App\Traits\Uploadable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{
    use Uploadable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Services::all();
        return view('admin.services', ['services' => $services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createservice');
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
            'title' => 'string|required|unique:services,name',
            'spic' => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:2048',
            'content' => 'required|string',
        ]);
        $filepath = $this->UserImageUpload($request->file('spic'), 'service_pic');
        if ($request->post_type === 'SAVE') {
            Services::create([
                'admin_id' => auth()->user()->id,
                'name' => $request->title,
                'picture' => $filepath,
                'content' => $request->content,
            ]);
            return back()->with('success', 'service created and saved');
        } elseif ($request->post_type === 'SAVE/PUBLISH') {
            Services::create([
                'admin_id' => auth()->user()->id,
                'name' => $request->title,
                'picture' => $filepath,
                'content' => $request->content,
                'published_at' => Carbon::now(),
            ]);
            return redirect('service')->with('success', 'service created, saved and published');
        }else{
            return redirect('service')->with('fail', 'service not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Services $service)
    {
        if ($service->published_at === null) {
            $updatepost = $service->update([
                'published_at' => now(),
            ]);
            if (!$updatepost) return back()->with('fail', 'Service could not be published');
            return back()->with('success', 'Service has been published');
        }
        $updatepost = $service->update([
            'published_at' => null,
        ]);
        if (!$updatepost) return back()->with('fail', 'Service could not be unpublished');
        return back()->with('success', 'Service has been Unpublished');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Services $service)
    {
        return view('admin.editservice', ['service' => $service]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Services $service)
    {
        $request->validate([
            'title' => 'string|required',
            'spic' => 'image|mimes:png,jpg,jpeg,gif,svg|max:2048',
            'content' => 'required|string',
        ]);
        $filepath = $request->hasFile('spic')
        ? $this->UserImageUpload($request->file('spic'), 'service_pic', $service->picture)
        : $service->picture;

        $updated = $service->update([
            'admin_id' => auth()->user()->id,
            'name' => $request->title,
            'picture' => $filepath,
            'content' => $request->content,
        ]);
        if ($updated) return redirect('service')->with('success', 'Service Updated');
        return back()->with('fail', 'Service not Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Services $service)
    {    
        /*   DELETE IMAGE ASSOCIATED WITH EVENT   */
        $imgpath = storage_path("app/public/service_pic/" . $service->picture);
        if (File::exists($imgpath)) {
            File::delete($imgpath);
        };  
        $service->delete();
        return redirect('service')->with('success', 'Service Deleted');
    }
}
