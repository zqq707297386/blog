<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\About;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class AboutController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ainfo= About::first();
        return view('admin.about.index',compact('ainfo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.about.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $about = Input::except('_token');
        if (About::create($about)) {
            return redirect('admin/about');
        } else {
            return back()->with('errors','未知错误！稍后重试');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $about_id
     * @return \Illuminate\Http\Response
     */
    public function show($about_id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $about_id
     * @return \Illuminate\Http\Response
     */
    public function edit($about_id)
    {
        $ainfo= About::first();
        return view('admin.about.edit',compact('ainfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $about_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $about_id)
    {
        $upinfo = Input::except('_token','_method');
        if (About::where('about_id',$about_id)->update($upinfo)) {
            return redirect('admin/about');
        } else {
            return back()->with('errors','未知错误！稍后重试');
        }
    }

    public function destroy($about_id)
    {

    }
}
