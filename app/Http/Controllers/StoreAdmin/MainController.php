<?php

namespace App\Http\Controllers\StoreAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Store;
use App\Transaction;
use App\Transaction_detail;
use Auth;
use Illuminate\Support\Facades\Auth as IlluminateAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class MainController extends Controller
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
    public function dashboard()
    {
        $product = Product::where('store_id', $this->store->id)->get();
        $transaction = Transaction::where('store_id', $this->store->id)->get();
        $count = [
            'product' => $product->count(),
            'transaction' => $transaction->count()
        ];
        return view($this->path . 'dashboard', compact('count', 'product'));
    }
    public function getChartPenjualan()
    {
        return response()->json([1000000, 10000000, 7500000, 6000000, 5000000, 4700000, 8900000, 12000000, 3750000, 1230000, 4870000, 1230000]);
    }
    public function getPenjualanProdukTertinggi()
    {
        $products = Product::with('category')->where('store_id', $this->store->id)->get();

        $product_array = [];
        $price_array = [];
        $test_array = [];
        foreach ($products as $key => $product) {
            $product_array[] = $product->name;
            $price_array[] = $product->selling_price;
            $transaction = Transaction_detail::where('product_id', $product->id)->get();
            $value = 0;
            foreach ($transaction as $t_key => $row_t) {
                $value += $row_t->quantity;
            }
            $test_array[] = $value;
        }

        return response()->json([$product_array, $test_array]);
    }
}
