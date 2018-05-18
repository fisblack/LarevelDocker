<?php

namespace SenseBook\Http\Controllers\BackOffice\Website;

use Storage;
use Illuminate\Http\File;
use SenseBook\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SenseBook\Models\Banner;

class BannerController extends Controller
{
    public $path = 'images/banner';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // search จาก field ไหนก็ได้ ทำเป็นแบบ OR ให้มี %search_term% ก็เจอ
        $data['banners'] = Banner::where('is_promotion', '0')->get();
        $data['promotion'] = Banner::where('is_promotion', '1')->first();
        return view('backOffice.website.banner.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backOffice.website.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->input('id');
        $images = $request->file('image');
        $url_images = $request->input('url_image');
        $is_shows = $request->input('is_show');

        foreach ($id as $key => $value) {
            $banner = Banner::find($value);
            if (isset($images[$key])) {
                $image = $images[$value];
                $imageUploaded = uploadImage($image, $this->path);
                $banner->update([ 'image' => $imageUploaded['full']]);
                sleep(3);
            }

            if (isset($is_shows[$value])) {
                $banner->update([
                    'is_show' => '1',
                    'url_image' => $url_images[$value]
                ]);
            } else {
                $banner->update([
                    'is_show' => '0',
                    'url_image' => $url_images[$value]
                ]);
            }
        }
        \Session::flash('success', 'Banner has updated.');
        return redirect()->route('backOffice.website.banner.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backOffice.website.banner.show');
    }

    /**
     * Display the specified resource for printing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        return view('backOffice.website.banner.print');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backOffice.website.banner.update');
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
        $banner = Banner::find($id);
        if ($request->file('image')) {
            $image = $request->file('image');
            $name = md5(time()) . '.' . $image->getClientOriginalExtension();
            
            $destinationPath = storage_path($this->path);
            if ($image->move($destinationPath, $name)) {
                $banner->update([ 'image' => $this->path.'/'.$name]);
            }
        }
        // Update url
        $banner->update([ 'url_image' => $request->input('url_image')]);

        return redirect()->route('backOffice.website.banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->action('backOffice.website.banner.index');
    }
    
    /**
        * Restore the specified resource back to storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function restore($id)
    {
        return redirect()->action('backOffice.website.banner.index');
    }
}
