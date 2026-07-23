<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class PrivacyController extends Controller
{
    public function index()
    {
        return view('front.legal.privacy');
    }
}
