<?php

namespace SenseBook\Http\Controllers\Website;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use SenseBook\Http\Controllers\Controller;
use SenseBook\Models\Bank;
use SenseBook\Models\FactBankAccount;
use SenseBook\Models\ReportPayment;
use SenseBook\Models\SaleOrder;

/**
 * Class ReportPaymentController
 * @package SenseBook\Http\Controllers\Website
 */
class ReportPaymentController extends WebBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::all();
        $factbankaccount = FactBankAccount::all();
        foreach ($banks as $k1 => $v1) {
            foreach ($factbankaccount as $k2 => $v2) {
                if ($v2->id == $v1->bank_id) {
                    $v1->logo = $v2->logo;
                }
            }
        }
        $orders = null;
        if (Auth::check()) {
            $orders = SaleOrder::where('user_id', Auth::id())->pluck('id');
        }
        return view('website.reportPayment.index', compact('banks', 'orders', 'factbankaccount'));
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
        if ($request->hasFile('fileupload')) {
            $time = strval(time());
            $uid_filename = sha1($request->fileupload->path().strval(time()));
            $uid_filename .= '.'.$request->fileupload->getClientOriginalExtension();
            $date = date('Y/m');
            $file_path = $request->fileupload->storeAs("public/slips/{$date}", $uid_filename, 'local');
            $storage_path = Storage::url($file_path);
            $timestring = "{$request->date} {$request->hour}:{$request->minute}";
            $timestamp = \DateTime::createFromFormat("d-m-Y H:i", $timestring);
            $update_success = ReportPayment::insert([
                'order_id'          => $request->order_id,
                'bank_id'           => $request->bank,
                'payment_amount'    => $request->amount,
                'slip_location'     => $storage_path,
                'description'       => $request->description,
                'report_timestamp'  => $timestamp->format('Y-m-d H:i:s'),
                'created_at'        => date('Y-m-d H:i:s'),
            ]);
            session()->flash('createReportPayment', $update_success);
        } else {
            session()->flash('createReportPayment', false);
        }
        return redirect()->back();
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
}
