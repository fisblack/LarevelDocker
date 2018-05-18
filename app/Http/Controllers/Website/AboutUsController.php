<?php

namespace SenseBook\Http\Controllers\Website;

use SenseBook\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SenseBook\Models\AboutUs;
use SenseBook\Models\AboutUsWriters;
use SenseBook\Models\ContactUs;
use SenseBook\Models\Writer;

class AboutUsController extends WebBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (AboutUs::all()->isEmpty()) {
            $aboutUs = AboutUs::getModel();
        } else {
            $aboutUs = AboutUs::all()->first();
            $aboutUsWriters = AboutUsWriters::where('about_us_id', $aboutUs->id)->get();
        }
        
        if (ContactUs::all()->isEmpty()) {
            $contactUs = ContactUs::getModel();
        } else {
            $contactUs = ContactUs::all()->first();
        }
        
        if (Writer::all()->isEmpty()) {
            $writers = Writer::getModel();
        } else {
            $writers = Writer::all()->first();
        }
        $writers = Writer::all();
        
        return view('website.aboutUs.index')->with(compact('aboutUs', 'aboutUsWriters', 'contactUs', 'writers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
