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
        $reports = Transaction::with('invoice', 'transactionAddress', 'transactionDetail.product.category', 'transactionCourier', 'store', 'member', 'courier')->where('store_id', $this->store->id)->get();
        if (Input::get('month')) {
            $reports->whereMonth(Input::get('search'));
        }
        if (Input::get('year')) {
            $reports->whereYear(Input::get('search'));
        }
        return view($this->path . 'report.transaction', compact('reports'));
    }
}
