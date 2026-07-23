<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [];

        // Statische Seiten
        $static = [
            ['home', '1.0', 'daily'],
            ['products.index', '0.9', 'daily'],
            ['about', '0.5', 'monthly'],
            ['contact', '0.5', 'monthly'],
            ['faq', '0.5', 'monthly'],
            ['stores', '0.4', 'monthly'],
            ['career', '0.3', 'monthly'],
            ['shipping', '0.4', 'monthly'],
            ['payment', '0.4', 'monthly'],
            ['warranty', '0.4', 'monthly'],
            ['withdrawal', '0.3', 'yearly'],
            ['terms', '0.3', 'yearly'],
            ['privacy', '0.3', 'yearly'],
            ['imprint', '0.3', 'yearly'],
            ['cookies', '0.2', 'yearly'],
        ];
        foreach ($static as [$name, $priority, $freq]) {
            $urls[] = ['loc' => route($name), 'priority' => $priority, 'changefreq' => $freq];
        }

        // Kategorien
        foreach (array_keys(Product::CATEGORIES) as $slug) {
            $urls[] = ['loc' => route('categories.index', $slug), 'priority' => '0.8', 'changefreq' => 'weekly'];
        }

        // Produkte (nur sichtbare – der globale Scope greift automatisch)
        foreach (Product::select('slug', 'updated_at')->get() as $product) {
            $urls[] = [
                'loc'        => route('products.show', $product->slug),
                'priority'   => '0.7',
                'changefreq' => 'weekly',
                'lastmod'    => optional($product->updated_at)->toAtomString(),
            ];
        }

        return response()
            ->view('front.sitemap', compact('urls'))
            ->header('Content-Type', 'application/xml');
    }
}
