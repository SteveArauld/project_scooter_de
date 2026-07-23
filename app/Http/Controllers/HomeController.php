<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class HomeController extends Controller
{
    public function index()
    {

        return view('home');
    }
}
