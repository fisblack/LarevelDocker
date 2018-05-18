<?php

namespace SenseBook\Http\Controllers\BackOffice\Website;

use SenseBook\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SenseBook\Http\Requests\BackOffice\Website\CategoryNewsAndEventRequest;
use SenseBook\Models\CategoryNewsEvent;

class CategoryNewsAndEventController extends Controller
{
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

            $data['categoriesNews'] = CategoryNewsEvent::where('name_th', 'LIKE', "%{$data_search}%")
                ->orWhere('name_en', 'LIKE', '%{$data_search}%')
                ->paginate($this->perPage);
        } else {
            $data['categoriesNews'] = CategoryNewsEvent::withTrashed()->paginate($this->perPage);
        }
        return view('backOffice.website.categoryNewsAndEvent.index')
            ->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backOffice.website.categoryNewsAndEvent.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryNewsAndEventRequest $request)
    {
        CategoryNewsEvent::create($request->all());
        \Session::flash('success', 'Category news and events created.');
        return redirect()
            ->route('backOffice.website.category-news-and-event.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backOffice.website.categoryNewsAndEvent.show');
    }

    /**
     * Display the specified resource for printing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        return view('backOffice.website.categoryNewsAndEvent.print');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!CategoryNewsEvent::where('id', $id)->exists()) {
            return redirect()
                ->route('backOffice.website.category-news-and-event.index')
                ->with('failure', 'Warning Data not found');
        }
        $data['categoryNews'] = CategoryNewsEvent::find($id);
        return view('backOffice.website.categoryNewsAndEvent.update')
            ->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryNewsAndEventRequest $request, $id)
    {
        if (!CategoryNewsEvent::where('id', $id)->exists()) {
            return redirect()
                ->route('backOffice.website.category-news-and-event.index')
                ->with('failure', 'Warning Data not found');
        }

        CategoryNewsEvent::find($id)->update($request->all());
        \Session::flash('success', 'Category news and events has updated.');
        return redirect()
            ->route('backOffice.website.category-news-and-event.index');
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
            if (!CategoryNewsEvent::withTrashed()->where('id', '=', $id)->exists()) {
                return redirect()
                    ->route('backOffice.website.category-news-and-event.index')
                    ->with('failure', 'Warning Data not found');
            }


            $category = CategoryNewsEvent::withTrashed()->find($id);
            if ($category->trashed()) {
                $category->forceDelete();
                \Session::flash('success', 'Force delete category news and events.');
                return redirect()
                    ->route('backOffice.website.category-news-and-event.index');
            }
            $category->delete();
            \Session::flash('success', 'Delete category news and events.');
            return redirect()
                ->route('backOffice.website.category-news-and-event.index');
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
        if (!CategoryNewsEvent::withTrashed()->where('id', '=', $request->id)->exists()) {
            \Session::flash('failure', 'Category news and events not found.');
        } else {
            CategoryNewsEvent::withTrashed()->find($request->id)->restore();
            \Session::flash('success', 'Restore category news and events.');
        }
        
        return redirect()
            ->route('backOffice.website.category-news-and-event.index');
    }

    public function deleteAll($id)
    {
        foreach ($id as $cID) {
            if (!CategoryNewsEvent::withTrashed()->where('id', '=', $cID)->exists()) {
                return false;
            }

            $category = CategoryNewsEvent::withTrashed()->find($cID);
            if ($category->trashed()) {
                $category->forceDelete();
            } else {
                $category->delete();
            }
        }

        return true;
    }
}
