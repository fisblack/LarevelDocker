<?php

namespace SenseBook\Http\Controllers\Website;

use SenseBook\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SenseBook\Models\Product;
use SenseBook\Models\ProductType;
use SenseBook\Models\AllBooks;
use SenseBook\Models\Category;
use SenseBook\Models\Home;
use SenseBook\Models\UnitImage;
use Stichoza\GoogleTranslate\TranslateClient;
use LanguageDetection\Language;

class BookController extends WebBaseController
{
    public $perPage = 8;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('category') && $request->input('category') !== 'all') {
            $category = $request->input('category');
            $books = Product::whereHas('category', function ($query) use ($category) {
                $query->Where('name_th', 'LIKE', "%{$category}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage)
            ->appends(['category' => $request->input('category')]);
        } else {
            $books = Product::orderBy('created_at', 'desc')->paginate($this->perPage);
        }

        $typeAccept = array('best_seller', 'new_release', 'coming_soon', 'official_goods');
        if ($request->has('type') && in_array($request->type, $typeAccept)) {
            $type = $request->type;
            $typeName = ProductType::where('key', $type)->first();
            $productByType = Home::where('type', $type)
                ->where('product_id', '<>', null)
                ->get();
        } else {
            $type = 'new_release';
            $typeName = ProductType::where('key', $type)->first();
            $productByType = Home::where('type', $type)
                ->where('product_id', '<>', null)
                ->get();
        }

        $productSliders = Product::inRandomOrder()->limit(10)->get();

        $allbook = AllBooks::all()->last();
        $categories = Category::get();
        return view('website.book.index')
            ->with([
                'allbook' => $allbook,
                'books' => $books,
                'categories' => $categories,
                'productByType' => $productByType,
                'typeName' => $typeName,
                'productSliders' => $productSliders
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
        $product = Product::find($id);

        if ($product->description) {
            $product->description = $this->translate($product->description);
        }

        if (empty($product)) {
            abort(404);
        }
        return view('website.book.show')
            ->with('product', $product);
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

    public function pdf($file)
    {
        if (fileStorage_exit('documents/setting/products/' . $file)) {
            return response()->file(storage_path('documents/setting/products/' . $file));
        } else {
            return abort(404);
        }
    }

    public function detectLang($value = '')
    {
        $ld = new Language(['en', 'th']);

        $detectLanguage = $ld->detect($value)->close();
        $lang = '';

        if ($detectLanguage['th'] > $detectLanguage['en']) {
            $lang = 'th';
        } else {
            $lang = 'en';
        }
        
        return $lang;
    }

    public function translate($text = '')
    {
        $trans = new TranslateClient();
        $localLang = getLang();
        $detectLang = $this->detectLang($text);

        if ($localLang !== $detectLang) {
            $trans->setSource($detectLang);
            $trans->setTarget($localLang);
            return $trans->translate($text);
        }
        
        return $text;
    }
}
