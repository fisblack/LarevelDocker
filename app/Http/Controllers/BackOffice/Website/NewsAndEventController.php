<?php

namespace SenseBook\Http\Controllers\BackOffice\Website;

use SenseBook\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use SenseBook\Http\Requests\BackOffice\Website\NewsAndEventRequest;
use Illuminate\Http\Request;
use SenseBook\Models\NewsEvent;
use SenseBook\Models\CategoryNewsEvent;

class NewsAndEventController extends Controller
{
    public $path = 'images/news-and-events';
    public $perPage = 15;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // search จาก field ไหนก็ได้ ทำเป็นแบบ OR ให้มี %search_term% ก็เจอ
        if ($request->has('search')) {
            $data_search = $request->search;

            $data['newsEvents'] = NewsEvent::where('title_th', 'LIKE', "%{$data_search}%")
                ->orWhere('title_th', 'LIKE', '%{$data_search}%')
                ->orWhere('short_description_th', 'LIKE', '%{$data_search}%')
                ->orWhere('short_description_en', 'LIKE', '%{$data_search}%')
                ->orWhere('description_th', 'LIKE', '%{$data_search}%')
                ->orWhere('description_en', 'LIKE', '%{$data_search}%')
                ->orWhereHas('category', function ($query) use ($data_search) {
                    $query->Where('name_th', 'like', "%{$data_search}%")
                    ->orWhere('name_en', 'LIKE', '%{$data_search}%');
                })
                ->paginate($this->perPage);
        } else {
            $data['newsEvents'] = NewsEvent::withTrashed()->paginate($this->perPage);
        }
        return view('backOffice.website.newsAndEvent.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = CategoryNewsEvent::get();
        return view('backOffice.website.newsAndEvent.create')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsAndEventRequest $request)
    {
        //NewsEvent::create($request->all());
        $image = $request->file('image');
        $banner = $request->file('banner');
        $saveImage = null;
        $bannerUploaded = null;
        if (isset($image)) {
            $imageName = md5(time()) . '.' . $image->getClientOriginalExtension();

            $destinationPath = storage_path($this->path);
            if ($image->move($destinationPath, $imageName)) {
                $saveImage = $this->path.'/'.$imageName;
            }
        }

        if (isset($banner)) {
            $bannerUploaded = uploadImage($banner, $this->path);
        }

        $news_events_date = new \DateTime($request->input('news_events_date'));

        NewsEvent::create(array_merge($request->all(), [
                'member_id' => Auth::user()->id,
                'image' => $saveImage,
                'banner' => $bannerUploaded['full'],
                'news_events_date' => $news_events_date,
                'is_show' => $request->input('is_show') === 'on' ? 1 : 0
            ]));

        \Session::flash('success', 'Updated Success');

        return redirect()->route('backOffice.website.news-and-event.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backOffice.website.newsAndEvent.show');
    }

    /**
     * Display the specified resource for printing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        return view('backOffice.website.newsAndEvent.print');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!NewsEvent::where('id', $id)->exists()) {
            return redirect()
                ->route('backOffice.website.news-and-event.index')
                ->with('failure', 'Warning Data not found');
        }

        $data['categories'] = CategoryNewsEvent::get();
        $data['newsAndEvent'] = NewsEvent::find($id);

        return view('backOffice.website.newsAndEvent.update')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsAndEventRequest $request, $id)
    {
        if (!NewsEvent::where('id', $id)->exists()) {
            return redirect()
                ->route('backOffice.website.news-and-event.index')
                ->with('failure', 'Warning Data not found');
        }
        $news = NewsEvent::find($id);


        if ($request->hasFile('banner')) {
            $banner = $request->file('banner');
            $bannerUploaded = uploadImage($banner, $this->path);
            sleep(3);
            $news->update(['banner' => $bannerUploaded['full']]);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageUploaded = uploadImage($image, $this->path);
            sleep(3);
            $news->update(['image' => $imageUploaded['full']]);
        }

        $news->update(array_merge($request->except(['banner', 'image', 'is_show']), [
                'is_show' => $request->input('is_show') === 'on' ? 1 : 0
            ]));
        \Session::flash('success', 'News and events updated.');
        return redirect()->route('backOffice.website.news-and-event.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->has('deleteAll')) {
            if ($this->deleteAll($request->input('id'))) {
                \Session::flash('success', 'Delete category news and events.');
            } else {
                \Session::flash('failure', 'Warning Data not found');
            }

            
            return response()->json([
                'status' => 200
            ]);
        } else {
            if (!NewsEvent::withTrashed()->where('id', '=', $id)->exists()) {
                return redirect()
                    ->route('backOffice.website.news-and-event.index')
                    ->with('failure', 'Warning Data not found');
            }

            $news = NewsEvent::withTrashed()->find($id);
            if ($news->trashed()) {
                $news->forceDelete();
                \Session::flash('success', 'Force Delete Success');
                return redirect()->route('backOffice.website.news-and-event.index');
            }
            $news->delete();
            \Session::flash('success', 'Delete Success');
            return redirect()->route('backOffice.website.news-and-event.index');
        }
    }
    
    /**
        * Restore the specified resource back to storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function restore(Request $request)
    {
        if (!NewsEvent::withTrashed()->where('id', '=', $request->id)->exists()) {
            \Session::flash('failure', 'Warning Data not found.');
        } else {
            NewsEvent::withTrashed()->find($request->id)->restore();
            \Session::flash('success', 'Restore Success');
        }
        
        return redirect()->route('backOffice.website.news-and-event.index');
    }

    public function deleteAll($id)
    {
        foreach ($id as $cID) {
            $category = NewsEvent::withTrashed()->find($cID);
            if ($category->trashed()) {
                $category->forceDelete();
            } else {
                $category->delete();
            }
        }

        \Session::flash('success', 'Delete Success');
        return response()->json([
            'status' => 200
        ]);
    }
}
