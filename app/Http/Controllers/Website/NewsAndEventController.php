<?php

namespace SenseBook\Http\Controllers\Website;

use SenseBook\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SenseBook\Models\NewsEvent;
use Carbon\Carbon;

class NewsAndEventController extends WebBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['newsAndEvent'] = [];
        $data['lastPosts'] = [];

        $post = $this->getLastPost();
        foreach ($post as $key => $value) {
            if ($key < 1) {
                $data['newsAndEvent'] = $value;
            } else {
                $data['lastPosts'][] = $value;
            }
        }
        return view('website.newsAndEvent.index')
            ->with('data', $data);
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
        $data['newsAndEvent'] = NewsEvent::find($id);
        $data['lastPosts'] = $this->getLastPost(3);
        return view('website.newsAndEvent.show')
            ->with('data', $data);
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

    public function getLastPost($limit = 4)
    {
        return NewsEvent::where('is_show', 1)
            ->orderBy('updated_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
