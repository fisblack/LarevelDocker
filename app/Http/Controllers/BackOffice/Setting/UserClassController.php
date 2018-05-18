<?php

namespace SenseBook\Http\Controllers\BackOffice\Setting;

use SenseBook\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
// use Illuminate\Validation\Rule;
use SenseBook\Models\UserClass;
use Response;
use Validator;
use Session;

class UserClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd(Session::get('success')."test");
        $UserClasss = UserClass::select();
        if ($request->has('search')) {
            $search = $request->input('search');
            $UserClasss = $UserClasss
                            ->where(function ($query) use ($search) {
                                $query->orWhere('name_th', 'LIKE', '%' . $search . '%');
                                $query->orWhere('name_en', 'LIKE', '%' . $search . '%');
                            });
        }


        $UserClasss = $UserClasss
                        ->withTrashed()
                        ->paginate(10);
                        
        return view('backOffice.setting.userClass.index', compact('UserClasss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('backOffice.setting.userClass.create')
                    ->with(['request'=>$request]);
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
        // $validator = $this->validate($request, [
        //     'discount' => 'required|numeric',
        // ]);

        // $name_th = $request->old('name_th');
        if ($validator->fails()) {
            $errors = $validator->errors();
            // return $errors;
            // return $errors->get('discount_type');
            return back()
            ->withInput()
            ->with(['errors'=>$errors]);
        }
        
        $data = $request->all();
        UserClass::create($data);
        // session()->flash('success', 'Create successful!');
        Session::flash('success', 'Create successful!');
        return redirect()->route('backOffice.setting.user-class.index');
    }

    public function rule()
    {
        return [
            'discount' => 'required|numeric|min:0',
            'minimum_purchase' => 'required|numeric|min:0',
        ];
    }

    public function message()
    {
        return [
            'discount.numeric'    => 'กรุณากรอกตัวเลข',
            'discount.min' => 'มีค่ามากกว่าหรือเท่ากับ 0',
            'minimum_purchase.numeric'    => 'กรุณากรอกตัวเลข',
            'minimum_purchase.min' => 'มีค่ามากกว่าหรือเท่ากับ 0'
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backOffice.setting.userClass.show');
    }

    /**
     * Display the specified resource for printing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        return view('backOffice.setting.userClass.print');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        // return UserClass::find($id);
        $UserClass = UserClass::find($id);
        // $request->old('minimum_purchase',"tetetet");
        // return $request->old('minimum_purchase');
        
        if (empty($UserClass)) {
            if (empty(UserClass::withTrashed()->find($id))) {
                session()->flash('failure', "Warning Data not found");
            } else {
                session()->flash('failure', "Can't Edit Data");
            }
            
            return redirect()->route('backOffice.setting.user-class.index');
        } else {
            if (empty($request->old('minimum_purchase'))) {
                // dd("tre");
            } else {
            }
            return view('backOffice.setting.userClass.update', compact('UserClass', 'request'));
        }
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
        
        $data = $request->all();
        unset($data['_token']);
        unset($data['_method']);
        $validator = Validator::make($request->all(), $this->rule(), $this->message());
        // if (empty(UserClass::find($id))) {
        //     session()->flash('failure', "Can't Edit Data");
        //     return redirect()->route('backOffice.setting.user-class.index');
        // }
        if (empty(UserClass::withTrashed()->find($id))) {
            session()->flash('failure', "Data not found");
            return redirect()->route('backOffice.setting.user-class.index');
        } elseif (empty(UserClass::find($id))) {
            session()->flash('failure', "Can't Edit Data");
            return redirect()->route('backOffice.setting.user-class.index');
        }

        if ($validator->fails()) {
            $errors = $validator->errors();
            // return $errors->get('discount_type');
            return redirect()->route('backOffice.setting.user-class.edit', $id)
            ->withInput()
            ->with(['errors'=>$errors]);
        }
        session()->flash('success', 'Update Data success');
        UserClass::where('id', $id)->update($data);
        return redirect()->route('backOffice.setting.user-class.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->all();
        // return UserClass::find($id)->first();
        if ($request->has('UseForce')) {
            if (empty(UserClass::withTrashed()->find($id))) {
                session()->flash('failure', 'Warning Data not found');
            } else {
                session()->flash('success', 'Force Delete success');
                UserClass::where('id', $id)->forceDelete();
            }
        } else {
            if (empty(UserClass::find($id))) {
                session()->flash('failure', 'Data Change');
            } else {
                session()->flash('success', 'Delete success');
                UserClass::where('id', $id)->delete();
            }
        }
        // return [$id,$data];

        return redirect()->route('backOffice.setting.user-class.index');
        // return redirect()->action('backOffice.setting.userClass.index');
    }
    
    /**
        * Restore the specified resource back to storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function restore($id)
    {
        // return $id;
        if (empty(UserClass::find($id))) {
            if (empty(UserClass::withTrashed()->find($id))) {
                session()->flash('failure', 'Warning Data not found');
            } else {
                UserClass::where('id', $id)->restore();
                session()->flash('success', 'Restore Success');
            }
        } else {
            session()->flash('failure', 'Data Change');
        }
        
        
        return redirect()->route('backOffice.setting.user-class.index');
    }

    public function deleteAll(Request $request)
    {
        $data = $request->all();
        // return $data;
        $check_all = false;//ข้อมูล มีการเปลี่ยนแปลไหม
        if ($data['ar_delete_all']) {
            $ar_delete_all = explode(",", $data['ar_delete_all']);
            $check_force = explode(",", $data['check_force']);
            foreach ($ar_delete_all as $key => $value) {
                //ค่าที่ส่งมาเปี่ยน soft หรือ force
                if ($check_force[$key]=="true") {
                    if (empty(UserClass::withTrashed()->find($value))) {
                        $check_all = true;
                        session()->flash('failure', 'Data Change');
                        return redirect()->route('backOffice.setting.user-class.index');
                    }
                } else {
                    if (empty(UserClass::find($value))) {
                        $check_all = true;
                        session()->flash('failure', 'Data Change');
                        return redirect()->route('backOffice.setting.user-class.index');
                    }
                    // UserClass::find($value)->delete();
                }
            }
            if ($check_all) {
                // session()->flash('failure', 'ข้อมูลมีการเปลี่ยนแปลง');
            } else {
                foreach ($ar_delete_all as $key => $value) {
                    //ค่าที่ส่งมาเปี่ยน soft หรือ force

                    if ($check_force[$key]=="true") {
                        UserClass::where('id', $value)->forceDelete();
                    } else {
                        UserClass::where('id', $value)->delete();
                    }
                }
                session()->flash('success', 'Delete success');
            }
        }
        return redirect()->route('backOffice.setting.user-class.index');
    }
}
