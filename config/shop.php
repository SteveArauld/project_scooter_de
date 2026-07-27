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

    /*
    |--------------------------------------------------------------------------
    | Zahlungsarten
    |--------------------------------------------------------------------------
    | Einzige Quelle der Wahrheit für alle Stellen, an denen Zahlungsarten
    | angezeigt werden: Footer, Kasse, Bestellbestätigung, Bestell-E-Mails
    | und die Seite /zahlungsarten.
    |
    | Google Merchant Center verlangt, dass die akzeptierten Zahlungsarten vor
    | Abschluss der Bestellung klar sichtbar sind. Hier dürfen deshalb nur
    | Zahlungsarten stehen, die wir tatsächlich anbieten.
    |
    | 'checkout' => true  → wird an der Kasse als auswählbare Zahlungsart angeboten
    | 'checkout' => false → wird nur als Logo/Hinweis angezeigt (z. B. Kartenzahlung
    |                       über den PayPal-Checkout)
    */
    'payment_methods' => [
        [
            'key'         => 'vorkasse',
            'label'       => 'Vorkasse per Überweisung',
            'short'       => 'Vorkasse',
            'icon'        => 'icon-credit-card',
            'logo'        => 'assets/images/payment/vorkasse.svg',
            'checkout'    => true,
            'description' => 'Nach Ihrer Bestellung erhalten Sie eine E-Mail mit allen Bankdaten und Ihrer '
                . 'Bestellnummer. Sobald der Betrag bei uns eingegangen ist, versenden wir Ihre Ware.',
        ],
        [
            'key'         => 'paypal',
            'label'       => 'PayPal',
            'short'       => 'PayPal',
            'icon'        => 'icon-shield',
            'logo'        => 'assets/images/payment/paypal.svg',
            'checkout'    => true,
            'description' => 'Bezahlen Sie schnell und käuferschutzgesichert über Ihr PayPal-Konto. '
                . 'Nach der Bestellung erhalten Sie einen Zahlungslink per E-Mail.',
        ],
        [
            'key'         => 'sofort',
            'label'       => 'Sofortüberweisung',
            'short'       => 'Sofort.',
            'icon'        => 'icon-zap',
            'logo'        => 'assets/images/payment/sofort.svg',
            'checkout'    => true,
            'description' => 'Direktüberweisung über Ihr Online-Banking. Die Zahlung wird uns sofort '
                . 'bestätigt, wir versenden Ihre Ware umgehend.',
        ],
        [
            'key'         => 'paypalplus',
            'label'       => 'PayPal Plus (Rechnung / Ratenzahlung)',
            'short'       => 'PayPal Plus',
            'icon'        => 'icon-file-text',
            'logo'        => 'assets/images/payment/paypalplus.svg',
            'checkout'    => true,
            'description' => 'Kauf auf Rechnung oder Ratenzahlung über PayPal Plus – ein PayPal-Konto ist '
                . 'dafür nicht erforderlich.',
        ],
        [
            'key'         => 'visa',
            'label'       => 'VISA',
            'short'       => 'VISA',
            'icon'        => 'icon-credit-card',
            'logo'        => 'assets/images/payment/visa.svg',
            'checkout'    => true,
            'description' => 'Kartenzahlung mit VISA – abgewickelt über den gesicherten PayPal-Checkout, '
                . 'ein PayPal-Konto ist dafür nicht erforderlich.',
        ],
        [
            'key'         => 'mastercard',
            'label'       => 'MasterCard',
            'short'       => 'MasterCard',
            'icon'        => 'icon-credit-card',
            'logo'        => 'assets/images/payment/mastercard.svg',
            'checkout'    => true,
            'description' => 'Kartenzahlung mit MasterCard – abgewickelt über den gesicherten '
                . 'PayPal-Checkout, ein PayPal-Konto ist dafür nicht erforderlich.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Versandpartner
    |--------------------------------------------------------------------------
    | Werden im Footer und auf der Versandseite als Logos ausgewiesen.
    | Große Fahrzeuge gehen per Spedition, Zubehör per Paketdienst.
    */
    'shipping_carriers' => [
        ['key' => 'post',         'label' => 'Deutsche Post', 'logo' => 'assets/images/shipping/post.svg'],
        ['key' => 'dhl',          'label' => 'DHL',           'logo' => 'assets/images/shipping/dhl.svg'],
        ['key' => 'dpd',          'label' => 'DPD',           'logo' => 'assets/images/shipping/dpd.svg'],
        ['key' => 'db_schenker',  'label' => 'DB Schenker',   'logo' => 'assets/images/shipping/db_schenker.svg'],
        ['key' => 'emons',        'label' => 'Emons',         'logo' => 'assets/images/shipping/emons.svg'],
        ['key' => 'gel',          'label' => 'GEL',           'logo' => 'assets/images/shipping/gel.svg'],
        ['key' => 'gls',          'label' => 'GLS',           'logo' => 'assets/images/shipping/gls.svg'],
    ],

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
