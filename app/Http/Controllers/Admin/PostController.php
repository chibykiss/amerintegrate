<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Traits\Uploadable;
use Carbon\Carbon;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    use Uploadable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createpost');
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
            'title' => 'required|string',
            'postpic' => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:2048',
            'postbody' => 'required|string',
            'post_type' => 'required|string',
        ]);
        $filepath = $this->UserImageUpload($request->file('postpic'), 'post_pic');
        if ($request->post_type === 'SAVE') {
            $createpost = Post::create([
                'admin_id' => Auth()->user()->id,
                'title' => $request->title,
                'postpic' => $filepath,
                'postbody' => $request->postbody,
            ]);
        } elseif ($request->post_type === 'SAVE/PUBLISH') {
            $createpost = Post::create([
                'admin_id' => Auth()->user()->id,
                'title' => $request->title,
                'postpic' => $filepath,
                'postbody' => $request->postbody,
                'published_at' => Carbon::now(),
            ]);
        }


        return redirect('post')->with('success', 'Post created Successfully');
    }


    public function ckupload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $image = $request->file('upload');
            $extension = strtolower($image->getClientOriginalExtension());
            $filename = Str::random(10) . '.' . $extension;
            $image->storePubliclyAs('public/images/post_body_pics', $filename);
            $url = asset('storage/images/post_body_pics/' . $filename);
            return response()->json([
                "filename" => $filename,
                "uploaded" => 1,
                "url" => $url,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if ($post->published_at === null) {
            $updatepost = $post->update([
                'published_at' => Carbon::now(),
            ]);
            if (!$updatepost) return back()->with('fail', 'post could not be published');
            return back()->with('success', 'post has been published');
        }
        $updatepost = $post->update([
            'published_at' => null,
        ]);
        if (!$updatepost) return back()->with('fail', 'post could not be unpublished');
        return back()->with('success', 'post has been Unpublished');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.editpost', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string',
            'postpic' => 'image|mimes:png,jpg,jpeg,gif,svg|max:2048',
            'postbody' => 'required|string',
        ]);

        if ($request->hasFile('postpic')) {
            $filepath = $this->UserImageUpload($request->file('postpic'), 'post_pic', $post->postpic);
        } else {
            $filepath = $post->postpic;
        }
        $updatepost = $post->update([
            'admin_id' => auth()->user()->id,
            'title' => $request->title,
            'postpic' => $filepath,
            'postbody' => $request->postbody,
        ]);
        if ($updatepost) {
            return redirect('post')->with('success', 'post updated');
        }
        return back('fail', 'update failed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'post has been deleted');
    }
}
