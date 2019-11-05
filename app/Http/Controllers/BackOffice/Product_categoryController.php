<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product_category;

class Product_categoryController extends Controller
{
    protected $backoffice;
    protected $userInfo;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->userInfo = auth()->user();
        $this->backoffice = 'backoffice.pages.';
    }
    public function index()
    {
        $pcategories = Product_category::all();
        return view($this->backoffice . 'pcategory.index', compact('pcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->backoffice . 'pcategory.create');
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
            'name' => 'required|min:5'
        ]);
        $user = new Product_category();
        $user->name = $request->name;
        if ($user->save()) {
            $request->session()->flash('status', '<div class="alert alert-primary mb-2" role="alert">
            <strong>Success!</strong> Success created Product Category!
            </div>');
            return redirect()->route('backoffice.pcategory_index');
        } else {
            $request->session()->flash('status', '<div class="alert alert-danger mb-2" role="alert">
            <strong>Error!</strong> Cannot created Product Category!
            </div>');
            return redirect()->route('backoffice.pcategory_index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pcategory = Product_category::find($id);
        return view($this->backoffice . 'pcategory.edit', compact('pcategory'));
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
            'name' => 'required|min:5'
        ]);
        $pcategory = Product_category::find($id);
        $pcategory->name = $request->name;
        if ($pcategory->save()) {
            $request->session()->flash('status', '<div class="alert alert-primary mb-2" role="alert">
            <strong>Success!</strong> Success update product category!
            </div>');
            return redirect()->route('backoffice.pcategory_index');
        } else {
            $request->session()->flash('status', '<div class="alert alert-danger mb-2" role="alert">
            <strong>Error!</strong> Cannot update product category!
            </div>');
            return redirect()->route('backoffice.pcategory_index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pcategory = Product_category::find($id);
        if ($pcategory->delete()) {
            Session::flash('status', '<div class="alert alert-primary mb-2" role="alert">
            <strong>Success!</strong> Success deleted product category!
            </div>');
            return redirect()->route('backoffice.pcategory_index');
        } else {
            Session::flash('status', '<div class="alert alert-danger mb-2" role="alert">
            <strong>Error!</strong> Cannot delete product category!
            </div>');
            return redirect()->route('backoffice.pcategory_index');
        }
    }
}
