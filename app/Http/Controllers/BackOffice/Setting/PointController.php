<?php

namespace SenseBook\Http\Controllers\BackOffice\Setting;

use SenseBook\Http\Controllers\Controller;
use Redirect;
use Request;
use Response;
use Session;
use Validator;
use View;

use SenseBook\Models\Point;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Request::except('_token');

        $query = Point::withTrashed();

        $searchTerm = '';

        // search จาก field ไหนก็ได้ ทำเป็นแบบ OR ให้มี %search_term% ก็เจอ
        if (isset($data['search']) || !empty($data['search'])) {
            $query = $query
                ->where('points', intval($data['search']))
                ->orWhere('discount', intval($data['search']));

            $searchTerm = $data['search'];
        }

        $points = $query->paginate(15);

        return view('backOffice.setting.point.index')
            ->with('items', $points)
            ->with('search', $searchTerm);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backOffice.setting.point.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = Request::except('_token');

        // process the validation
        $validator = Validator::make($data, [
            'points'    => 'required|integer|min:0',
            'discount'  => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return back()
                ->with('warning', 'Number Only, At least 0')
                ->withInput();
        }

        // store
        try {
            $result = Point::create([
                'points'    => intval($data['points']),
                'discount'  => intval($data['discount']),
            ]);
        } catch (\Exception $e) {
            return back()
                ->with('warning', 'Can\'t Create')
                ->withInput();
        }

        return redirect()
                ->route('backOffice.setting.point.index')
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
        return view('backOffice.setting.point.show');
    }

    /**
     * Display the specified resource for printing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        return view('backOffice.setting.point.print');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Request::except('_token');

        $data = array_add($data, 'id', $id);

        // process the validation
        $validator = Validator::make($data, [
            'id'    =>  'required|integer',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        // get
        try {
            $point = Point::find(intval($data['id']));
        } catch (\Exception $e) {
            return back()
                ->with('warning', 'Can\'t Edit Data')
                ->withInput();
        }

        if ($point===null || $point->trashed()) {
            return back()
                ->with('warning', 'Can\'t Edit Data')
                ->withInput();
        }

        return view('backOffice.setting.point.update')->with('item', $point);
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
        $data = Request::except('_token');

        $data = array_add($data, 'id', $id);

        // get
        try {
            $point = Point::withTrashed()
                ->find(intval($data['id']));
        } catch (\Exception $e) {
            return redirect()
                ->route('backOffice.setting.point.index')
                ->with('warning', 'Can\'t Edit Data');
        }

        if ($point===null || $point->trashed()) {
            return redirect()
                ->route('backOffice.setting.point.index')
                ->with('warning', 'Can\'t Edit Data');
        }

        // process the validation
        $validator = Validator::make($data, [
            'id'        => 'required|integer',
            'points'    => 'required|integer|min:0',
            'discount'  => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return back()
                ->with('warning', 'Number Only, At least 0')
                ->withInput();
        }

        // update
        try {
            $point = Point::whereId($data['id'])
                ->update([
                    'points'    => intval($data['points']),
                    'discount'  => intval($data['discount']),
                ]);
        } catch (\Exception $e) {
            return back()
                ->with('warning', 'Can\'t Edit Data')
                ->withInput();
        }

        return redirect()
                ->route('backOffice.setting.point.index')
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
        $data = Request::except('_token');

        $data = array_add($data, 'id', $id);

        // process the validation
        $validator = Validator::make($data, [
            'id'    => 'required|integer',
            'type'  => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        // get
        try {
            $point = Point::withTrashed()
                ->find(intval($data['id']));
        } catch (\Exception $e) {
            return back()
                ->with('warning', 'Can\'t delete Data')
                ->withInput();
        }

        if (is_null($point) || !isset($data['type'])) {
            return back()
                ->with('warning', 'Can\t delete Data')
                ->withInput();
        }

        if ($point->trashed() && $data['type'] == 'force') {
            $point->forceDelete();

            return redirect()
                    ->route('backOffice.setting.point.index')
                    ->with('success', 'Force Deleted success');
        } elseif (!$point->trashed() && $data['type'] == 'soft') {
            $point->delete();

            return redirect()
                    ->route('backOffice.setting.point.index')
                    ->with('success', 'Deleted success');
        }

        return back()
            ->with('warning', 'Data not found')
            ->withInput();
    }

    public function destroyAll()
    {
        $data = Request::except('_token');

        // process the validation
        $validator = Validator::make($data, [
            'deleteId'      => 'array',
            'deleteId.*'    => 'integer',
            'fDeleteId'     => 'array',
            'fDeleteId.*'   => 'integer',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        // muliple softdelete
        $intSoftIds = isset($data['deleteId']) ? array_map('intval', $data['deleteId']) : [];

        $softDelete = null;

        try {
            $softDelete = Point::whereIn('id', $intSoftIds)->count();
        } catch (\Exception $e) {
            return back()
                ->with('warning', 'Can\t delete Data')
                ->withInput();
        }

        // muliple forcedelete
        $intForceIds = isset($data['fDeleteId']) ? array_map('intval', $data['fDeleteId']) : [];

        $forceDelete = null;

        try {
            $forceDelete = Point::withTrashed()
            ->whereIn('id', $intForceIds)
            ->count();
        } catch (\Exception $e) {
            return back()
                ->with('warning', 'Can\t delete Data')
                ->withInput();
        }

        if (sizeof($intSoftIds)!==$softDelete || sizeof($intForceIds)!==$forceDelete) {
            return back()
                ->with('warning', 'Some data missing!')
                ->withInput();
        }

        try {
            Point::whereIn('id', $intSoftIds)
                ->delete();
        } catch (\Exception $e) {
            return back()
                ->with('warning', 'Can\t delete Data')
                ->withInput();
        }

        try {
            Point::withTrashed()
                ->whereIn('id', $intForceIds)
                ->ForceDelete();
        } catch (\Exception $e) {
            return back()
                ->with('warning', 'Can\t delete Data')
                ->withInput();
        }

        return redirect()
                ->route('backOffice.setting.point.index')
                ->with('success', 'Deleted success');
    }

    /**
        * Restore the specified resource back to storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function restore($id)
    {
        $data = Request::except('_token');

        $data = array_add($data, 'id', $id);

        // process the validation
        $validator = Validator::make($data, [
            'id'    =>  'required_without:ids|integer',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        // get
        try {
            $point = Point::withTrashed()
                ->find(intval($data['id']));
        } catch (\Exception $e) {
            // Session::put('warning', 'Something Error!');
            return back()
                ->with('warning', 'Can\'t Restore')
                ->withInput();
        }

        if (is_null($point)) {
            // Session::put('warning', 'Can\t Edit Data');
            return back()
                ->with('warning', 'Can\'t Edit Data')
                ->withInput();
        }

        if (!$point->trashed()) {
            // Session::put('success', 'Restore success');
            return redirect()
                    ->route('backOffice.setting.point.index')
                    ->with('success', 'Restore success');
        }

        // restore
        try {
            $point->restore();
        } catch (\Exception $e) {
            // Session::put('warning', 'Can\'t Restore Data');
            return back()
                ->with('warning', 'Can\'t Restore')
                ->withInput();
        }

        // Session::put('success', 'Restore success');

        return redirect()
                ->route('backOffice.setting.point.index')
                ->with('success', 'Restore success');
    }
}
