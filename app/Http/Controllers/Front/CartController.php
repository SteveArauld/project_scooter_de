<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        return view('front.cart.index');
    }
}
