<?php

namespace App\Http\Controllers\StoreAdmin;

use App\Courier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Store;
use App\Store_courier;
use App\Store_setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class SettingController extends Controller
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
    public function settingCourier()
    {
        $couriers = Courier::where('status', 'active')->get();
        return view($this->path . 'setting.courier.index', compact('couriers'));
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
}
