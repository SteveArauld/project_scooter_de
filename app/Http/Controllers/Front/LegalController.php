<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class LegalController extends Controller
{
    public function index()
    {
        return view('front.legal.imprint');
    }
}
