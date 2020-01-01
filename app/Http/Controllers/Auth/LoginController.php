<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Login username to be used by the controller.
     *
     * @var string
     */
    protected $username;

    protected function redirectTo()
    {
        $user = auth()->user();
        if (Auth::user()->isRole($user->user_type_id) == "Super Admin") {
            return '/backoffice';
        } elseif (Auth::user()->isRole($user->user_type_id) == "Admin Store") {
            return '/admin';
        } else {
            return '/';
        }
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }
    public function findUsername()
    {
        $login = request()->input('email');
        $filterType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$filterType => $login]);
        return $filterType;
    }
    public function username()
    {
        return $this->username;
    }
}
