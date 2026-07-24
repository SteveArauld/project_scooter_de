<?php

/*
|--------------------------------------------------------------------------
| Shop-Stammdaten
|--------------------------------------------------------------------------
| Zentrale Pflege aller Betreiber-, Kontakt- und Versanddaten.
| Diese Angaben werden für Impressum, Datenschutz, AGB, Widerrufsbelehrung
| und die strukturierten Daten (Google Merchant Center) verwendet.
|
| WICHTIG: Vor dem Livegang müssen diese Platzhalter durch die echten
| Unternehmensdaten ersetzt werden – Google Merchant Center prüft sie.
*/

return [
    'name'      => env('SHOP_NAME', 'Voltscoot'),
    'legal_name'=> env('SHOP_LEGAL_NAME', 'Voltscoot GmbH'),
    'ceo'       => env('SHOP_CEO', 'Max Mustermann'),

    'street'    => env('SHOP_STREET', 'Friedrichstraße 100'),
    'zip'       => env('SHOP_ZIP', '10117'),
    'city'      => env('SHOP_CITY', 'Berlin'),
    'country'   => env('SHOP_COUNTRY', 'Deutschland'),

    'email'     => env('SHOP_EMAIL', 'kontakt@voltscoot.de'),
    'phone'     => env('SHOP_PHONE', '+49 15 236942793'),

    /*
     | WhatsApp-Kontakt für die schwebende Schaltfläche auf allen Seiten.
     | Die wa.me-URL wird aus der Nummer automatisch ohne Leer- und
     | Sonderzeichen gebildet.
     */
    'whatsapp'         => env('SHOP_WHATSAPP', '+49 15 236942793'),
    'whatsapp_message' => env(
        'SHOP_WHATSAPP_MESSAGE',
        'Hallo, ich interessiere mich für Ihre E-Roller und E-Scooter und hätte dazu eine Frage.'
    ),

    // Postfach, das die Bestelleingänge erhält
    'order_email' => env('ORDER_ADMIN_EMAIL', env('SHOP_EMAIL', 'kontakt@voltscoot.de')),

    'register_court' => env('SHOP_REGISTER_COURT', 'Amtsgericht Berlin-Charlottenburg'),
    'register_no'    => env('SHOP_REGISTER_NO', 'HRB 123456 B'),
    'vat_id'         => env('SHOP_VAT_ID', 'DE123456789'),

    // Versand & Rückgabe
    'free_shipping_from' => 100,      // Euro
    'shipping_cost'      => 0.0,      // Standardversand (kostenlos)
    'delivery_days'      => '5–8 Werktage',
    'return_days'        => 14,
    'warranty_months'    => 24,

    // Steuer
    'vat_rate'  => 19,                // Prozent, im Preis enthalten

    'default_description' => 'Elektroroller und E-Scooter mit Straßenzulassung online kaufen. '
        . 'Große Auswahl, kostenloser Versand in ganz Deutschland, 24 Monate Garantie und persönliche Beratung.',

    /*
    |--------------------------------------------------------------------------
    | Google Merchant Center
    |--------------------------------------------------------------------------
    | Zuordnung unserer Kategorien zur offiziellen Google-Produkttaxonomie.
    | Google akzeptiert sowohl die numerische ID als auch den vollen Pfad.
    | Bitte vor dem Livegang im Merchant Center gegenprüfen:
    | https://support.google.com/merchants/answer/6324436
    */
    'google_categories' => [
        'e-roller'  => 'Vehicles & Parts > Vehicles > Motor Vehicles > Motorcycles & Scooters',
        'e-scooter' => 'Sporting Goods > Outdoor Recreation > Kick Scooters',
    ],

    // Versandangaben im Feed (g:shipping)
    'feed_shipping_country' => 'DE',
    'feed_shipping_service' => 'Standardversand',
];
