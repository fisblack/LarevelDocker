<?php

namespace SenseBook\Http\Controllers\Website;

use SenseBook\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SenseBook\Http\Requests\BackOffice\Website\ContactUsRequest;
use SenseBook\Repositories\ContactUsRepository;
use Illuminate\Support\Facades\Log;
use SenseBook\Models\ContactUs;

class ContactUsController extends WebBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (ContactUs::all()->isEmpty()) {
            $contactUs = ContactUs::getModel();
        } else {
            $contactUs = ContactUs::all()[0];
        }
        return view('website.contactUs.index', compact('contactUs'));
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
