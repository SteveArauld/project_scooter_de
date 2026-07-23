<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Produktdatenfeed für das Google Merchant Center (RSS 2.0 mit g:-Namespace).
 *
 * Enthält ausschließlich die im Shop sichtbaren Produkte – der globale
 * "visible"-Scope des Product-Models beschränkt das automatisch auf
 * E-Roller und E-Scooter.
 *
 * Spezifikation: https://support.google.com/merchants/answer/7052112
 */
class MerchantFeedController extends Controller
{
    public function index(Request $request): Response
    {
        $products = Product::query()
            ->where('price', '>', 0)          // Artikel ohne Preis lehnt Google ab
            ->orderBy('id')
            ->get();

        $xml = trim(view('front.feeds.merchant', compact('products'))->render());

        $headers = [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ];

        /*
         * Standardmäßig wird die Datei zum Download angeboten, damit sie
         * direkt im Merchant Center hochgeladen werden kann. Der geplante
         * Abruf durch Google funktioniert damit ebenfalls.
         * Mit ?inline=1 lässt sich der Feed stattdessen im Browser ansehen.
         */
        if ($request->boolean('inline')) {
            $headers['Content-Disposition'] = 'inline';
        } else {
            $filename = 'merchant-feed-' . now()->format('Y-m-d') . '.xml';
            $headers['Content-Disposition'] = 'attachment; filename="' . $filename . '"';
        }

        return response($xml, 200, $headers);
    }
}
