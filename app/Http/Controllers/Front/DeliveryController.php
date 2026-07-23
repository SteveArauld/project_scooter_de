<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class DeliveryController extends Controller
{
    public function index()
    {
        return view('front.delivery.index');
    }
}
