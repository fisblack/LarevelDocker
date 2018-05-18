<?php

namespace SenseBook\Http\Controllers\BackOffice;

use SenseBook\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SenseBook\Models\SaleOrder;
use SenseBook\Models\DeliveryTrackingItem;

class ScanPoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // search จาก field ไหนก็ได้ ทำเป็นแบบ OR ให้มี %search_term% ก็เจอ

        return view('backOffice.scanPO.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backOffice.scanPO.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // po_number
        // ems_number
        $SaleOrder = SaleOrder::find($request->po_number);
        if (empty($SaleOrder)) {
            session()->flash('error', "หาเลข Po ไม่เจอ");
            return redirect()->route('backOffice.scan-po.index');
        } else {
            $DeliveryTrackingItem = DeliveryTrackingItem::where('sales_order_id', $request->po_number)
                                ->where('logistic_tracking_number', $request->ems_number)->first();
            if (empty($DeliveryTrackingItem)) {
                DeliveryTrackingItem::create([
                    'sales_order_id' => $SaleOrder->id,
                    'logistic_tracking_number' => $request->ems_number
                ]);
                session()->flash('success', "บันทึกสำเร็จ");
                return redirect()->route('backOffice.scan-po.index');
            } else {
                session()->flash('error', "เลข EMS ซ้ำกัน");
                return redirect()->route('backOffice.scan-po.index');
            }
            
            // session()->flash('success', "บันทึกสำเร็จ");
            // return redirect()->route('backOffice.scan-po.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backOffice.scanPO.show');
    }

    /**
     * Display the specified resource for printing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        return view('backOffice.scanPO.print');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backOffice.scanPO.update');
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
        return redirect()->route('backOffice.scan-po.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->route('backOffice.scan-po.index');
    }
    
    /**
        * Restore the specified resource back to storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function restore($id)
    {
        return redirect()->route('backOffice.scan-po.index');
    }
}
