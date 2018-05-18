<?php

namespace SenseBook\Http\Controllers\Auth;

use DateTime;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use SenseBook\Events\BackOffice\Member\UserCreated;
use SenseBook\Http\Controllers\Controller;
use SenseBook\User;

class SocialiteController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'backOffice/dashboard';

    /**
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        switch ($provider) {
            case 'facebook':
                return Socialite::driver('facebook')->redirect();
                break;
            case 'google':
                return Socialite::driver('google')->redirect();
                break;
            case 'twitter':
                return Socialite::driver('twitter')->redirect();
                break;
            default:
                return Socialite::driver($provider)->redirect();
                break;
        }
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        switch ($provider) {
            case 'facebook':
                $user = Socialite::driver('facebook')->user();
                break;
            case 'google':
                $user = Socialite::driver('google')->user();
                break;
            case 'twitter':
                $user = Socialite::driver('twitter')->user();
                break;
            default:
                $user = Socialite::driver($provider)->user();
                break;
        }

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::query()->where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        } elseif (!$authUser && User::query()->where('email', $user->email)->get()->count() > 0) {
            $authUser = User::query()->where('email', $user->email)->first();
            $authUser->update([
                'full_name' => $user->name,
                'provider' => $provider,
                'provider_id' => $user->id
            ]);
            return $authUser;
        } else {
            try {
                $randomPassword = generateRandomString();
                $member = new User();
                if ($user->email) {
                    $member->email = $user->email;
                }
                $member->password = bcrypt($randomPassword);
                $member->full_name = $user->name;
                $member->phone = '0000000000';
                $member->provider = $provider;
                $member->provider_id = $user->id;

                $member->save();

                if ($user->email) {
                    event(new UserCreated($member, $randomPassword));
                }

                Session::flash('success', "Created Success");
            } catch (Exception $e) {
                Session::flash('failure', "Something went wrong, please try again.");
                return redirect()->route('login');
            }
        }

        return $member;
    }
}
