<?php

namespace SenseBook\Http\Controllers\BackOffice\Website;

use SenseBook\Http\Controllers\Controller;
use SenseBook\Http\Requests\BackOffice\Website\ContactUsRequest;
use Illuminate\Http\Request;
use SenseBook\Repositories\ContactUsRepository;
use Illuminate\Support\Facades\Log;
use SenseBook\Models\ContactUs;

class ContactUsController extends Controller
{
    private $contactUsRepository;

    public function __construct(ContactUsRepository $contactUsRepository)
    {
        $this->contactUsRepository = $contactUsRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // search จาก field ไหนก็ได้ ทำเป็นแบบ OR ให้มี %search_term% ก็เจอ
        if (ContactUs::all()->isEmpty()) {
            $contactUs = ContactUs::getModel();
        } else {
            $contactUs = ContactUs::all()[0];
        }
        return view('backOffice.website.contactUs.index', compact('contactUs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backOffice.website.contactUs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Log::info('store Function'.serialize(ContactUs::all()));
        if (ContactUs::all()->isEmpty()) {
            $contactUs = ContactUs::create($request->all());
            $request->session()->flash('success', 'Create successful!');
            return redirect()->route('backOffice.website.contact-us.index');
        } else {
            // Log::info('not empty Function');
            $oldDatas = ContactUs::all();
            $contactUs = $this->update($request, $oldDatas[0]['id']);
            $request->session()->flash('success', 'Update successful!');
            return redirect()->route('backOffice.website.contact-us.index', 'contactUs');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backOffice.website.contactUs.show');
    }

    /**
     * Display the specified resource for printing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        return view('backOffice.website.contactUs.print');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backOffice.website.contactUs.update');
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
        $contactUsUpdate = ContactUs::whereId($id)->update($request->except(['id', 'created_at', '_token']));
        $contactUs = ContactUs::all()[0];
        return $contactUs;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->action('backOffice.website.contactUs.index');
    }
    
    /**
        * Restore the specified resource back to storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function restore($id)
    {
        return redirect()->action('backOffice.website.contactUs.index');
    }
}
