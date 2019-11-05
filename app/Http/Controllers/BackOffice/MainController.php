<?php

namespace App\Http\Controllers\BackOffice;

use App\Courier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    protected $path;
    public function __construct()
    {
        $this->path = 'backoffice.pages.';
    }
    public function dashboard()
    {
        return view('backoffice.pages.dashboard');
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
}
