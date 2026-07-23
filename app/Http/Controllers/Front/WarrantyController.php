<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class WarrantyController extends Controller
{
    public function index()
    {
        return view('front.warranty.index');
    }
}
