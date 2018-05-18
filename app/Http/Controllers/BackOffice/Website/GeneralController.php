<?php

namespace SenseBook\Http\Controllers\BackOffice\Website;

use SenseBook\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SenseBook\Models\General;
use Image;
use Storage;
use Validator;
use Session;

class GeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->uploadPath = 'images/backOffice/general';
    }

    public function index(Request $request)
    {
        // search จาก field ไหนก็ได้ ทำเป็นแบบ OR ให้มี %search_term% ก็เจอ
        $General = General::select()->orderBy('id', 'desc')->first();
        if (empty($General)) {
            $General = new General;
            $General->id = "";
        } else {
        }
        // return $General;
        // return $request->old('is_maintenance',$General->is_maintenance);
        return view('backOffice.website.general.index', compact('General', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    
        return view('backOffice.website.general.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rule(), $this->message());
        if ($validator->fails()) {
            $errors = $validator->errors();
            // return $errors;
            // return $errors->get('discount_type');
            Session::flash('error', 'Maintenance banner only accept the following file types: JPG, JPEG, PNG and GIF.');
            return back()
            ->withInput()
            ->with(['errors'=>$errors]);
        }
        
        // return $request->all();
        $id = $request->input('id');
        if ($id) {
            $Model = General::find($id);
        } else {
            $Model = new General;
        }
        if ($request->has('is_maintenance')) {
            $Model->is_maintenance = '1';
        } else {
            $Model->is_maintenance = '0';
        }
        if ($request->has('is_close')) {
            $Model->is_close = '1';
        } else {
            $Model->is_close = '0';
        }
        $Model->maintenanace_cause = $request->input('maintenanace_cause');
        $Model->id = $request->input('id');
        $Model->maintenance_image = $this->uploadImage('maintenance_image', $request, $Model);
        $Model->close_image = $this->uploadImage('close_image', $request, $Model);
        $Model->order_image = $this->uploadImage('order_image', $request, $Model);
        $Model->shipment_image = $this->uploadImage('shipment_image', $request, $Model);
        $Model->return_image = $this->uploadImage('return_image', $request, $Model);
        $Model->payment_image = $this->uploadImage('payment_image', $request, $Model);
        $Model->point_image = $this->uploadImage('point_image', $request, $Model);
        $Model->save();
        return redirect()->route('backOffice.website.general.index');
    }

    public function rule()
    {
        return [
            'maintenance_image' => 'mimes:jpeg,png',
            'close_image' => 'mimes:jpeg,png',
            'order_image' => 'mimes:jpeg,png',
            'shipment_image' => 'mimes:jpeg,png',
            'return_image' => 'mimes:jpeg,png',
            'payment_image' => 'mimes:jpeg,png',
            'point_image' => 'mimes:jpeg,png',
        ];
    }

    public function message()
    {
        return [
            
        ];
    }

    private function uploadImage($name_input, $request, $Model)
    {
        $path_name = '';
        if ($request->hasFile($name_input)) {
            $name_new = date("Y-m-d").rand(1, 10000000);
            if (!empty($Model->$name_input)&&file_exists(storage_path($Model->$name_input))) {
                unlink(storage_path($Model->$name_input));
            }
            $data = $request->input($name_input);
            // $photo = $request->file($name_input)->getClientOriginalName();
            $fileExtension = $request->file($name_input)->getClientOriginalExtension(); // นามสกุลไฟล์
            $photo = $name_new.'.'.$fileExtension;
            
            $destination = storage_path($this->uploadPath);
            $request->file($name_input)->move($destination, $photo);
            $path_name = $this->uploadPath."/".$photo;
        } else {
            if ($Model->$name_input) {
                $path_name = $Model->$name_input;
            } else {
                $path_name = '';
            }
        }
        return $path_name;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backOffice.website.general.show');
    }

    /**
     * Display the specified resource for printing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        return view('backOffice.website.general.print');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backOffice.website.general.update');
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
        return redirect()->action('backOffice.website.general.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->action('backOffice.website.general.index');
    }
    
    /**
        * Restore the specified resource back to storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function restore($id)
    {
        return redirect()->action('backOffice.website.general.index');
    }
}
