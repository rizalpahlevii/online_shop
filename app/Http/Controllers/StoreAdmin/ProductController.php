<?php

namespace App\Http\Controllers\StoreAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Product_category;
use App\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Image;
use League\Flysystem\File;
use PhpParser\Node\Expr\New_;

class ProductController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store = $this->store;
        $products = Product::with('category')->where('store_id', $store->id)->get();
        return view($this->path . 'product.index', compact('products'));
    }

    public function _getStore()
    {
        $user = Auth::user();
        $store = Store::where('user_id', $user->id)->first();
        return $store;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pcategories = Product_category::all();
        return view($this->path . 'product.create', compact('pcategories'));
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
            'name_product' => 'required|min:3',
            'code' => 'required|min:2',
            'purchase_price' => 'required|integer',
            'selling_price' => 'required|integer',
            'weight' => 'required|integer',
            'stock' => 'required|integer',
            'description' => 'required|min:10',
            'pcategory' => 'required',
            'image' => 'required|max:10000|file|image|mimes:jpeg,png,gif',
        ]);
        $image = $request->file('image');
        $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
        $imageName = $image->getClientOriginalName();
        $extensionFile = $image->getClientOriginalExtension();
        $realpath = $image->getRealPath();
        $size = $image->getSize();
        $mimeType = $image->getMimeType();
        $destinationFolder = public_path('/images/products');
        $img = Image::make($image->getRealPath());
        $img->resize(480, 480, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationFolder . '/' . $input['imagename']);
        $destinationFolder = public_path('/images/products');
        $image->move($destinationFolder, $input['imagename']);


        $product = new Product;
        $product->name = $request->name_product;
        $product->purchase_price = $request->purchase_price;
        $product->code = $request->code;
        $product->selling_price = $request->selling_price;
        $product->weight = $request->weight;
        $product->stock = $request->stock;
        $product->description = $request->description;
        $product->product_category_id = $request->pcategory;
        $product->image = $input['imagename'];
        if ($request->customer1) {
            $product->show_web = 'yes';
        } else {
            $product->show_web = 'no';
        }
        $product->store_id = $this->store->id;
        $product->created_by = $this->user->name;
        if ($product->save()) {
            $request->session()->flash('status', '<div class="alert alert-primary mb-2" role="alert">
            <strong>Success!</strong> Success created product!
            </div>');
        } else {
            $request->session()->flash('status', '<div class="alert alert-danger mb-2" role="alert">
            <strong>Error!</strong> Cannot created product!
            </div>');
        }
        return redirect()->route('admin.product_index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('category')->where('id', '=', $id)->first();
        return view($this->path . 'product.edit', compact('product'));
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
            'name_product' => 'required|min:3',
            'code' => 'required|min:2',
            'purchase_price' => 'required|integer',
            'selling_price' => 'required|integer',
            'weight' => 'required|integer',
            'stock' => 'required|integer',
            'description' => 'required|min:10',
        ]);
        $product = Product::find($id);
        $oldImage = $product->image;
        if ($request->image) {
            $image = $request->file('image');
            $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
            $imageName = $image->getClientOriginalName();
            $extensionFile = $image->getClientOriginalExtension();
            $realpath = $image->getRealPath();
            $size = $image->getSize();
            $mimeType = $image->getMimeType();
            $destinationFolder = public_path('/images/products');
            $img = Image::make($image->getRealPath());
            $img->resize(480, 480, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationFolder . '/' . $input['imagename']);
            $destinationFolder = public_path('/images/products');
            $image->move($destinationFolder, $input['imagename']);
            if (file_exists(public_path('images/products/' . $oldImage))) {
                \File::delete('images/products/' . $oldImage);
            }
            $product->image = $input['imagename'];
        }
        $product->name = $request->name_product;
        $product->purchase_price = $request->purchase_price;
        $product->code = $request->code;
        $product->selling_price = $request->selling_price;
        $product->weight = $request->weight;
        $product->stock = $request->stock;
        $product->description = $request->description;
        if ($product->save()) {
            $request->session()->flash('status', '<div class="alert alert-primary mb-2" role="alert">
            <strong>Success!</strong> Success updated product!
            </div>');
        } else {
            $request->session()->flash('status', '<div class="alert alert-danger mb-2" role="alert">
            <strong>Error!</strong> Cannot updated product!
            </div>');
        }
        return redirect()->route('admin.product_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Product::find($request->id);
        if ($product->delete()) {
            $status = "success";
        } else {
            $status = "error";
        }
        return response()->json($status);
    }
    public function increaseStock($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }
    public function postIncreaseStock(Request $request)
    {
        $productId = $request->id;
        $stock = $request->stock;
        $product = Product::find($productId);
        $product->stock += $stock;
        if ($product->save()) {
            return response()->json('success');
        } else {
            return response()->json('error');
        }
    }

    public function decreaseStock($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }
    public function postDecreaseStock(Request $request)
    {
        $productId = $request->id;
        $stock = $request->stock;
        $product = Product::find($productId);
        $product->stock = $product->stock - $stock;

        if ($product->save()) {
            return response()->json('success');
        } else {
            return response()->json('error');
        }
    }
}
