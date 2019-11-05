<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\User_type;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    protected $backoffice;
    protected $userInfo;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->userInfo = auth()->user();
        $this->backoffice = 'backoffice.pages.';
    }
    public function index()
    {
        $users = User::with('user_type')->get();
        return view($this->backoffice . 'user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = User_type::all();
        return view($this->backoffice . 'user.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_user' => 'required|min:5',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'role' => 'required',
            'password1' => 'required|min:6',
            'password2' => 'required|required_with:password1|same:password1|min:6'
        ]);
        $user = new User;
        $user->name = $request->name_user;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->user_type_id = $request->role;
        $user->password = $request->password1;
        $user->register_datetime = Carbon::now();
        if ($user->save()) {
            $request->session()->flash('status', '<div class="alert alert-primary mb-2" role="alert">
            <strong>Success!</strong> Success created user!
            </div>');
            return redirect()->route('backoffice.user_index');
        } else {
            $request->session()->flash('status', '<div class="alert alert-danger mb-2" role="alert">
            <strong>Error!</strong> Cannot created user!
            </div>');
            return redirect()->route('backoffice.user_index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $role = User_type::all();
        return view($this->backoffice . 'user.edit', compact('user', 'role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_user' => 'required|min:5',
            'username' => 'required',
            'role' => 'required',
        ]);
        $user = User::find($id);
        $user->name = $request->name_user;
        $user->username = $request->username;
        $user->user_type_id = $request->role;
        if ($user->save()) {
            $request->session()->flash('status', '<div class="alert alert-primary mb-2" role="alert">
            <strong>Success!</strong> Success update user!
            </div>');
            return redirect()->route('backoffice.user_index');
        } else {
            $request->session()->flash('status', '<div class="alert alert-danger mb-2" role="alert">
            <strong>Error!</strong> Cannot update user!
            </div>');
            return redirect()->route('backoffice.user_index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user->delete()) {
            Session::flash('status', '<div class="alert alert-primary mb-2" role="alert">
            <strong>Success!</strong> Success deleted user!
            </div>');
            return redirect()->route('backoffice.user_index');
        } else {
            Session::flash('status', '<div class="alert alert-danger mb-2" role="alert">
            <strong>Error!</strong> Cannot delete user!
            </div>');
            return redirect()->route('backoffice.user_index');
        }
    }
}
