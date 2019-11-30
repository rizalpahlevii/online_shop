<?php

namespace App\Http\Controllers\Frontend;

use Api;
use App\Courier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Product_category;
use App\Store;
use App\Store_courier;
use App\Transaction;
use App\Transaction_address;
use App\Transaction_courier;
use App\Transaction_detail;
use App\User;
use App\User_bank;
use Carbon\Carbon;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Auth;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Debugbar;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    protected $frontend;
    protected $cart;
    protected $user;
    protected $productCategory;
    protected $api;
    protected $cartQuantity;
    public function __construct()
    {
        $this->api = new Api;
        $this->cart = \Cart::class;
        $this->middleware(function ($request, $next) {
            $cartQuantity = 0;
            foreach (\Cart::getContent() as $item) {
                $cartQuantity += 1;
            }
            $this->cartQuantity = $cartQuantity;
            $this->productCategory = Product_category::all();
            view()->share('cartQuantity', $cartQuantity);
            view()->share('productCategory', $this->productCategory);
            return $next($request);
        });
        $this->frontend = 'frontend.pages.';
    }
    public function index()
    {
        $products = Product::with('category')->where('stock', '>', '0')->get();
        return view($this->frontend . 'landing', compact('products'));
    }
    public function viewCategoryProduct($slug)
    {
        $products = Product_category::with('product')->where('slug', '=', $slug)->first();
        $countProduct = 0;
        foreach ($products->product as $rowc) {
            $countProduct += 1;
        }
        return view($this->frontend . 'product_categories', compact('products', 'countProduct'));
    }
    public function detail($slug)
    {
        $product = Product::with('category')->where('slug', '=', $slug)->first();
        $store = Store::with('payment')->where('id', '=', $product->store_id)->first();
        return view($this->frontend . 'product_detail', compact('product', 'store'));
    }
    public function addToCart(Request $request)
    {
        if (!$this->_getInfoProduct($request->product_id)) {
            return response()->json('error');
        } else {
            $product = Product::findOrfail($request->product_id);
            $this->cart::add([
                'id' => $request->product_id,
                'name' => $product->name,
                'price' => $product->selling_price,
                'quantity' => $request->qty
            ]);
            return response()->json('success');
        }
    }
    protected function _getInfoProduct($product_id)
    {
        $array_cart = [];
        foreach ($this->cart::getContent() as $rowCart) {
            $array_cart[] = $rowCart->id;
        }
        $product = Product::whereIn('id', $array_cart)->get();
        $product_parameter = Product::find($product_id);
        if ($product->count() == 0) {
            $status = true;
        } else {
            $array_store = [];
            foreach ($product as $key => $row) {
                $array_store[] = $row->store_id;
            }
            if (in_array($product_parameter->store_id, $array_store)) {
                $status = true;
            } else {
                $status = false;
            }
        }
        return $status;
    }
    public function searchMinMax(Request $request)
    {
        $products = Product_category::where('slug', '=', $request->slug);
        $products->whereHas('product', function ($qw) use ($request) {
            $qw->whereBetween('selling_price',  [$request->min, $request->max]);
        })->first();
        $result = [
            'data' => $products,
            // 'count' => $countProduct
        ];
        return response()->json($result);
    }
    public function myOrder()
    {
        if ($this->cartQuantity == 0) {
            return redirect()->back();
        } else {
            return view($this->frontend . 'my_order');
        }
    }
    public function cekAuth()
    {
        if (Auth::check()) {
            $status = "login";
        } else {
            $status = "no";
        }
        return response()->json($status);
    }
    public function purchase()
    {
        $province = $this->api->province();
        $province = json_decode($province);
        $province = $province->rajaongkir->results;
        return view($this->frontend . 'purchase', compact('province'));
    }
    public function getCourier()
    {
        $store_id = [];
        foreach (\Cart::getContent() as $row) {
            $product = Product::find($row->id);
            $store_id[] = $product->store_id;
        }
        $store = Store::find($store_id[0]);
        $store_courier  = Store_courier::with('courier')->where('store_id', '=', $store->id)->where('status', '=', 'active')->get()->toArray();
        $response = [
            'status' => 200,
            'results' => $store_courier
        ];
        return response()->json($response);
    }
    public function cekOngkir(Request $request)
    {
        $store_id = [];
        $weight = 0;
        foreach (\Cart::getContent() as $row) {
            $product = Product::find($row->id);
            $store_id[] = $product->store_id;
            $weight += $product->weight * $row->quantity;
        }
        $store = Store::find($store_id[0]);
        $params = [
            'origin' => $store->districts_code,
            'destination' => $request->kabupaten_code,
            'weight' => $weight,
            'courier' => $request->courier
        ];
        $ongkir = $this->api->cost($params);
        return $ongkir;
    }
    public function getCityByProvinceId(Request $request)
    {
        $response = $this->api->city($request->province_id);
        return $response;
    }
    public function deleteCart(Request $request)
    {
        $remove = \Cart::remove($request->id);
        $cartQuantity = 0;
        foreach (\Cart::getContent() as $row) {
            $cartQuantity += 1;
        }
        if ($remove) {
            $data = [
                'sts' => 'true',
                'quantity' => $cartQuantity
            ];
        } else {
            $data = [
                'sts' => 'false',
                'quantity' => $cartQuantity
            ];
        }
        return response()->json($data);
    }
    public function postCheckout(Request $request)
    {
        $address = json_decode($request->address, true);
        $courier = json_decode($request->courier, true);
        $store_id = [];
        $subItem = 0;
        foreach (\Cart::getContent() as $row) {
            $product = Product::find($row->id);
            $store_id[] = $product->store_id;
            $subItem += $product->selling_price * $row->quantity;
        }
        $total_amount = $subItem + $courier['value'];
        DB::beginTransaction();
        $DbCourier = Courier::where('code', $address['courier_code'])->first();
        try {
            $transaction = Transaction::create([
                'transaction_number' => 'INV' . date('YmdHis'),
                'store_id' => $store_id[0],
                'member_id' => $address['member_id'],
                'courier_id' => $DbCourier->id,
                'date' => Carbon::now(),
                'transaction_status' => 'proccess',
                'total_amount' => $total_amount,
            ]);


            $transaction_address = new Transaction_address();
            $transaction_address->transaction_id = $transaction->id;
            $transaction_address->province_code = $address['provinceCode'];
            $transaction_address->province_name = $address['provinceName'];
            $transaction_address->city_code = $address['kabupatenCode'];
            $transaction_address->city_name = $address['kabupatenName'];
            if ($address['detail']) {
                $transaction_address->detail = $address['detail'];
            }
            $transaction_address->save();

            $transaction_detail = new Transaction_detail();
            foreach (\Cart::getContent() as $rdt) {
                $product = Product::find($row->id);
                $transaction_detail->transaction_id = $transaction->id;
                $transaction_detail->product_id = $rdt->id;
                $transaction_detail->price = $product->selling_price;
                $transaction_detail->quantity = $rdt->quantity;
                $transaction_detail->total = $rdt->quantity * $product->selling_price;
                $transaction_detail->save();
            }

            $transaction_courier = new Transaction_courier();
            $transaction_courier->transaction_id = $transaction->id;
            $transaction_courier->courier = $courier['courier_name'];
            $transaction_courier->service = $courier['service'];
            $transaction_courier->description = $courier['description'];
            $transaction_courier->etd = $courier['etd'];
            $transaction_courier->value = $courier['value'];
            $transaction_courier->save();
            DB::commit();
            \Cart::clear();
            $status = 'success';
        } catch (\Exception $e) {
            DB::rollBack();
            $status = 'error';
        }
        return response()->json($status);
    }
    public function profile()
    {
        $user = User::with('userBank')->where('id', Auth::id())->first();
        return view($this->frontend . 'myprofile', compact('user'));
    }
    public function profileEdit()
    {
        $userBank = User::with('userBank')->where('id', Auth::user()->id)->first();
        return view($this->frontend . 'edit-profile', compact('userBank'));
    }
    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'phone' => 'required|numeric',
            'postal_code' => 'required',
            'address' => 'required|min:10',
            'bank_name' => 'required',
            'account_name' => 'required',
            'account_number' => 'required|numeric'
        ]);


        DB::beginTransaction();
        try {
            $user = User::find(Auth::user()->id);
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->postal_code = $request->postal_code;
            $user->address = $request->address;
            $user->save();

            $cek = User_bank::where('user_id', $user->id)->first();
            if ($cek) {
                $userBank = User_bank::find($cek->id);
                $userBank->name = $request->bank_name;
                $userBank->account_name = $request->account_name;
                $userBank->account_number = $request->bank_account_number;
                $userBank->save();
            } else {
                $userBank = new User_bank();
                $userBank->user_id  = $user->id;
                $userBank->name = $request->bank_name;
                $userBank->account_name = $request->account_name;
                $userBank->account_number = $request->account_number;
                $userBank->save();
            }
            DB::commit();
            $warna = 'primary';
            $message = 'Profil berhasil diubah!';
        } catch (\Throwable $th) {
            DB::rollBack();
            $warna = 'danger';
            $message = 'Profil gagal diubah!';
        }
        return redirect()->route('fe.myprofile')->with('message', '<div class="alert alert-' . $warna . '">
       ' . $message . '
      </div>');
    }
}
