<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index()
    {
        $stats = [
            ['number' => '10+',     'label' => 'Jahre Erfahrung'],
            ['number' => '15.000+', 'label' => 'Zufriedene Kunden'],
            ['number' => '60+',     'label' => 'Modelle verfügbar'],
            ['number' => '24/7',    'label' => 'Kundensupport'],
        ];

        $values = [
            ['icon' => 'bi-shield-check', 'title' => 'Geprüfte Qualität',   'description' => 'Alle Fahrzeuge werden vor dem Versand sorgfältig geprüft und sind straßenzugelassen.'],
            ['icon' => 'bi-truck',        'title' => 'Schnelle Lieferung',  'description' => 'Kostenloser Versand in ganz Deutschland innerhalb von 5–8 Werktagen.'],
            ['icon' => 'bi-headset',      'title' => 'Persönlicher Support','description' => 'Unser Team steht Ihnen bei allen Fragen rund um Ihr Fahrzeug zur Seite.'],
            ['icon' => 'bi-award',        'title' => '2 Jahre Garantie',    'description' => 'Auf alle Elektroroller gewähren wir eine umfassende Herstellergarantie.'],
        ];

        $timeline = [
            ['year' => '2015', 'title' => 'Gründung',            'description' => 'Start als kleiner Fachhändler für Elektromobilität.'],
            ['year' => '2018', 'title' => 'Online-Shop',         'description' => 'Launch unseres Online-Shops für ganz Deutschland.'],
            ['year' => '2021', 'title' => 'Wachsendes Sortiment','description' => 'Erweiterung auf über 60 Modelle namhafter Marken.'],
            ['year' => '2024', 'title' => 'Marktführer',         'description' => 'Tausende zufriedene Kunden vertrauen jährlich auf uns.'],
        ];

        return view('front.about.index', compact('stats', 'values', 'timeline'));
    }
}
