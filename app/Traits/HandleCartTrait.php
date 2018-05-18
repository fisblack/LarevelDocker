<?php

namespace SenseBook\Traits;

use SenseBook\Models\Product;

trait HandleCartTrait
{
    protected function listProductsCart(\Illuminate\Http\Request $request)
    {

        $carts = $request->session()->get('cart');


        if (empty($carts)) {
            $request->session()->flash('empty-cart', 'Missing books');
            return redirect()->route('index');
        } else {
            $bookIds = collect([]);
            foreach ($carts as $key => $book) {
                $bookIds->put($key, $book['book_id']);
            }

            $products = Product::whereIn('id', $bookIds->toArray())
                ->with('writer')
                ->get();

            if ($products && !empty($carts)) {
                foreach ($carts as $item) {
                    $products = $products->map(function ($product) use ($item) {
                        if ($product->id === intval($item['book_id'])) {
                            $product->qty = intval($item['qty']);
                            $product->total_price = $product->qty * $product->suggested_member_price;

                            if (!empty($product->coverImage)) {
                                $product->image_path = getImage($product->coverImage->image);
                            } else {
                                $product->image_path = noImage();
                            }
                        }
                        return $product;
                    });
                }
            }
        }

        $totalPrice = $products->sum('total_price');

        return [
            'products' => $products,
            'total_price' => $totalPrice
        ];
    }
}
