<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SocialAccount;
use App\User;
use Exception;
use Laravel\Socialite\Facades\Socialite;

class SocialiteControlller extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function handleProviderCalback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect('/login');
        }
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect('/');
    }
    public function findOrCreateUser($socialUser, $provider)
    {
        $SocialAccount = SocialAccount::where('provider_id', $socialUser->getId())->where('provider_name', $provider)->first();
        if ($SocialAccount) {
            return $SocialAccount->user;
        } else {
            $user = User::where('email', $socialUser->getEmail())->first();
            if (!$user) {
                $user = User::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail()
                ]);
                $user->socialAccounts()->create([
                    'provider_id' => $socialUser->getId(),
                    'provider_name' => $provider
                ]);
                return $user;
            }
        }
    }
}
