<?php

namespace SenseBook\Http\Controllers\BackOffice\Setting;

use SenseBook\Http\Controllers\Controller;
use SenseBook\Http\Requests\BackOffice\Setting\ProductRequest;
use Illuminate\Http\Request;
use SenseBook\Models\Category;
use SenseBook\Models\Product;
use SenseBook\Models\ShippingType as Shipping;
use SenseBook\Models\ProductType;
use SenseBook\Models\UnitImage;
use SenseBook\Models\Writer;

class ProductController extends Controller
{
    public $perPage = 15;
    public $uploadPath = 'images/setting/products';
    public $filePath = 'documents/setting/products';
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

            $data['products'] = Product::where('isbn', 'LIKE', "%{$data_search}%")
                ->orWhere('name', 'LIKE', "%{$data_search}%")
                ->orWhere('name_en', 'LIKE', "%{$data_search}%")
                ->orWhere('description', 'LIKE', "%{$data_search}%")
                ->orWhere('cost', 'LIKE', "%{$data_search}%")
                ->orWhere('suggested_member_price', 'LIKE', "%{$data_search}%")
                ->orWhere('suggested_retail_price', 'LIKE', "%{$data_search}%")
                ->orWhere('page_count', 'LIKE', "%{$data_search}%")
                ->orWhere('weight', 'LIKE', "%{$data_search}%")
                ->orWhere('width', 'LIKE', "%{$data_search}%")
                ->orWhere('depth', 'LIKE', "%{$data_search}%")
                ->orWhere('height', 'LIKE', "%{$data_search}%")
                ->orWhere('reward_points', 'LIKE', "%{$data_search}%")
                ->orWhere('point_redemption_for_free_gift', 'LIKE', "%{$data_search}%")
                ->orWhereHas('category', function ($query) use ($data_search) {
                    $query->Where('name_th', 'like', "%{$data_search}%")
                    ->orWhere('name_en', 'LIKE', "%{$data_search}%");
                })
                ->orWhereHas('shipping', function ($query) use ($data_search) {
                    $query->Where('name', 'like', "%{$data_search}%");
                })
                ->withTrashed()
                ->orderBy('id', 'DESC')
                ->paginate($this->perPage);
        } else {
            $data['products'] = Product::withTrashed()->orderBy('id', 'DESC')->paginate($this->perPage);
        }

        return view('backOffice.setting.product.index')
            ->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['shippings'] = Shipping::get();
        $data['categories'] = Category::get();
        $data['types'] = ProductType::get();
        $data['writers'] = Writer::get();
        return view('backOffice.setting.product.create')
            ->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();

        $product->isbn = $request->isbn;
        $product->name = $request->name;
        $product->name_en = $request->name_en;
        $product->description = $request->description;
        $product->cost = $request->has('cost') ? $request->cost : 0;
        $product->suggested_member_price = $request->has('suggested_member_price') ?
            $request->suggested_member_price : 0;
        $product->suggested_retail_price = $request->has('suggested_retail_price') ?
            $request->suggested_retail_price : 0;
        $product->product_type_id = $request->product_type;
        $product->page_count = $request->page_count;
        $product->weight = $request->weight;
        $product->width = $request->width;
        $product->depth = $request->depth;
        $product->height = $request->height;
        $product->shipping_method_id = $request->shipping_method;
        $product->reward_points = $request->reward_points;
        $product->point_redemption_for_free_gift = $request->has('point_redemption_for_free_gift') ?
            $request->point_redemption_for_free_gift : 0;

        // Upload pdf file
        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');

            $fileName = md5(time()) . '.' . $file->getClientOriginalExtension();
            $destination_path = storage_path($this->filePath);
            if ($file->move($destination_path, $fileName)) {
                $product->file_ref = $this->filePath . '/' . $fileName;
            }
        }
        //End
        $product->is_point_redemption_only = $request->is_point_redemption_only === 'on' ? '1' : '0';
        $product->is_free_shipping = $request->is_free_shipping === 'on' ? '1' : '0';
        $product->is_join_promotion = $request->is_join_promotion === 'on' ? '1' : '0';

        //Save
        if ($product->save()) {
            //Multi cover image
            if ($request->hasFile('coverImg')) {
                foreach ($request->file('coverImg') as $key => $value) {
                    $file = $value;
                    $fileName = md5(time()) . '.' . $file->getClientOriginalExtension();
                    $destination_path = storage_path($this->uploadPath);
                    if ($file->move($destination_path, $fileName)) {
                        $image = UnitImage::create([
                            'product_id' => $product->id,
                            'image' => $this->uploadPath . '/' . $fileName,
                            'order' => $key+1
                        ]);

                        if ($request->book == $key) {
                            $product->cover_image_id = $image->id;
                            $product->update();
                        }
                    }
                    sleep(3);
                }
            }

            $product->category()->sync($request->get('category'));
            $product->writer()->sync($request->get('author'));
            \Session::flash('success', 'Create successful!');
        } else {
            \Session::flash('error', 'Create error!');
        }

        return redirect()->route('backOffice.setting.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backOffice.setting.product.show');
    }

    /**
     * Display the specified resource for printing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        return view('backOffice.setting.product.print');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Product::where('id', $id)->exists()) {
            \Session::flash('failure', 'Can\'t Edit Data');
            return redirect()->route('backOffice.setting.product.index');
        }

        $product = Product::find($id);
        $data['shippings'] = Shipping::get();
        $data['categories'] = Category::get();
        $data['types'] = ProductType::get();
        $data['writers'] = Writer::get();
        return view('backOffice.setting.product.update')
            ->with([
                'data' => $data,
                'product' => $product
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        if (!Product::where('id', $id)->exists()) {
            return redirect()
                ->route('backOffice.setting.product.index')
                ->with('failure', 'Can\'t Edit Data');
        }

        $product = Product::find($id);

        $product->update([
            'isbn' => $request->isbn,
            'name' => $request->name,
            'name_en' => $request->name_en,
            'description' => $request->description,
            'cost' => $request->cost,
            'suggested_member_price' => $request->suggested_member_price,
            'suggested_retail_price' => $request->suggested_retail_price,
            'product_type_id' => $request->product_type,
            'page_count' => $request->page_count,
            'weight' => $request->weight,
            'width' => $request->width,
            'depth' => $request->depth,
            'height' => $request->height,
            'shipping_method_id' => $request->shipping_method,
            'reward_point' => $request->reward_points,
            'point_redemption_for_free_gift' => $request->point_redemption_for_free_gift,
            'is_point_redemption_only' => $request->is_point_redemption_only === 'on' ? '1' : '0',
            'is_free_shipping' => $request->is_free_shipping === 'on' ? '1' : '0',
            'is_join_promotion' => $request->is_join_promotion === 'on' ? '1' : '0'
        ]);

        $product->category()->sync($request->get('category'));
        $product->writer()->sync($request->get('author'));

        // Upload pdf file
        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');

            $fileName = md5(time()) . '.' . $file->getClientOriginalExtension();
            $destination_path = storage_path($this->filePath);
            if ($file->move($destination_path, $fileName)) {
                $product->file_ref = $this->filePath . '/' . $fileName;
            }
        }

        //Multi cover image
        if ($request->hasFile('coverImg')) {
            foreach ($request->file('coverImg') as $key => $value) {
                $file = $value;
                $fileName = md5(time()) . '.' . $file->getClientOriginalExtension();
                $destination_path = storage_path($this->uploadPath);
                if ($file->move($destination_path, $fileName)) {
                    $image = UnitImage::create([
                        'product_id' => $product->id,
                        'image' => $this->uploadPath . '/' . $fileName,
                        'order' => $key+1
                    ]);

                    if ($request->book == $key) {
                        $product->update([
                            'cover_image_id' => $image->id
                        ]);
                    }
                }
                sleep(3);
            }
        } else {
            if ($request->has('book')) {
                $product->update(['cover_image_id' => $request->book]);
            }
        }
        \Session::flash('success', 'Update successful!');
        return redirect()->route('backOffice.setting.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->has('deleteImageID')) {
            return $this->deleteImageCover($id, $request->deleteImageID);
        } else {
            if ($request->has('deleteAll')) {
                if ($this->deleteAll($request->input('id'))) {
                    \Session::flash('success', 'Delete Success');
                } else {
                    \Session::flash('failure', 'Warning Data not found');
                }

                return response()->json([
                    'status' => 200
                ]);
            } else {
                // Check data from DB
                if (!Product::withTrashed()->where('id', $id)->exists()) {
                    return redirect()
                        ->route('backOffice.setting.product.index')
                        ->with('failure', 'Warning Data not found');
                }

                if ($request->has('type') && $request->type === 'soft_delete') {
                    // Soft delete
                    if (Product::where('id', $id)->exists()) { // Sheck state
                        Product::find($id)->delete();
                        \Session::flash('success', 'Delete Success');
                    } else {
                        \Session::flash('confirm', $id);
                    }
                }
                return redirect()->route('backOffice.setting.product.index');
            }
            return redirect()->route('backOffice.setting.product.index');
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
        if (!Product::withTrashed()->where('id', '=', $request->id)->exists()) {
            \Session::flash('failure', 'Warning Data not found.');
        } else {
            Product::withTrashed()->find($request->id)->restore();
            \Session::flash('success', 'Restore Success');
        }

        return redirect()->route('backOffice.setting.product.index');
    }

    public function deleteAll($id)
    {
        foreach ($id as $cID) {
            $product = Product::withTrashed()->find($cID);
            if ($product->trashed()) {
                $product->forceDelete();
            } else {
                $product->delete();
            }
        }

        \Session::flash('success', 'Delete Success');
        return response()->json([
            'status' => 200
        ]);
    }

    public function getAllProduct()
    {
        return response()->json(Product::all());
    }

    public function deleteImageCover($productID, $imageID)
    {
        if ($image = UnitImage::where(['id' => $imageID, 'product_id' => $productID])->first()) {
            if ($image->delete()) {
                return response()->json([
                    'status' => 200
                ]);
            } else {
                return response()->json([
                    'status' => 204,
                    'massage' => 'Data not found!!'
                ]);
            }
        } else {
            return response()->json([
                'status' => 204,
                'massage' => 'Data not found!!'
            ]);
        }
    }

    public function getProductFull()
    {
        $products = Product::all();
        $items = [];
        foreach ($products as $product) {
            $product->image = !empty($product->coverImage) ? getImage($product->coverImage->image) : noImage();
            $product->writer = !empty($product->writer()->first()) ? $product->writer()->first() : '';
            $items[] = $product;
        }
        return response()->json($items);
    }

    public function getImageSource(Request $request)
    {
        if ($request->has('cover_image_id') && !empty($request->get('cover_image_id'))) {
            $image = UnitImage::find(intval($request->get('cover_image_id')));

            if ($image) {
                return getImage($image->image);
            }
        }

        return noImage();
    }

    public function findProduct(Request $request)
    {
        $typeId = $request->get('type', 'order');
        $operator = '!=';

        if ($typeId !== 'order') {
            $operator = '=';
        }

        $product = Product::where('product_type_id', $operator, 5)
            ->where(function ($query) use ($request) {
                $query->where('name', 'LIKE', "%{$request->get('q')}%");
                $query->orWhere('name_en', 'LIKE', "%{$request->get('q')}%");
            })
            ->get();

        return response()->json($product);
    }
}
