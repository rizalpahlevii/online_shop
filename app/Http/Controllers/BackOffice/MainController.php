<?php

namespace App\Http\Controllers\BackOffice;

use App\Courier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product_category;
use App\Store;
use App\Transaction;
use App\User;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class MainController extends Controller
{
    protected $path;
    public function __construct()
    {
        $this->path = 'backoffice.pages.';
    }
    public function dashboard()
    {
        $storeCount = Store::get();
        $memberCount = User::where('user_type_id', 3)->get();

        return view('backoffice.pages.dashboard', compact('storeCount', 'memberCount'));
    }
    public function getCourier()
    {
        $couriers = Courier::all();
        return view($this->path . 'courier.index', compact('couriers'));
    }
    public function postCourierUpdate(Request $request)
    {
        $courier = Courier::find($request->courierId);
        if ($request->status === "active") {
            $courier->status = "inactive";
        } else {
            $courier->status = "active";
        }
        $courier->save();
        return response()->json('success');
    }
    public function getKategoriTertinggi()
    {
        $categories = Product_category::with('product', 'product.transaction_detail')->get();
        $category_name = [];
        $category_value = [];
        foreach ($categories as $key => $row) {
            $category_name[] = $row->name;
            $value = 0;
            foreach ($row->product as $rp_key => $product) {
                foreach ($product->transaction_detail as $p_key => $detail) {
                    $value += $detail->quantity;
                }
            }
            $category_value[] = $value;
        }
        return response()->json([$category_name, $category_value]);
    }
    public function getPenjualanTertinggi()
    {
        $stores = Store::with('transaction', 'transaction.transactionDetail')->get();
        $store_a = [];
        $transaction_total = [];
        $value_total = [];
        foreach ($stores as $key => $store) {
            $store_a[] = $store->name;
            $transaction_total[] = count($store->transaction);
            $value = 0;
            foreach ($store->transaction as $t_key => $transaction) {
                foreach ($transaction->transactionDetail as $d_key => $detail) {
                    $value += $detail->total;
                }
            }
            $value_total[] = $value;
        }
        return response()->json([$store_a, $transaction_total, $value_total]);
    }
}
