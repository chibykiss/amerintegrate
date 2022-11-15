<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::all();
        return view('admin.faqs', ['faqs' => $faqs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createfaq');
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
            'question' => 'string|required|unique:faqs,question',
            'answer' => 'string|required',
        ]);
        if ($request->post_type === 'SAVE') {
            Faq::create([
                'admin_id' => Auth()->user()->id,
                'question' => $request->question,
                'answer' => $request->answer,
            ]);
            return redirect('faq')->with('success', 'faq created and saved');
        } elseif ($request->post_type === 'SAVE/PUBLISH') {
            Faq::create([
                'admin_id' => Auth()->user()->id,
                'question' => $request->question,
                'answer' => $request->answer,
                'published_at' => now(),
            ]);
            return redirect('faq')->with('success', 'faq created, saved and published');
        }else{
            return redirect('faq')->with('fail', 'An Error Occured');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        if ($faq->published_at === null) {
            $updatepost = $faq->update([
                'published_at' => now(),
            ]);
            if (!$updatepost) return back()->with('fail', 'post could not be published');
            return back()->with('success', 'post has been published');
        }
        $updatepost = $faq->update([
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
    public function edit(Faq $faq)
    {
        return view('admin.editfaq', ['faq' => $faq]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'string|required',
            'answer' => 'string|required',
        ]);

        $updatefaq = $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
        ]);
        if(!$updatefaq) return redirect('faq')->with('fail', 'update failed');
        return redirect('faq')->with('success', 'faq updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect('faq')->with('success', 'faq deleted');
    }
}
