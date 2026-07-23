<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

/**
 * robots.txt wird dynamisch ausgeliefert, damit die Sitemap-Angabe immer
 * eine absolute URL mit dem korrekten Schema (http/https) und der echten
 * Domain enthält – Google verlangt hier eine vollständige URL.
 */
class RobotsController extends Controller
{
    public function index(): Response
    {
        $lines = [
            'User-agent: *',
            'Allow: /',
            '',
            '# Interne Seiten ohne Mehrwert für die Suche',
            'Disallow: /warenkorb',
            'Disallow: /kasse',
            'Disallow: /api/',
            '',
            'Sitemap: ' . route('sitemap'),
            '',
        ];

        return response(implode("\n", $lines), 200, [
            'Content-Type' => 'text/plain; charset=UTF-8',
        ]);
    }
}
