<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class StoresController extends Controller
{
    public function index()
    {
        /*
         | TODO(Filialen) – NICHT VERIFIZIERT: Diese vier Standorte samt Adressen
         | und Rufnummern stammen aus dem Template und sind erfunden (die Nummern
         | 1234567 / 7654321 / 2223344 / 556677 sind erkennbare Platzhalter, die
         | Berliner Adresse ist dieselbe wie die frühere Platzhalter-Anschrift im
         | Impressum). Vorgetäuschte Ladengeschäfte sind ein Ablehnungsgrund im
         | Merchant Center. Bitte durch die echten Standorte ersetzen – oder,
         | falls es keine Filialen gibt, diese Seite samt Route und Footer-Link
         | entfernen.
         */
        $stores = [
            ['city' => 'Berlin',  'address' => 'Friedrichstraße 100, 10117 Berlin', 'phone' => '+49 30 1234567', 'hours' => 'Mo–Fr 9–18 Uhr, Sa 10–16 Uhr'],
            ['city' => 'München', 'address' => 'Leopoldstraße 25, 80802 München',    'phone' => '+49 89 7654321', 'hours' => 'Mo–Fr 9–18 Uhr, Sa 10–16 Uhr'],
            ['city' => 'Hamburg', 'address' => 'Mönckebergstraße 7, 20095 Hamburg',  'phone' => '+49 40 2223344', 'hours' => 'Mo–Fr 9–18 Uhr, Sa 10–16 Uhr'],
            ['city' => 'Köln',    'address' => 'Schildergasse 50, 50667 Köln',        'phone' => '+49 221 556677', 'hours' => 'Mo–Fr 9–18 Uhr, Sa 10–16 Uhr'],
        ];

        return view('front.stores.index', compact('stores'));
    }
}
