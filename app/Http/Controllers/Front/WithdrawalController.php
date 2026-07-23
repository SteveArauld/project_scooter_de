<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class WithdrawalController extends Controller
{
    public function index()
    {
        return view('front.legal.withdrawal');
    }
}
