<?php

namespace SenseBook\Http\Controllers\BackOffice\Website;

use Storage;
use Illuminate\Http\File;
use SenseBook\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SenseBook\Models\AboutUs;
use SenseBook\Models\AboutUsWriters;
use Illuminate\Support\Facades\Log;

class AboutUsController extends Controller
{
    public $path = 'images/aboutUs';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // search จาก field ไหนก็ได้ ทำเป็นแบบ OR ให้มี %search_term% ก็เจอ
        if (AboutUs::all()->isEmpty()) {
            $aboutUs = AboutUs::getModel();
        } else {
            $aboutUs = AboutUs::all()->first();
            $aboutUsWriters = AboutUsWriters::where('about_us_id', $aboutUs->id)->get();
        }
        return view('backOffice.website.aboutUs.index', compact('aboutUs', 'aboutUsWriters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backOffice.website.aboutUs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Log::info('after request data '.serialize($request->all()));
        if (AboutUs::all()->isEmpty()) {
            $imageHead = $request->file('image_head');
            $imageOne = $request->file('image_1');
            $imageTwo = $request->file('image_2');
            $headDescirpt = $request->input('head_descirpt');
            $title = $request->input('title');
            $detailOne = $request->input('detail_one');
            $detailTwo = $request->input('detail_two');
            $footDescirpt = $request->input('foot_descirpt');
            $writerImages = $request->file('writer_image_input_hidden');

            if (isset($imageHead)
            && isset($imageOne)
            && isset($imageTwo)) {
                $headName = md5(time()."head") . '.' . $imageHead->getClientOriginalExtension();
                $imgOneName = md5(time()."one") . '.' . $imageOne->getClientOriginalExtension();
                $imgTwoName = md5(time()."two") . '.' . $imageTwo->getClientOriginalExtension();
                $destinationPath = storage_path($this->path);

                if ($imageHead->move($destinationPath, $headName)
                && $imageOne->move($destinationPath, $imgOneName)
                && $imageTwo->move($destinationPath, $imgTwoName)) {
                    AboutUs::create([
                        'image_head' => $this->path.'/'.$headName,
                        'image_1' => $this->path.'/'.$imgOneName,
                        'image_2' => $this->path.'/'.$imgTwoName,
                        'title' => $title,
                        'head_description' => $headDescirpt,
                        'description_1' => $detailOne,
                        'description_2' => $detailTwo,
                        'footer' => $footDescirpt
                    ]);

                    if (isset($writerImages)) {
                        foreach ($writerImages as $key => $value) {
                            if (isset($writerImages[$key])) {
                                $writerImage = $writerImages[$key];
                                $writerImageName = md5(time()."writer".$key)
                                .'.'
                                .$writerImage->getClientOriginalExtension();
                                $destinationPath = storage_path($this->path);
                                if ($writerImage->move($destinationPath, $writerImageName)) {
                                    $aboutUsId = AboutUs::all()->first();
                                    $aboutUs = AboutUs::find($aboutUsId->id);
                                    $aboutUsWriters = new AboutUsWriters([
                                        'about_us_id' => $aboutUsId->id,
                                        'writer_image' => $this->path.'/'.$writerImageName
                                    ]);
                                    $aboutUs->aboutUsWriters()->save($aboutUsWriters);
                                }
                            }
                        }
                    }
                }
            }
            $request->session()->flash('success', 'Update successful!');
            return redirect()->route('backOffice.website.about-us.index');
        } else {
            $oldData = AboutUs::all()->first();
            $aboutUs = $this->update($request, $oldData);
            $request->session()->flash('success', 'Update successful!');
            return redirect()->route('backOffice.website.about-us.index', 'aboutUs');
        }
        return redirect()->route('backOffice.website.about-us.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backOffice.website.aboutUs.show');
    }

    /**
     * Display the specified resource for printing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        return view('backOffice.website.aboutUs.print');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backOffice.website.aboutUs.update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $aboutUs)
    {
        $imageHead = $request->file('image_head');
        $imageOne = $request->file('image_1');
        $imageTwo = $request->file('image_2');
        $headDescirpt = $request->input('head_descirpt');
        $title = $request->input('title');
        $detailOne = $request->input('detail_one');
        $detailTwo = $request->input('detail_two');
        $footDescirpt = $request->input('foot_descirpt');
        $writerImages = $request->file('writer_image_input_hidden');
        $oldWriterImages = $request->input('old_writer_image_input_hidden');
        Log::info('oldWriterImages'.serialize($oldWriterImages));

        $destinationPath = storage_path($this->path);

        if (isset($imageHead)) {
            $headName = md5(time()."head") . '.' . $imageHead->getClientOriginalExtension();
            if ($imageHead->move($destinationPath, $headName)) {
                $aboutUs->update([ 'image_head' => $this->path.'/'.$headName]);
            }
        }
        if (isset($imageOne)) {
            $imgOneName = md5(time()."one") . '.' . $imageOne->getClientOriginalExtension();
            if ($imageOne->move($destinationPath, $imgOneName)) {
                $aboutUs->update([ 'image_1' => $this->path.'/'.$imgOneName]);
            }
        }
        if (isset($imageTwo)) {
            $imgTwoName = md5(time()."two") . '.' . $imageTwo->getClientOriginalExtension();
            if ($imageTwo->move($destinationPath, $imgTwoName)) {
                $aboutUs->update([ 'image_2' => $this->path.'/'.$imgTwoName]);
            }
        }

        $aboutUs->update([
            'title' => $title,
            'head_description' => $headDescirpt,
            'description_1' => $detailOne,
            'description_2' => $detailTwo,
            'footer' => $footDescirpt
        ]);

        $aboutUsId = AboutUs::all()->first();
        $aboutUs = AboutUs::find($aboutUsId->id);
        $aboutUsWritersDelete = AboutUsWriters::where('about_us_id', $aboutUsId->id);
        $aboutUsWritersDelete->delete();

        if (isset($writerImages)) {
            foreach ($writerImages as $key => $value) {
                if (isset($writerImages[$key])) {
                    $writerImage = $writerImages[$key];
                    $writerImageName = md5(time()."writer".$key) . '.' . $writerImage->getClientOriginalExtension();
                    $destinationPath = storage_path($this->path);
                    if ($writerImage->move($destinationPath, $writerImageName)) {
                        $aboutUsWriters = new AboutUsWriters([
                            'about_us_id' => $aboutUsId->id,
                            'writer_image' => $this->path.'/'.$writerImageName
                        ]);
                        $aboutUs->aboutUsWriters()->save($aboutUsWriters);
                    }
                }
            }
        }

        if (isset($oldWriterImages)) {
            foreach ($oldWriterImages as $key => $value) {
                if (isset($oldWriterImages[$key])) {
                    $aboutUsWriters = new AboutUsWriters([
                        'about_us_id' => $aboutUsId->id,
                        'writer_image' => $oldWriterImages[$key]
                    ]);
                    $aboutUs->aboutUsWriters()->save($aboutUsWriters);
                }
            }
        }
        
        return $aboutUs;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->action('backOffice.website.aboutUs.index');
    }
    
    /**
        * Restore the specified resource back to storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function restore($id)
    {
        return redirect()->action('backOffice.website.aboutUs.index');
    }
}
