<?php

namespace App\Http\Controllers\BackOffice;

use Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Store;
use App\User;

class StoreController extends Controller
{
    protected $page;
    protected $api;
    public function __construct()
    {
        $this->api = new Api;
        $this->page = 'backoffice.pages.';
    }
    public function index()
    {
        $stores = Store::with('user')->get();
        return view($this->page . 'store.index', compact('stores'));
    }
    public function create()
    {
        $users = User::whereDoesntHave('store')->get();
        $row = [];
        foreach ($users as $key => $r) {
            if ($r->user_type_id == 2) {
                $row[$key]['id'] = $r->id;
                $row[$key]['name'] = $r->name;
            }
        }
        $users = $row;
        $provinces = $this->api->province();
        $provinces = json_decode($provinces, true);
        return view($this->page . 'store.create', compact('users', 'provinces'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'province' => 'required',
            'city' => 'required',
            'description' => 'required|min:10',
            'address' => 'required|min:10',
            'postal_code' => 'required',
            'user' => 'required'
        ]);
        $store = new Store();
        $store->name = $request->name;
        $store->store_description = $request->description;
        $store->address = $request->address;
        $store->province_code = $request->province;
        $store->province_name = $request->province_name;
        $store->districts_code = $request->city;
        $store->districts_name = $request->city_name;
        $store->user_id = $request->user;
        $store->postal_code = $request->postal_code;
        if ($store->save()) {
            $request->session()->flash('status', '<div class="alert alert-primary mb-2" role="alert">
            <strong>Success!</strong> Success Create Store!
            </div>');
        } else {
            $request->session()->flash('status', '<div class="alert alert-danger mb-2" role="alert">
            <strong>Error!</strong> Cannot Create Store!
            </div>');
        }
        return redirect()->route('backoffice.store');
    }
    public function edit($id)
    {
        $users = User::whereDoesntHave('store')->get();
        $row = [];
        $i = 0;
        foreach ($users as $key => $r) {
            if ($r->user_type_id == 2) {
                $row[$i]['id'] = $r->id;
                $row[$i]['name'] = $r->name;
                $i++;
            }
        }
        $store = Store::with('user')->where('id', $id)->first();
        $us = User::find($store->user_id);
        $row[$i]['id'] = $us->id;
        $row[$i]['name'] = $us->name;
        $users = $row;

        $provinces = $this->api->province();
        $provinces = json_decode($provinces, true);
        $cities = $this->api->city($store->province_code);
        $cities = json_decode($cities, true);
        return view($this->page . 'store.edit', compact('store', 'provinces', 'users', 'cities'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'province' => 'required',
            'city' => 'required',
            'description' => 'required|min:10',
            'address' => 'required|min:10',
            'postal_code' => 'required',
            'user' => 'required'
        ]);
        $store = Store::find($request->store_id);
        $store->name = $request->name;
        $store->store_description = $request->description;
        $store->address = $request->address;
        $store->province_code = $request->province;
        $store->province_name = $request->province_name;
        $store->districts_code = $request->city;
        $store->districts_name = $request->city_name;
        $store->user_id = $request->user;
        $store->postal_code = $request->postal_code;
        if ($store->save()) {
            $request->session()->flash('status', '<div class="alert alert-primary mb-2" role="alert">
            <strong>Success!</strong> Success Update Store!
            </div>');
        } else {
            $request->session()->flash('status', '<div class="alert alert-danger mb-2" role="alert">
            <strong>Error!</strong> Cannot Update Store!
            </div>');
        }
        return redirect()->route('backoffice.store');
    }
}
