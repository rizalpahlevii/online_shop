<?php

namespace App\Http\Controllers\StoreAdmin;

use Api;
use App\Courier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Store;
use App\Store_courier;
use App\Store_payment;
use App\Store_setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class SettingController extends Controller
{
    protected $path;
    protected $store;
    protected $user;
    protected $api;
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
        $this->api = new Api;
    }
    public function settingCourier()
    {
        $couriers = Courier::where('status', 'active')->get();
        return view($this->path . 'setting.courier.index', compact('couriers'));
    }
    public function settingPayment()
    {
        $payment = Store_payment::where('store_id', '=', $this->store->id)->first();
        return view($this->path . 'setting.payment.index', compact('payment'));
    }
    public function settingPaymentAdd()
    {
        $payment = Store_payment::where('store_id', '=', $this->store->id)->first();
        if ($payment) {
            return redirect()->route('admin.setting_payment');
        }
        return view($this->path . 'setting.payment.create');
    }
    public function settingPaymentStore(Request $request)
    {
        $payment = Store_payment::where('store_id', '=', $this->store->id)->first();
        if ($payment) {
            return redirect()->route('admin.setting_payment');
        }
        $payment = new Store_payment;
        $payment->bank_name = $request->bank_name;
        $payment->account_name = $request->account_name;
        $payment->account_number = $request->account_number;
        $payment->swift_code = $request->swift_code;
        $payment->store_id = $this->store->id;
        if ($request->detail) {
            $payment->detail = $request->detail;
        }
        if ($payment->save()) {
            $request->session()->flash('status', '<div class="alert alert-primary mb-2" role="alert">
            <strong>Success!</strong> Success created payment!
            </div>');
        } else {
            $request->session()->flash('status', '<div class="alert alert-danger mb-2" role="alert">
            <strong>Error!</strong> Cannot created payment!
            </div>');
        }
        return redirect()->route('admin.setting_payment');
    }
    public function settingPaymentEdit()
    {
        $payment = Store_payment::where('store_id', '=', $this->store->id)->first();
        return view($this->path . 'setting.payment.edit', compact('payment'));
    }
    public function settingPaymentUpdate(Request $request)
    {
        $paymentData = Store_payment::where('store_id', '=', $this->store->id)->first();

        $payment = Store_payment::find($paymentData->id);
        $payment->bank_name = $request->bank_name;
        $payment->account_name = $request->account_name;
        $payment->account_number = $request->account_number;
        $payment->swift_code = $request->swift_code;
        if ($request->detail) {
            $payment->detail = $request->detail;
        }
        if ($payment->save()) {
            $request->session()->flash('status', '<div class="alert alert-primary mb-2" role="alert">
            <strong>Success!</strong> Success created payment!
            </div>');
        } else {
            $request->session()->flash('status', '<div class="alert alert-danger mb-2" role="alert">
            <strong>Error!</strong> Cannot created payment!
            </div>');
        }
        return redirect()->route('admin.setting_payment');
    }
    public function settingPaymentDelete()
    {
        $paymentData = Store_payment::where('store_id', '=', $this->store->id)->first();
        $payment = Store_payment::find($paymentData->id);
        if ($paymentData->delete()) {
            Session::flash('status', '<div class="alert alert-primary mb-2" role="alert">
            <strong>Success!</strong> Success deleted payment!
            </div>');
        } else {
            Session::flash('status', '<div class="alert alert-danger mb-2" role="alert">
            <strong>Success!</strong> cannot delete payment!
            </div>');
        }
        return redirect()->route('admin.setting_payment');
    }
    public function postCourierUpdate(Request $request)
    {
        $storeCourier = Store_courier::where('store_id', $request->storeId)->where('courier_id', $request->courierId)->first();
        if (!empty($storeCourier)) {
            $delete = Store_courier::find($storeCourier->id);
            $delete->delete();
        } else {
            Store_courier::create([
                'courier_id' => $request->courierId,
                'store_id' => $request->storeId
            ]);
        }
        return response()->json('success');
    }
    public function settingStore()
    {
        $courier_active = Store_courier::with('store', 'courier')->where('store_id', $this->store->id)->get();
        $value = '';
        $i = 0;
        foreach ($courier_active as $key => $row) {
            $i++;
            $value .= $row->courier->title;
            $value .= ',';
        }
        $province = json_decode($this->api->province());
        return view($this->path . 'setting.store.index', compact('province', 'value'));
    }
    public function settingStoreEdit()
    {
        $province = json_decode($this->api->province());
        if ($this->store->province_code != null) {
            $cities = $this->api->city($this->store->province_code);
            view()->share('cities', json_decode($cities));
        }
        return view($this->path . 'setting.store.edit', compact('province'));
    }
    public function settingStoreUpdate(Request $request)
    {
        $request->validate([
            'store_name' => 'required',
            'address' => 'required|min:5',
            'description' => 'required|min:10',
            'province_name' => 'required',
            'province' => 'required',
            'city_name' => 'required',
            'city' => 'required',
        ]);
        $postal_code = $this->api->postalCode($request->city);
        $postal_code = json_decode($postal_code);
        $postal_code = $postal_code->rajaongkir->results->postal_code;

        $storeUpdate = Store::find($this->store->id);
        $storeUpdate->name = $request->store_name;
        $storeUpdate->address = $request->address;
        $storeUpdate->store_description = $request->description;
        $storeUpdate->postal_code = $postal_code;
        $storeUpdate->province_name = $request->province_name;
        $storeUpdate->province_code = $request->province;
        $storeUpdate->districts_name = $request->city_name;
        $storeUpdate->districts_code = $request->city;
        if ($storeUpdate->save()) {
            $request->session()->flash('status', '<div class="alert alert-success mb-2" role="alert">
            <strong>Success!</strong> Update Success!
            </div>');
        } else {
            $request->session()->flash('status', '<div class="alert alert-danger mb-2" role="alert">
            <strong>Error!</strong> Failed to Update!
            </div>');
        }
        return redirect()->route('admin.setting_store');
    }
}
