<?php

namespace SenseBook\Http\Controllers\Auth;

use DateTime;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use SenseBook\Events\BackOffice\Member\UserCreated;
use SenseBook\User;
use SenseBook\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'backOffice/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:dim_users',
            'full_name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'dob' => 'required|date|before:today',
            'phone' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \SenseBook\User
     */
    protected function create(array $data)
    {
        try {
            $member = new User();
            $member->email = $data['email'];
            $member->password = bcrypt($data['password']);
            $member->full_name = $data['full_name'];
            $member->phone = $data['phone'];

            $member->save();

            $datetime = new DateTime($data['dob']);
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

            event(new UserCreated($member, $data['password']));

            Session::flash('success', "Created Success");
        } catch (Exception $e) {
            Session::flash('failure', "Something went wrong, please try again.");
            return redirect()->route('register');
        }

        return $member;
    }
}
