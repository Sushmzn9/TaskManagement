<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    function __construct()
    {
        $this->middleware("auth");
    }
    public function dashboardIndex()
    {
        return view('dashboard');
    }
}
