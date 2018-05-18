<?php

namespace SenseBook\Http\Controllers\Website;

use SenseBook\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SenseBook\Models\Banner;
use SenseBook\Models\Product;
use SenseBook\Models\ProductType;
use SenseBook\Models\Category;
use SenseBook\Models\Home;

class HomeController extends WebBaseController
{
    public $itemLimit = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['banners'] = Banner::where(['is_promotion' => '0', 'is_show' => '1'])->get();
        $data['promotion'] = Banner::where(['is_promotion' => '1'])->first();
        $bestSeller = Home::where('type', 'best_seller')->where('product_id', '<>', null)->get();
        $bestNew = Home::where('type', 'new_release')->where('product_id', '<>', null)->get();
        $commingSoon = Home::where('type', 'coming_soon')->where('product_id', '<>', null)->get();
        $official = Home::where('type', 'official_goods')->where('product_id', '<>', null)->get();

        return view('website.home.index')
            ->with([
                'data' => $data,
                'bestSeller' => $bestSeller,
                'bestNew' => $bestNew,
                'commingSoon' => $commingSoon,
                'official' => $official
            ]);
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
        //
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

    public function getBestSeller()
    {
        $pt = ProductType::where('key', 'best_seller')->first();
        return Product::where('product_type_id', $pt->id)
            ->orderBy('created_at', 'desc')
            ->limit($this->itemLimit)
            ->get();
    }

    public function getNewBook()
    {
        $pt = ProductType::where('key', 'new_release')->first();
        return Product::where('product_type_id', $pt->id)
            ->orderBy('created_at', 'desc')
            ->limit($this->itemLimit)
            ->get();
    }

    public function getByCategory()
    {
        $p = Category::first();
        dump($p->product()->get());
        return Product::orderBy('created_at', 'desc')
            ->limit($this->itemLimit)
            ->get();
    }

    public function getCommingSoon()
    {
        $pt = ProductType::where('key', 'coming_soon')->first();
        return Product::where('product_type_id', $pt->id)
            ->orderBy('created_at', 'desc')
            ->limit($this->itemLimit)
            ->get();
    }

    public function getByOfficial()
    {
        $pt = ProductType::where('key', 'official_goods')->first();
        return Product::where('product_type_id', $pt->id)
            ->orderBy('created_at', 'desc')
            ->limit($this->itemLimit)
            ->get();
    }
}
