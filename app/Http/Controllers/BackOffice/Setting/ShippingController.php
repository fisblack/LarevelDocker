<?php

namespace SenseBook\Http\Controllers\BackOffice\Setting;

use SenseBook\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;

use SenseBook\Models\ShippingFee;
use SenseBook\Models\ShippingRegion;
use SenseBook\Models\ShippingType;

class ShippingController extends Controller
{
    private $perPage = 15;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type_id = $this->request->has('type_id') ? $this->request->type_id : 1;

        $query = ShippingFee::where('type_id', $type_id);

        // search จาก field ไหนก็ได้ ทำเป็นแบบ OR ให้มี %search_term% ก็เจอ
        if ($this->request->has('search')) {
            $data_search = $this->request->search;

            $query = $query
                ->where(function ($q) use ($data_search) {
                    $q->where('maximum_weight', 'LIKE', '%'.$data_search.'%')
                        ->orWhere('amount', 'LIKE', '%'.$data_search.'%')
                        ->orWhere('point_redemption', 'LIKE', '%'.$data_search.'%');
                });

            $searchTerm = $data_search;
        } else {
            $searchTerm = '';
        }

        $data['shippingFees'] = $query
            ->orderBy('region_id', 'ASC')
            ->orderBy('id', 'ASC')
            ->paginate($this->perPage);

        $data['shippingTypes']      = ShippingType::get();
        $data['shippingRegions']    = ShippingRegion::get();

        return view('backOffice.setting.shipping.index')
            ->with('data', $data)
            ->with('type_id', $type_id)
            ->with('search', $searchTerm);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->request->except('_token');
        $type_id = $this->request->has('type_id') ? $this->request->type_id : 1;

        $data['shippingTypes'] = ShippingType::get();
        $data['shippingRegions'] = ShippingRegion::get();
        $data['shippingFees'] = ShippingRegion::with(['fees' => function ($query) use ($type_id) {
            $query->where('type_id', $type_id);
            $query->orderBy('minimum_weight', 'ASC');
        }])
        ->orderBy('id', 'ASC')
        ->get();

        return view('backOffice.setting.shipping.create')
            ->with('data', $data)
            ->with('type_id', $type_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = $this->request->except('_token');

        $type_id = $data['shippingType'];
        $shippingFee = $data['shippingFee'];

        $storeData = array();

        foreach ($shippingFee as $region_id => $fee) {
            $maxRow = count($fee['point']);

            for ($i=0; $i<$maxRow; $i++) {
                if ($fee['amount'][$i]!=null && $fee['point'][$i]!=null) {
                    $storeData[$region_id][$i] = [
                        'type_id'           => $type_id,
                        'region_id'         => $region_id,
                        'minimum_weight'    => $fee['minWeight'][$i],
                        'maximum_weight'    => $fee['maxWeight'][$i],
                        'amount'            => $fee['amount'][$i],
                        'point_redemption'  => $fee['point'][$i]
                    ];
                }
            }
        }

        $storeData = array_collapse($storeData);

        if (count($storeData) < 1) {
            return back()
                ->with('warning', 'Can\'t Create')
                ->withInput();
        }

        try {
            ShippingFee::where('type_id', $type_id)->delete();
        } catch (\Exception $e) {
            return back()
                ->with('warning', 'Can\'t Create Data')
                ->withInput();
        }

        try {
            $result = ShippingFee::insert($storeData);
        } catch (\Exception $e) {
            // return $e->getMessage();
            return back()
                ->with('warning', 'Can\'t Create')
                ->withInput();
        }

        return redirect()
            ->route('backOffice.setting.shipping.index')
            ->with('success', 'Create success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backOffice.setting.shipping.show');
    }

    /**
     * Display the specified resource for printing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        return view('backOffice.setting.shipping.print');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->request->except('_token');
        $type_id = $this->request->has('type_id') ? $this->request->type_id : 1;

        $data['shippingTypes'] = ShippingType::get();
        $data['shippingRegions'] = ShippingRegion::get();
        $data['shippingFees'] = ShippingRegion::with(['fees' => function ($query) use ($type_id) {
            $query->where('type_id', $type_id);
            $query->orderBy('minimum_weight', 'ASC');
        }])
        ->orderBy('id', 'ASC')
        ->get();

        return view('backOffice.setting.shipping.create')
            ->with('data', $data)
            ->with('type_id', $type_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $data = $this->request->except('_token');
        try {
            foreach ($data['region'] as $region) {
                foreach ($region['shippingFee'] as $index => $fee) {
                    if (isset($fee['id'])) {
                        $result = ShippingFee::whereId($fee['id'])->update([
                            'type_id'    => $data['shippingType'],
                            'region_id'  => $region['regionId'],
                            'maximum_weight' => empty($fee['maxWeight']) ? 0 : $fee['maxWeight'],
                            'amount' => empty($fee['amount']) ? $fee['amount'] : $fee['amount'],
                            'point_redemption' => $fee['point'] ? null : 0
                        ]);
                    } else {
                        $result = ShippingFee::create([
                            'type_id'    => $data['shippingType'],
                            'region_id'  => $region['regionId'],
                            'maximum_weight' => empty($fee['maxWeight']) ? 0 : $fee['maxWeight'],
                            'amount' => empty($fee['amount']) ? 0 : $fee['amount'],
                            'point_redemption' => empty($fee['point']) ? 0 : $fee['point']
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {
            return back()
                ->with('warning', 'Can\'t Update')
                ->withInput();
        }

        return redirect()
            ->route('backOffice.setting.shipping.index')
            ->with('success', 'Updated success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->request->except('_token');

        try {
            $result = ShippingFee::find($id)
                ->delete();
        } catch (\Exception $e) {
            return back()
                ->with('warning', 'Can\'t Delete')
                ->withInput();
        }
        return redirect()
            ->route('backOffice.setting.shipping.index', ['type_id'=>$data['type_id']])
            ->with('success', 'Delete success');
    }

    /**
        * Restore the specified resource back to storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    // public function restore($id)
    // {
    //     $data = $this->request->except('_token');
    //     try {
    //         $result = ShippingFee::find($id)->restore();
    //     } catch (\Exception $e) {
    //         return back()
    //             ->with('warning', 'Can\'t Restore')
    //             ->withInput();
    //     }
    //     return redirect()
    //      ->route('backOffice.setting.shipping.index')
    //      ->with('success', 'Restore success');
    // }

    public function getAllShippingTypes()
    {
        return response()->json(ShippingType::all());
    }

    public function getShippingType($id)
    {
        return response()->json(ShippingType::findOrFail($id));
    }

    public function destroyAll()
    {
        $type_id = $this->request->has('type_id') ? $this->request->type_id : 1;
        $deleteId = $this->request->has('deleteId') ? json_decode($this->request->deleteId) : [];

        // process the validation
        $validator = Validator::make($deleteId, [
            'deleteId'      => 'array',
            'deleteId.*'    => 'integer',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $ids= array_map('intval', $data['deleteId']);

        try {
            $result = ShippingFee::whereIn('id', $ids)
                ->delete();
        } catch (\Exception $e) {
            return $e->getMessage();
            return back()
                ->with('warning', 'Can\'t Delete')
                ->withInput();
        }

        return redirect()
            ->route('backOffice.setting.shipping.index', ['type_id'=>$type_id])
            ->with('success', 'Delete success');
    }
}
