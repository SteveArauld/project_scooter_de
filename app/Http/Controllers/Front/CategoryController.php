<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request, string $slug)
    {
        abort_unless(array_key_exists($slug, Product::CATEGORIES), 404);

        $request->merge(['category' => $slug]);

        return app(ProductController::class)->index($request);
    }
}
