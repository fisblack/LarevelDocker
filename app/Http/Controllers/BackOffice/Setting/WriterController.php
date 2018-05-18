<?php

namespace SenseBook\Http\Controllers\BackOffice\Setting;

use Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use SenseBook\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SenseBook\Models\Writer;

class WriterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $perPage = 15;
    public $uploadPath = 'images/backOffice/writers';

    public function index(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->search;
            $writer = Writer::where('fullname_th', 'LIKE', "%{$search}%")
                ->orWhere('fullname_en', 'LIKE', "%{$search}%")
                ->orWhere("description_th", 'LIKE', "%{$search}%")
                ->orWhere('description_en', 'LIKE', "%{$search}%")
                ->withTrashed()
                ->orderBy('id', 'DESC')
                ->paginate($this->perPage);
        } else {
            $writer = Writer::withTrashed()->orderBy('id', 'DESC')->paginate($this->perPage);
        }
        return view('backOffice.setting.writer.index')->with(compact('writer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backOffice.setting.writer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $writer = new Writer();
        //info@adiwit.co.th
        $writer->fullname_th = $request->name_th;
        $writer->fullname_en = $request->name_en;
        $writer->description_th = $request->desc_th;
        $writer->description_en = $request->desc_en;

        if ($request->hasFile('writer_img')) {
            $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/svg+xml'];
            $contentType = $request->file('writer_img')->getMimeType();
            if (!in_array($contentType, $allowedMimeTypes)) {
                Session::flash('errors', ['writer_image' => 'Can\'t Create data not image']);
                return  Redirect::back()->withInput();
            }
            $imageUploaded = uploadImage($request->file('writer_img'), $this->uploadPath, 100);
            if ($imageUploaded) {
                $writer->image = $imageUploaded['full'];
            } else {
                return back()
                    ->with('warning', 'Can\'t Create')
                    ->withInput();
            }
        }

        if ($writer->save()) {
            Session::flash('success', 'Create successful!');
        } else {
            Session::flash('error', 'Create error!');
        }
        return redirect()->route('backOffice.setting.writer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backOffice.setting.writer.show');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $writer = Writer::query()->withTrashed()->find($id);
        return view('backOffice.setting.writer.update')->with(compact('writer'));
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
        $writer = Writer::query()->withTrashed()->find($id);
        $writer->fullname_th = $request->name_th;
        $writer->fullname_en = $request->name_en;
        $writer->description_th = $request->desc_th;
        $writer->description_en = $request->desc_en;

        if ($request->hasFile('writer_img')) {
            $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];
            $contentType = $request->file('writer_img')->getMimeType();
            if (!in_array($contentType, $allowedMimeTypes)) {
                Session::flash('failure', ['writer_image' => 'Can\'t Create data not image']);
                return  Redirect::back()->withInput();
            }
            
            $imageUploaded = uploadImage($request->file('writer_img'), $this->uploadPath, 100);
            if ($imageUploaded) {
                $writer->image = $imageUploaded['full'];
            } else {
                return back()
                    ->with('failure', 'Can\'t Create')
                    ->withInput();
            }
        }

        if ($writer->save()) {
            Session::flash('success', ' Update Success');
        } else {
            Session::flash('error', 'Update error!');
        }
        return redirect()->route('backOffice.setting.writer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $writer = Writer::withTrashed()->where('id', '=', $id)->first();
        try {
            if ($writer !== null) {
                if (!$writer->trashed()) {
                    $writer->delete();
                    Session::flash('success', " Delete Success ");
                } else {
                    $writer->forceDelete();
                    Session::flash('success', "Force Delete Success");
                }
            } else {
                Session::flash('failure', "Data not found");
                return redirect()->route('backOffice.setting.writer.index');
            }
        } catch (Exception $e) {
            Session::flash('error', "Something went wrong, please try again.");
            return redirect()->route('backOffice.setting.writer.index');
        }
        return redirect()->route('backOffice.setting.writer.index');
    }

    /**
     * Restore the specified resource back to storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {

        $writer = Writer::withTrashed()->where('id', '=', $id)->first();

        try {
            if ($writer !== null) {
                if ($writer->trashed()) {
                    $writer->restore();
                    Session::flash('success', " Restore Success");
                }
            } else {
                Session::flash('failure', "Data not found");
                return redirect()->route('backOffice.member.index');
            }
        } catch (Exception $e) {
            Session::flash('error', "Something went wrong, please try again.");
            return redirect()->route('backOffice.setting.writer.index');
        }
        return redirect()->route('backOffice.setting.writer.index');
    }

    public function deleteAll(Request $request)
    {
        $data = $request->all();

        $check_all = false;
        if ($data['ar_delete_all']) {
            $ar_delete_all = explode(",", $data['ar_delete_all']);
            $check_force = explode(",", $data['check_force']);
            foreach ($ar_delete_all as $key => $value) {
                if ($check_force[$key] == "true") {
                    if (empty(Writer::withTrashed()->find($value))) {
                        $check_all = true;
                        session()->flash('failure', 'Can\'t Delete Data');
                        return redirect()->route('backOffice.setting.writer.index');
                    }
                } else {
                    if (empty(Writer::find($value))) {
                        $check_all = true;
                        session()->flash('failure', 'Can\'t Delete Data');
                        return redirect()->route('backOffice.setting.writer.index');
                    }
                }
            }
            if ($check_all) {
                // do nothing
            } else {
                foreach ($ar_delete_all as $key => $value) {
                    if ($check_force[$key] == "true") {
                        Writer::where('id', $value)->forceDelete();
                    } else {
                        Writer::where('id', $value)->delete();
                    }
                }
                session()->flash('success', 'Delete success');
            }
        }
        return redirect()->route('backOffice.setting.writer.index');
    }

    public function checkwriter(Request $request)
    {
        $writer = Writer::withTrashed()->where('id', '=', $request->id)->first();
        try {
            if ($writer !== null) {
                if ($writer->trashed()) {
                    $data = [ 'status'=>'0', 'message'=> "Force Delete"];
                } else {
                    $data = [ 'status'=>'1', 'message'=> "Success"];
                }
            } else {
                $data = [ 'status'=>'2', 'message'=> "Data not Found!"];
            }
        } catch (Exception $e) {
            $data = [ 'status'=>'2', 'message'=>"Something went wrong, please try again."];
        }
        return response()->json($data);
    }
}
