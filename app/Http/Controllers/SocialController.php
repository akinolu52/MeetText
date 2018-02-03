<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;
use Socialite;
use App\User;
use Google_Client;

class SocialController extends Controller
{

    public function welcome()
    {
        if (Auth::user()) {
            return redirect()->route('submit.interest');
        }
        return \view('welcome');
    }

    public function submitPhone(Request $request)
    {
        if ($request->has('phone')){
            session_start();
            $_SESSION['phone'] = $request->phone;
        }

        return redirect()->route('social.login', 'facebook');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try{
            $user = Socialite::driver($provider)->user();
            $authUser = $this->findOrCreateUser($user, $provider);

            Auth::login($authUser, true);
            return redirect()->route('interest');
        }
        catch (\Exception $exception){
            return redirect('/');
        }
    }

    public function findOrCreateUser($user, $provider)
    {
        session_start();
        $authUser = User::where('provider_id', $user->id)->first();

        if ($authUser) {
            return $authUser;
        }
        /*
         * if you login with social media no need for password
         * */

        $name = explode(" ", $user->name);
        return User::create([
            'firstname'     => $name[1] ,
            'lastname'     => $name[0],
            'phone'     => $_SESSION['phone'],
            'email'    => $user->email,
            'avatar' => $user->avatar_original,
            'provider' => $provider,
            'provider_id' => $user->id,
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect()->guest(route('welcome'));
    }
}
