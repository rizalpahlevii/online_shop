<?php

namespace App\Http\Controllers\StoreAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;
use App\Store;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    protected $path;
    protected $store;
    protected $user;

    function __construct(Request $request)
    {

        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            $this->user = Auth::user();
            $this->store = Store::where('user_id', $user->id)->first();
            view()->share('store', Store::where('user_id', $user->id)->first());
            return $next($request);
        });
        $this->path = 'storeadmin.pages.';
    }

    public function profile()
    {
        return view($this->path . 'user.profile');
    }
    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'birthday' => 'required|date',
            'sex' => 'required',
            'phone' => 'required|min:10',
            'address' => 'required|min:7',
            'postal_code' => 'required',
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->birthday = $request->birthday;
        $user->sex = $request->sex;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->postal_code = $request->postal_code;
        if ($user->save()) {
            $request->session()->flash('status', '<div class="alert alert-primary mb-2" role="alert">
            <strong>Success!</strong> Success Update Profile!
            </div>');
            return redirect()->route('admin.profile_index');
        } else {
            $request->session()->flash('status', '<div class="alert alert-danger mb-2" role="alert">
            <strong>Error!</strong> Cannot Update Profile!
            </div>');
            return redirect()->route('admin.profile_index');
        }
    }
    public function password()
    {
        return view($this->path . 'user.password');
    }
    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => 'required|min:6',
            'password1' => 'required|required_with:password2|same:password2|min:6',
            'password2' => 'required'
        ]);
        $user = User::find(Auth::id());
        if (!Hash::check($request->current_password, $user->password)) {
            $request->session()->flash('status', '<div class="alert alert-danger mb-2" role="alert">
            <strong>Error!</strong> Current password does not match!
            </div>');
        } else {
            $user->password = Hash::make($request->password1);
            if ($user->save()) {
                $request->session()->flash('status', '<div class="alert alert-success mb-2" role="alert">
            <strong>Success!</strong> Success to change password!
            </div>');
            } else {
                $request->session()->flash('status', '<div class="alert alert-danger mb-2" role="alert">
            <strong>Error!</strong> Failed to change password!
            </div>');
            }
        }
        return redirect()->route('admin.profile_password');
    }
}
