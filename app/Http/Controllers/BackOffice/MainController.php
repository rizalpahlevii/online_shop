<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function dashboard()
    {
        return view('backoffice.pages.dashboard');
    }
}
