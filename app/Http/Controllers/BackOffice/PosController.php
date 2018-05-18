<?php

namespace SenseBook\Http\Controllers\BackOffice;

use DateTime;
use http\Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use SenseBook\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SenseBook\Http\Requests\BackOffice\CreatePOSRequest;
use SenseBook\POS;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search') && $request->get('search') == '') {
            return redirect()->route('backOffice.pos.index');
        } else {
            if (!empty($request->get('search'))) {
                $pos = POS::withTrashed()
                    ->search($request->get('search'), ['points'])
                    ->orWhereHas('member', function ($query) use ($request) {
                        $query->where('full_name', "LIKE", "%{$request->get('search')}%");
                    })
                    ->orWhereHas('staff', function ($query) use ($request) {
                        $query->where('full_name', "LIKE", "%{$request->get('search')}%");
                    })
                    ->paginate(15);
            } else {
                $pos = POS::withTrashed()->paginate(15);
            }
        }

        return view('backOffice.pos.index')->with(compact('pos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backOffice.pos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePOSRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePOSRequest $request)
    {
        try {
            $pos = new POS();
            $pos->member_id = $request->input('member_id');
            $pos->staff_id = Auth::id();
            $pos->points = $request->input('points');
            $pos->save();

            $datetime = new DateTime(date('Y-m-d', strtotime('now')));
            $dob = $pos->dates()->create([
                'date' => $datetime->format('d'),
                'day' => $datetime->format('l'),
                'day_of_week' => ((int)$datetime->format('w') + 1),
                'month' => $datetime->format('m'),
                'month_name' => $datetime->format('F'),
                'quarter' => ceil($datetime->format('m') / 3),
                'quarter_name' => '',
                'year' => $datetime->format('Y')
            ]);

            $pos->update(['date_id' => $dob->id]);

            Session::flash('success', "Created Success");
        } catch (Exception $e) {
            Session::flash('failure', "Something went wrong, please try again.");
            return redirect()->route('backOffice.pos.index');
        }

        return redirect()->route('backOffice.pos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backOffice.pos.show');
    }

    /**
     * Display the specified resource for printing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        return view('backOffice.pos.print');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pos = Pos::query()->withTrashed()->find($id);

        return view('backOffice.pos.update')->with(compact('pos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pos = POS::query()->withTrashed()->find($id);

        try {
            if ($pos !== null) {
                if (!$pos->trashed()) {
                    $pos->update([
                        'points' => $request->input('points')
                    ]);

                    Session::flash('success', "Updated Success");
                } else {
                    Session::flash('failure', "Can't edit data");
                    return redirect()->route('backOffice.pos.index');
                }
            } else {
                Session::flash('failure', "Data not found");
                return redirect()->route('backOffice.pos.index');
            }
        } catch (Exception $e) {
            Session::flash('failure', "Something went wrong, please try again.");
            return redirect()->route('backOffice.pos.index');
        }

        return redirect()->route('backOffice.pos.edit', $pos->id)->with(compact('pos'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pos = POS::withTrashed()->where('id', '=', $id)->first();

        try {
            if ($pos !== null) {
                if (!$pos->trashed()) {
                    $pos->delete();
                    Session::flash('success', "Deleted Success");
                } else {
                    $pos->forceDelete();
                    Session::flash('success', "Force Deleted Success");
                }
            } else {
                Session::flash('failure', "Data not found");
                return redirect()->route('backOffice.pos.index');
            }
        } catch (Exception $e) {
            Session::flash('failure', "Something went wrong, please try again.");
            return redirect()->route('backOffice.pos.index');
        }

        return redirect()->route('backOffice.pos.index');
    }
    
    /**
        * Restore the specified resource back to storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function restore($id)
    {
        $pos = POS::withTrashed()->where('id', '=', $id)->first();

        try {
            if ($pos !== null) {
                if ($pos->trashed()) {
                    $pos->restore();
                    Session::flash('success', "Restored Success");
                }
            } else {
                Session::flash('failure', "Data not found");
                return redirect()->route('backOffice.pos.index');
            }
        } catch (Exception $e) {
            Session::flash('failure', "Something went wrong, please try again.");
            return redirect()->route('backOffice.pos.index');
        }

        return redirect()->route('backOffice.pos.index');
    }

    /**
     * Restore the specified resource back to storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function deleteSelected(Request $request)
    {
        try {
            $deleted = 0;
            $forceDeleted = 0;
            foreach ($request->input('selected') as $id) {
                $pos = POS::withTrashed()->where('id', '=', $id)->first();

                if ($pos !== null) {
                    if (!$pos->trashed()) {
                        $pos->delete();
                        $deleted++;
                    } else {
                        $pos->forceDelete();
                        $forceDeleted++;
                    }
                }
            }
            if ($deleted > 0 && $forceDeleted == 0) {
                Session::flash('success', "{$deleted} records has been deleted.");
            } else {
                if ($deleted == 0 && $forceDeleted > 0) {
                    Session::flash('success', "{$forceDeleted} records has been deleted forever.");
                } else {
                    if ($deleted > 0 && $forceDeleted > 0) {
                        Session::flash('success', "{$deleted} records has been deleted and 
                        {$forceDeleted} records has been deleted forever.");
                    }
                }
            }
        } catch (Exception $e) {
            Session::flash('failure', "Something went wrong, please try again.");
            return redirect()->route('backOffice.pos.index');
        }

        return redirect()->route('backOffice.pos.index');
    }
}
