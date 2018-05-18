<?php

namespace SenseBook\Http\Controllers\BackOffice\Website;

use SenseBook\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SenseBook\Models\Home;
use SenseBook\Models\Product;
use SenseBook\Models\ProductType;
use SenseBook\Models\SaleOrderItem;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['best_seller'] = Home::where('type', 'best_seller')->get();
        $data['new_release'] = Home::where('type', 'new_release')->get();
        $data['coming_soon'] = Home::where('type', 'coming_soon')->get();
        $data['official_goods'] = Home::where('type', 'official_goods')->get();

        $data['data_best_seller'] = $this->getProductByType('best_seller');
        $data['data_new_release'] = $this->getProductByType('new_release');
        $data['data_coming_soon'] = $this->getProductByType('coming_soon');
        $data['data_official_goods'] = $this->getProductByType('official_goods');

        return view('backOffice.website.home.index')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->home as $key => $value) {
            Home::find($key)->update(['product_id' => $value]);
        }
        \Session::flash('success', 'Update successful!');
        return redirect()->route('backOffice.website.home.index');
    }
    
    public function getFromCalculate(Request $request)
    {
        $typeAccept = array('best_seller', 'new_release', 'coming_soon', 'official_goods');
        if ($request->has('type') && in_array($request->type, $typeAccept)) {
            $type = $request->type;
            if ($type == 'best_seller') {
                $bestSeller = $this->getProductBestSeller();
                return response()->json([
                    'status' => 200,
                    'data' => $bestSeller
                ]);
            }
            $products = $this->getProductByType($type);
            if (empty($products)) {
                return response()->json([
                    'status' => 404,
                    'data' => 'Not found'
                ]);
            }
            return response()->json([
                'status' => 200,
                'data' => $products
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'data' => 'Not found'
            ]);
        }
    }

    public function getProductByType($type = '', $limit = 15)
    {
        $productType = ProductType::where('key', $type)->first();
        return Product::where('product_type_id', $productType->id)
            ->limit($limit)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getProductBestSeller()
    {
        $productFrequent = SaleOrderItem::select('product_id')
            ->selectRaw('COUNT(product_id) AS count')
            ->groupBy('product_id')
            ->orderByDesc('count')
            ->limit(15)
            ->get();
        $productID = [];
        foreach ($productFrequent as $product) {
            $productID[] = Product::find($product->product_id);
        }
        return $productID;
    }
}
