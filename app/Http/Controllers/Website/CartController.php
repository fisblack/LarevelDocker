<?php

namespace SenseBook\Http\Controllers\Website;

use Illuminate\Http\Request;
use SenseBook\Http\Controllers\Controller;
use SenseBook\Models\Product;
use SenseBook\Traits\HandleCartTrait;

class CartController extends Controller
{
    use HandleCartTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json($this->listProductsCart($request));
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
        $carts = collect($request->session()->get('cart'));

        if ($request->session()->has('cart') && $carts->isNotEmpty()) {
            /**
             * Each cart update qty
             */
            $foundItem = false;
            $carts = $carts->map(function ($cart) use ($request, &$foundItem) {
                if (intval($request->get('book_id')) === intval($cart['book_id'])) {
                    $cart['qty'] += intval($request->get('qty'));
                    $foundItem = true;
                }
                return $cart;
            });

            if (!$foundItem) {
                $carts->put($request->get('book_id'), [
                    'book_id' => intval($request->get('book_id')),
                    'qty' => intval($request->get('qty'))
                ]);
            }
        } else {
            $carts->put(intval($request->get('book_id')), [
                'book_id' => intval($request->get('book_id')),
                'qty' => intval($request->get('qty'))
            ]);
        }

        $request->session()->forget('cart');

        $request->session()->put('cart', $carts->all());


        return response()->json($request->session()->get('cart'));
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
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $carts = collect($request->session()->get('cart'));
        $newCarts = collect([]);

        if ($request->session()->has('cart') && $carts->isNotEmpty()) {
            /**
             * Each cart update qty
             */
            $foundItem = false;
            $carts = $carts->map(function ($cart) use ($request, &$foundItem, $id, &$newCarts) {
                if (intval($cart['book_id']) !== intval($id)) {
                    $newCarts->put($cart['book_id'], [
                        'book_id' => intval($cart['book_id']),
                        'qty' => intval($cart['qty'])
                    ]);
                } else {
                    $foundItem = true;
                }

                return $cart;
            });

            if (!$foundItem) {
                $newCarts = $carts;
            }
        }

        $request->session()->forget('cart');

        $request->session()->put('cart', $newCarts->all());




        return response()->json($request->session()->get('cart'));
    }

    public function delete(Request $request)
    {
        $request->session()->forget('cart');
        return $request->json($request);
    }
}
