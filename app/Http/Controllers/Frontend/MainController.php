<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    protected $frontend;
    public function __construct()
    {
        $this->frontend = 'frontend.pages.';
    }
    public function index()
    {
        return view($this->frontend . 'landing');
    }
}
