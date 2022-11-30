<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Traits\Uploadable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TeamController extends Controller
{
    use Uploadable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $team_member = Team::all();
        return view('admin.team', ['team_members' => $team_member]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createteam');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        $request->validate([
            'member_name' => 'required|string',
            'position' => 'required|string',
            'tpic' => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:2048',
            'facebook' => 'string|nullable',
            'twitter' => 'string|nullable',
            'linkedin' => 'string|nullable',
            'description' => 'required|string',
        ]);
        $filepath = $this->UserImageUpload($request->file('tpic'), 'team_pic');
        if ($request->post_type === 'SAVE') {
            Team::create([
                'admin_id' => auth()->user()->id,
                'name' => $request->member_name,
                'position' => $request->position,
                'picture' => $filepath,
                'description' => $request->description,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'linkedin' => $request->linkedin,
            ]);
            return redirect('team')->with('success', 'Team Member created and saved');
        } elseif ($request->post_type === 'SAVE/PUBLISH') {
            Team::create([
                'admin_id' => auth()->user()->id,
                'name' => $request->member_name,
                'position' => $request->position,
                'picture' => $filepath,
                'description' => $request->description,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'linkedin' => $request->linkedin,
                'published_at' => Carbon::now(),
            ]);
            return redirect('team')->with('success', 'Team Member created, saved and published');
        } else {
            return redirect('team')->with('fail', 'Team Member not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        if ($team->published_at === null) {
            $updatepost = $team->update([
                'published_at' => now(),
            ]);
            if (!$updatepost) return back()->with('fail', 'Team Member could not be published');
            return back()->with('success', 'Team member has been published');
        }
        $updatepost = $team->update([
            'published_at' => null,
        ]);
        if (!$updatepost) return back()->with('fail', 'Team Member could not be unpublished');
        return back()->with('success', 'Team Member has been Unpublished');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        return view('admin.editteam', ['team' => $team]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'member_name' => 'required|string',
            'position' => 'required|string',
            'tpic' => 'image|mimes:png,jpg,jpeg,gif,svg|max:2048',
            'facebook' => 'string|nullable',
            'twitter' => 'string|nullable',
            'linkedin' => 'string|nullable',
            'description' => 'required|string',
        ]);
        $filepath = $request->hasFile('tpic')
        ? $this->UserImageUpload($request->file('tpic'), 'team_pic', $team->picture)
        : $team->picture;
        $updated = $team->update(['admin_id' => auth()->user()->id,
            'name' => $request->member_name,
            'position' => $request->position,
            'picture' => $filepath,
            'description' => $request->description,
            'facebook' => isset($request->facebook) ? $request->facebook : $team->facebook,
            'twitter' => isset($request->twitter) ? $request->twitter : $team->twitter,
            'linkedin' => isset($request->linkedin) ? $request->linkedin : $team->linkedin,
        ]);
        if ($updated) return redirect('team')->with('success', 'Team Member Info Updated');
        return back()->with('fail', 'Team member info not Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        /*   DELETE IMAGE ASSOCIATED WITH TEAM MEMBER   */
        $imgpath = storage_path("app/public/service_pic/" . $team->picture);
        if (File::exists($imgpath)) {
            File::delete($imgpath);
        };
        $team->delete();
        return redirect('team')->with('success', 'Team member Deleted');
    }
}
