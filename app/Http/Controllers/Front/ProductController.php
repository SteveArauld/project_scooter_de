<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($q = trim((string) $request->get('q'))) {
            $query->where(function ($sub) use ($q) {
                $sub->where('title->de', 'like', "%{$q}%")
                    ->orWhere('reference', 'like', "%{$q}%")
                    ->orWhere('brand', 'like', "%{$q}%");
            });
        }

        if ($cat = $request->get('category')) {
            if (array_key_exists($cat, Product::CATEGORIES)) {
                $query->where('category', $cat);
            }
        }

        if ($sub = $request->get('subcategory')) {
            if (array_key_exists($sub, Product::SUBCATEGORIES)) {
                $query->where('subcategory', $sub);
            }
        }

        if ($brand = $request->get('brand')) {
            $query->where('brand', $brand);
        }

        if ($request->boolean('sale')) {
            $query->where('on_sale', true);
        }

        if ($request->filled('min')) {
            $query->where('price', '>=', (float) $request->get('min'));
        }
        if ($request->filled('max')) {
            $query->where('price', '<=', (float) $request->get('max'));
        }

        switch ($request->get('sort')) {
            case 'price_asc':
                $query->orderBy('price');
                break;
            case 'price_desc':
                $query->orderByDesc('price');
                break;
            case 'name':
                $query->orderBy('title->de');
                break;
            default:
                $query->latest('id');
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Product::CATEGORIES;
        $maxPrice = (int) ceil((float) Product::max('price'));

        $categoryCounts = Product::selectRaw('category, count(*) as n')->groupBy('category')->pluck('n', 'category');

        // Nur Artikelarten anbieten, zu denen es auch tatsächlich Produkte gibt –
        // leere Filteroptionen führen sonst zu einer leeren Ergebnisliste.
        $subcategoryCounts = Product::selectRaw('subcategory, count(*) as n')
            ->groupBy('subcategory')
            ->pluck('n', 'subcategory');

        $subcategories = collect(Product::SUBCATEGORIES)
            ->filter(fn ($label, $slug) => ($subcategoryCounts[$slug] ?? 0) > 0)
            ->all();
        $brands = Product::whereNotNull('brand')
            ->selectRaw('brand, count(*) as n')
            ->groupBy('brand')
            ->orderByDesc('n')
            ->take(20)
            ->pluck('n', 'brand');

        return view('front.products.index', compact(
            'products', 'categories', 'subcategories', 'subcategoryCounts',
            'maxPrice', 'categoryCounts', 'brands'
        ));
    }

    public function quick(string $slug)
    {
        $p = Product::where('slug', $slug)->firstOrFail();

        return response()->json([
            'slug'         => $p->slug,
            'title'        => $p->getTranslation('title', 'de'),
            'category'     => $p->category_label,
            'brand'        => $p->brand,
            'price'        => number_format((float) $p->price, 2, ',', '.') . ' €',
            'price_raw'    => (float) $p->price,
            'availability' => $p->availability,
            'images'       => $p->imageUrls() ?: [$p->main_image],
            'description'  => \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($p->getTranslation('description', 'de')))), 280),
            'url'          => route('products.show', $p->slug),
        ]);
    }

    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $related = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(5)
            ->get();

        return view('front.products.show', compact('product', 'related'));
    }
}
