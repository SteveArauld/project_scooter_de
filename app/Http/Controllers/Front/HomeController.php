<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        // Je Kategorie ein eigener Block mit mindestens 10 Produkten
        $sections = [];
        foreach (Product::CATEGORIES as $slug => $label) {
            $sections[] = [
                'slug'     => $slug,
                'label'    => $label,
                'image'    => "/assets/images/category/{$slug}.jpg",
                'products' => Product::where('category', $slug)->latest('id')->take(10)->get(),
                'total'    => Product::where('category', $slug)->count(),
            ];
        }

        // Tagesangebote: 3 echte Aktionsartikel (Quelle: Kategorie "Sale")
        $deals = Product::onSale()->inRandomOrder()->take(3)->get();
        if ($deals->count() < 3) {
            $deals = $deals->concat(
                Product::whereNotIn('id', $deals->pluck('id'))->inRandomOrder()->take(3 - $deals->count())->get()
            );
        }

        // Enddatum wird EINMAL fixiert (heute + 1 Monat) und bleibt bei jedem
        // Seitenaufruf gleich – der Countdown läuft also durchgängig weiter.
        $dealEnds = Cache::rememberForever(
            'promo_deal_ends',
            fn () => now()->addMonthNoOverflow()->startOfDay()->format('Y/m/d H:i:s')
        );

        return view('front.home', compact('sections', 'deals', 'dealEnds'));
    }
}
