<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function scanner () {
        return view ("pages.scanner");
    }

    public function injecter () {
        return view ("pages.injecter");
    }

    public function attacker () {
        return view ("pages.attacker");
    }
}
