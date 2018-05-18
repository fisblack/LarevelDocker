<?php

namespace SenseBook\Http\Controllers;

use Illuminate\Http\Request;
use Payment2C2P;

class Payment2c2pController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website.app2c2p.index');
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
    
    public function prepare(Request $request)
    {
        $payload = \Payment2C2P::paymentRequest([
        'desc' => '1 book for testing',
        'uniqueTransactionCode' => "Invoice".time(),
        'amt' => $request->session()->get('cart_checkout')['total_price'],
        'currencyCode' => config('laravel-2c2p.currency_code'),
        'cardholderName' => 'Card holder Name',
        'cardholderEmail' => 'email@emailcom',
        'panCountry' => 'TH',
        'result_url_1'=>'localhost/2c2pres',
        'encCardData' => $request->input('encryptedCardInfo'), // Retrieve encrypted credit card data
         'userDefined1' => 'userDefined1',
        'userDefined2' => 'userDefined2'
        ]);
        return view('website.app2c2p.prepare')->with(compact('payload'));
    }
    
    public function res2c2p()
    {
        $response = $_REQUEST["paymentResponse"];
        $response = \Payment2C2P::getData($response);
        dd($response);
//        $res = $request->has('paymentResponse');
//        if ($res) {
//            $response = \Payment2C2P::getData($request->get('paymentResponse'));
//            dd($response);
//        } else {
//            $val = $request->all();
//            dd($val);
//        }
    }
}
