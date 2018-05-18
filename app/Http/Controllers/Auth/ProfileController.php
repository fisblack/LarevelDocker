<?php

namespace SenseBook\Http\Controllers\Auth;

use Baraear\ThaiAddress\Models\SubDistrict;
use DateTime;
use http\Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use SenseBook\Events\BackOffice\Member\UserCreated;
use SenseBook\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SenseBook\Http\Requests\ProfileRequest;
use SenseBook\User;

class ProfileController extends Controller
{
    public $path = 'images/backOffice/members';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $sub_district = SubDistrict::all()->toJson();

        return view('auth.profile')->with(compact('user', 'sub_district'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfileRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {
        $user  = User::query()->find($id);

        if (empty($request->input('old_password')) && !empty($user->email)) {
            Session::flash('failure', "Edit data need to confirm your current password");
        }

        try {
            if (!empty($user->email)) {
                if (Hash::check($request->input('old_password'), $user->password)) {
                    Session::flash('failure', "Your current password incorrect, please try again.");
                    return redirect()->route('profile.index');
                }
                $user->update([
                    'full_name' => $request->input('full_name'),
                    'phone' => $request->input('phone'),
                    'billing_address_id' => $request->input('billing_address_id'),
                    'shipping_address_id' => $request->input('shipping_address_id')
                ]);

                if ($request->has('new_password')) {
                    $user->update([
                        'password' => bcrypt($request->input('new_password'))
                    ]);
                }

                if ($request->hasFile('profile_picture')) {
                    $imageUploaded = uploadImage($request->file('profile_picture'), $this->path);
                    $user->update([
                        'image' => $imageUploaded['full']
                    ]);
                }

                Session::flash('success', "Your information has been updated.");
            } else {
                $user->update([
                    'full_name' => $request->input('full_name'),
                    'phone' => $request->input('phone'),
                    'billing_address_id' => $request->input('billing_address_id'),
                    'shipping_address_id' => $request->input('shipping_address_id')
                ]);

                if ($request->input('email')) {
                    $user->update([
                        'email' => $request->input('email'),
                    ]);
                    $randomPassword = generateRandomString();
                    event(new UserCreated($user, $randomPassword));
                }

                if ($request->input('dob')) {
                    $datetime = new DateTime($request->input('dob'));
                    $dob = $user->dateOfBirth()->create([
                        'date' => $datetime->format('d'),
                        'day' => $datetime->format('l'),
                        'day_of_week' => ((int)$datetime->format('w') + 1),
                        'month' => $datetime->format('m'),
                        'month_name' => $datetime->format('F'),
                        'quarter' => ceil($datetime->format('m') / 3),
                        'quarter_name' => '',
                        'year' => $datetime->format('Y')
                    ]);

                    $user->update(['date_of_birth_id' => $dob->id]);
                }

                if ($request->hasFile('profile_picture')) {
                    $imageUploaded = uploadImage($request->file('profile_picture'), $this->path);
                    $user->update([
                        'image' => $imageUploaded['full']
                    ]);
                }

                Session::flash('success', "Your information has been updated.");
            }
        } catch (Exception $e) {
            Session::flash('failure', "Something went wrong, please try again.");
            return redirect()->route('profile.index');
        }

        return redirect()->route('profile.index');
    }
}
