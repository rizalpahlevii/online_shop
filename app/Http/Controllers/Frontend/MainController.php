<?php

namespace App\Http\Controllers\Frontend;

use Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Product_category;
use App\Store;
use App\Store_courier;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Auth;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Debugbar;

class MainController extends Controller
{
    protected $frontend;
    protected $cart;
    protected $user;
    protected $productCategory;
    protected $api;
    public function __construct()
    {
        $this->api = new Api;
        $this->cart = \Cart::class;
        $this->middleware(function ($request, $next) {
            $cartQuantity = \Cart::getTotalQuantity();
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
        // return $products;
        // die;
        // $countProduct = 0;
        // foreach ($products->product as $rowc) {
        //     $countProduct   += 1;
        // }
        $result = [
            'data' => $products,
            // 'count' => $countProduct
        ];
        return response()->json($result);
    }
    public function myOrder()
    {
        return view($this->frontend . 'my_order');
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
}
