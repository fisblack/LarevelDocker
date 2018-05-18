<?php

namespace SenseBook\Http\Controllers\BackOffice;

use Carbon\Carbon;
use DateTime;
use http\Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use SenseBook\Events\BackOffice\Member\UserCreated;
use SenseBook\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SenseBook\Http\Requests\BackOffice\MemberRequest;
use SenseBook\Http\Requests\BackOffice\MemberEditRequest;
use SenseBook\User;

class MemberController extends Controller
{
    public $path = 'images/backOffice/members';

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search') && $request->get('search') == '') {
            return redirect()->route('backOffice.member.index');
        } else {
            if (!empty($request->get('search'))) {
                $members = User::withTrashed()->search($request->get('search'))->paginate(15);
            } else {
                $members = User::withTrashed()->paginate(15);
            }
        }

        return view('backOffice.member.index')->with(compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backOffice.member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \SenseBook\Http\Requests\BackOffice\MemberRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemberRequest $request)
    {
        try {
            $randomPassword = generateRandomString();
            $member = new User();
            $member->email = $request->input('email');
            $member->password = bcrypt($randomPassword);
            $member->full_name = $request->input('full_name');
            $member->phone = $request->input('phone');
            $member->type = $request->input('type');

            $imageUploaded = uploadImage($request->file('profile_picture'), $this->path);
            $member->image = $imageUploaded['full'];

            $member->save();

            $datetime = new DateTime($request->input('dob'));
            $dob = $member->dateOfBirth()->create([
                'date' => $datetime->format('d'),
                'day' => $datetime->format('l'),
                'day_of_week' => ((int)$datetime->format('w') + 1),
                'month' => $datetime->format('m'),
                'month_name' => $datetime->format('F'),
                'quarter' => ceil($datetime->format('m') / 3),
                'quarter_name' => '',
                'year' => $datetime->format('Y')
            ]);

            $member->update(['date_of_birth_id' => $dob->id]);

            event(new UserCreated($member, $randomPassword));

            Session::flash('success', "Created Success");
        } catch (Exception $e) {
            Session::flash('failure', "Something went wrong, please try again.");
            return redirect()->route('backOffice.member.index');
        }

        return redirect()->route('backOffice.member.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('backOffice.member.index');
    }

    /**
     * Display the specified resource for printing.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function print(Request $request)
    {
        if ($request->has('selected')) {
            $export = User::withTrashed()->whereIn('id', $request->input('selected'))->get();
        } else {
            $export = User::withTrashed()->get();
        }

        $filename = Carbon::now()->format('Y-m-d H-i-s') . ' - Members';

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$filename}.csv",
            "Pragma" => "no-cache",
            "Expires" => "0"
        );

        return response()->stream(function () use ($export) {
            $handle = fopen("php://output", 'w+');

            fputcsv($handle, array('Full name', 'Email', 'Phone', 'User class', 'Type', 'Balance'));
            foreach ($export as $row) {
                fputcsv($handle, array(
                    $row->full_name,
                    $row->email,
                    $row->phone,
                    ($row->userClass) ? (app()->getLocale() == 'th')
                        ? $row->userClass->name_th : $row->userClass->name_en : '',
                    $row->type,
                    $row->points_balance
                ));
            }
            fclose($handle);
        }, 200, $headers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = User::query()->withTrashed()->find($id);

        return view('backOffice.member.update')->with(compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MemberEditRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(MemberEditRequest $request, $id)
    {
        $member = User::query()->withTrashed()->find($id);

        try {
            if ($member !== null) {
                if (!$member->trashed()) {
                    $member->update([
                        'full_name' => $request->input('full_name'),
                        'phone' => $request->input('phone'),
                        'type' => $request->input('type')
                    ]);

                    $member_dob = "{$member->dateOfBirth->date}/{$member->dateOfBirth->month}" .
                        "-{$member->dateOfBirth->year}";
                    $old_dob = date('Y-m-d', strtotime($member_dob));
                    $new_dob = $request->input('dob');

                    if ($new_dob != $old_dob) {
                        $datetime = new DateTime($request->input('dob'));
                        $member->dateOfBirth()->update([
                            'date' => $datetime->format('d'),
                            'day' => $datetime->format('l'),
                            'day_of_week' => ((int)$datetime->format('w') + 1),
                            'month' => $datetime->format('m'),
                            'month_name' => $datetime->format('F'),
                            'quarter' => ceil($datetime->format('m') / 3),
                            'quarter_name' => '',
                            'year' => $datetime->format('Y')
                        ]);
                    }

                    if ($request->hasFile('profile_picture')) {
                        $imageUploaded = uploadImage($request->file('profile_picture'), $this->path);
                        $member->update([
                            'image' => $imageUploaded['full']
                        ]);
                    }

                    Session::flash('success', "Updated Success");
                } else {
                    Session::flash('failure', "Can't edit data");
                    return redirect()->route('backOffice.member.index');
                }
            } else {
                Session::flash('failure', "Data not found");
                return redirect()->route('backOffice.member.index');
            }
        } catch (Exception $e) {
            Session::flash('failure', "Something went wrong, please try again.");
            return redirect()->route('backOffice.member.index');
        }

        return redirect()->route('backOffice.member.edit', $member->id)->with(compact('member'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $checkLastAdmin = User::query()->withTrashed()->where('type', 'admin')->get();
        if ($checkLastAdmin->count() == 1 && $checkLastAdmin->first()->id == $id) {
            Session::flash('failure', "Can not delete this user. You only have one administrator left in the system");
            return redirect()->route('backOffice.member.index');
        }

        if (Auth::id() == $id) {
            Session::flash('failure', "Can not delete yourself");
            return redirect()->route('backOffice.member.index');
        }

        $member = User::withTrashed()->where('id', '=', $id)->first();

        try {
            if ($member !== null) {
                if (!$member->trashed()) {
                    $member->delete();
                    Session::flash('success', "Deleted Success");
                } else {
                    $member->forceDelete();
                    Session::flash('success', "Force Deleted Success");
                }
            } else {
                Session::flash('failure', "Data not found");
                return redirect()->route('backOffice.member.index');
            }
        } catch (Exception $e) {
            Session::flash('failure', "Something went wrong, please try again.");
            return redirect()->route('backOffice.member.index');
        }

        if (Auth::id() == $id) {
            return redirect()->route('logout');
        }

        return redirect()->route('backOffice.member.index');
    }

    /**
     * Restore the specified resource back to storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $member = User::withTrashed()->where('id', '=', $id)->first();

        try {
            if ($member !== null) {
                if ($member->trashed()) {
                    $member->restore();
                    Session::flash('success', "Restored Success");
                }
            } else {
                Session::flash('failure', "Data not found");
                return redirect()->route('backOffice.member.index');
            }
        } catch (Exception $e) {
            Session::flash('failure', "Something went wrong, please try again.");
            return redirect()->route('backOffice.member.index');
        }

        return redirect()->route('backOffice.member.index');
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
                $member = User::withTrashed()->where('id', '=', $id)->first();

                if ($member !== null) {
                    if (!$member->trashed()) {
                        $member->delete();
                        $deleted++;
                    } else {
                        $member->forceDelete();
                        $forceDeleted++;
                    }
                }
            }
            if ($deleted > 0 && $forceDeleted == 0) {
                Session::flash('success', "{$deleted} members has been deleted.");
            } else {
                if ($deleted == 0 && $forceDeleted > 0) {
                    Session::flash('success', "{$forceDeleted} members has been deleted forever.");
                } else {
                    if ($deleted > 0 && $forceDeleted > 0) {
                        Session::flash('success', "{$deleted} members has been deleted and 
                        {$forceDeleted} members has been deleted forever.");
                    }
                }
            }
        } catch (Exception $e) {
            Session::flash('failure', "Something went wrong, please try again.");
            return redirect()->route('backOffice.member.index');
        }

        return redirect()->route('backOffice.member.index');
    }

    /**
     * Restore the specified resource back to storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function restoreSelected(Request $request)
    {
        try {
            $restored = 0;
            foreach ($request->input('selected') as $id) {
                $member = User::withTrashed()->where('id', '=', $id)->first();

                if ($member !== null) {
                    if ($member->trashed()) {
                        $member->restore();
                        $restored++;
                    }
                }
            }
            Session::flash('success', "{$restored} members has been restored.");
        } catch (Exception $e) {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }

        return redirect()->route('backOffice.member.index');
    }

    /**
     * Get all members
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMembers()
    {
        return response()->json(User::query()->where('type', 'member')->get());
    }
}
