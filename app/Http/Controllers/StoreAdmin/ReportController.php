<?php

namespace App\Http\Controllers\StoreAdmin;

use Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\Product;
use App\Store;
use App\Store_courier;
use App\Store_payment;
use App\Store_setting;
use App\Transaction;
use App\Transaction_address;
use App\Transaction_courier;
use App\Transaction_detail;
use App\User;
use App\User_bank;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ReportController extends Controller
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
    public function transaction()
    {
        $years = Transaction::select(DB::raw('YEAR(date) as year'))->where('store_id', $this->store->id)->distinct()->get();
        $reports = Transaction::with('invoice', 'transactionAddress', 'transactionDetail.product.category', 'transactionCourier', 'store', 'member', 'courier')->where('store_id', $this->store->id);
        if (Input::get('month')) {
            $reports->whereMonth('date', Input::get('month'));
        }
        if (Input::get('year')) {
            $reports->whereYear('date', Input::get('year'));
        }
        $reports = $reports->get();
        return view($this->path . 'report.transaction', compact('reports', 'years'));
    }
    public function shipment()
    {
        $reports = Transaction::with('transactionAddress', 'transactionCourier', 'member')->where('store_id', $this->store->id)->get();
        return view($this->path . 'report.shipment', compact('reports'));
    }
}
