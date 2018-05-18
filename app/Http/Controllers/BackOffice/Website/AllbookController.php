<?php
namespace SenseBook\Http\Controllers\BackOffice\Website;

use SenseBook\Http\Controllers\Controller;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use SenseBook\Models\AllBooks;
use Storage;

class AllBookController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->path = 'images/backOffice/allBook';
    }


    public function index()
    {
        // search จาก field ไหนก็ได้ ทำเป็นแบบ OR ให้มี %search_term% ก็เจอ

        $allbook = Allbooks::all()->last();
        return view('backOffice.website.allbook.index', compact('allbook'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backOffice.website.allbook.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $imageOne = $request->file('FileInput');

        if (!empty($imageOne)) {
            $imgOneName = md5(time()."allbook") . '.' . $imageOne->getClientOriginalExtension();
            $destinationPath = storage_path($this->path);

            if ($imageOne->move($destinationPath, $imgOneName)) {
                AllBooks::create([
                    'allbook_image' => $this->path.'/'.$imgOneName,
                ]);
            }

            $request->session()->flash('success', 'Update successful!');
            return redirect()->route('backOffice.website.allbook.index');
        } else {
            $request->session()->flash('failure', 'Update Failed!!');
            return redirect()->route('backOffice.website.allbook.index');
        }

    
        return redirect()->route('backOffice.website.allbook.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backOffice.website.allbook.show');
    }

    /**
     * Display the specified resource for printing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        return view('backOffice.website.allbook.print');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backOffice.website.allbook.update');
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
        return redirect()->action('backOffice.website.allbook.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->action('backOffice.website.allbook.index');
    }
    
    /**
        * Restore the specified resource back to storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function restore($id)
    {
        return redirect()->action('backOffice.website.allbook.index');
    }
}
