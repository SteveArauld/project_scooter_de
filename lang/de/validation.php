<?php

/*
|--------------------------------------------------------------------------
| Validierungs-Sprachdateien (Deutsch)
|--------------------------------------------------------------------------
| APP_LOCALE ist auf "de" gesetzt. Ohne diese Datei gibt Laravel die
| Übersetzungsschlüssel selbst aus ("validation.required").
*/

return [

    'accepted'             => ':attribute muss akzeptiert werden.',
    'active_url'           => ':attribute ist keine gültige URL.',
    'after'                => ':attribute muss ein Datum nach :date sein.',
    'after_or_equal'       => ':attribute muss ein Datum nach oder gleich :date sein.',
    'alpha'                => ':attribute darf nur aus Buchstaben bestehen.',
    'alpha_dash'           => ':attribute darf nur aus Buchstaben, Zahlen, Binde- und Unterstrichen bestehen.',
    'alpha_num'            => ':attribute darf nur aus Buchstaben und Zahlen bestehen.',
    'array'                => ':attribute muss ein Array sein.',
    'before'               => ':attribute muss ein Datum vor :date sein.',
    'before_or_equal'      => ':attribute muss ein Datum vor oder gleich :date sein.',
    'boolean'              => ':attribute muss entweder wahr oder falsch sein.',
    'confirmed'            => ':attribute stimmt nicht mit der Bestätigung überein.',
    'date'                 => ':attribute ist kein gültiges Datum.',
    'date_format'          => ':attribute entspricht nicht dem Format :format.',
    'declined'             => ':attribute muss abgelehnt werden.',
    'different'            => ':attribute und :other müssen sich unterscheiden.',
    'digits'               => ':attribute muss :digits Stellen haben.',
    'digits_between'       => ':attribute muss zwischen :min und :max Stellen haben.',
    'email'                => ':attribute muss eine gültige E-Mail-Adresse sein.',
    'ends_with'            => ':attribute muss mit einem der folgenden Werte enden: :values.',
    'exists'               => 'Der gewählte Wert für :attribute ist ungültig.',
    'file'                 => ':attribute muss eine Datei sein.',
    'filled'               => ':attribute muss ausgefüllt sein.',
    'image'                => ':attribute muss ein Bild sein.',
    'in'                   => 'Der gewählte Wert für :attribute ist ungültig.',
    'integer'              => ':attribute muss eine ganze Zahl sein.',
    'json'                 => ':attribute muss ein gültiger JSON-String sein.',
    'lowercase'            => ':attribute darf nur Kleinbuchstaben enthalten.',
    'max'                  => [
        'array'   => ':attribute darf nicht mehr als :max Elemente haben.',
        'file'    => ':attribute darf maximal :max Kilobytes groß sein.',
        'numeric' => ':attribute darf maximal :max sein.',
        'string'  => ':attribute darf maximal :max Zeichen haben.',
    ],
    'mimes'                => ':attribute muss eine Datei vom Typ :values sein.',
    'min'                  => [
        'array'   => ':attribute muss mindestens :min Elemente haben.',
        'file'    => ':attribute muss mindestens :min Kilobytes groß sein.',
        'numeric' => ':attribute muss mindestens :min sein.',
        'string'  => ':attribute muss mindestens :min Zeichen haben.',
    ],
    'not_in'               => 'Der gewählte Wert für :attribute ist ungültig.',
    'numeric'              => ':attribute muss eine Zahl sein.',
    'present'              => ':attribute muss vorhanden sein.',
    'prohibited'           => ':attribute ist unzulässig.',
    'regex'                => 'Das Format von :attribute ist ungültig.',
    'required'             => 'Bitte füllen Sie das Feld :attribute aus.',
    'required_if'          => 'Bitte füllen Sie das Feld :attribute aus, wenn :other den Wert :value hat.',
    'required_unless'      => 'Bitte füllen Sie das Feld :attribute aus, sofern :other nicht :values ist.',
    'required_with'        => 'Bitte füllen Sie das Feld :attribute aus, wenn :values vorhanden ist.',
    'required_without'     => 'Bitte füllen Sie das Feld :attribute aus, wenn :values nicht vorhanden ist.',
    'same'                 => ':attribute und :other müssen übereinstimmen.',
    'size'                 => [
        'array'   => ':attribute muss genau :size Elemente haben.',
        'file'    => ':attribute muss :size Kilobytes groß sein.',
        'numeric' => ':attribute muss gleich :size sein.',
        'string'  => ':attribute muss :size Zeichen lang sein.',
    ],
    'starts_with'          => ':attribute muss mit einem der folgenden Werte beginnen: :values.',
    'string'               => ':attribute muss ein Text sein.',
    'unique'               => ':attribute ist bereits vergeben.',
    'uploaded'             => ':attribute konnte nicht hochgeladen werden.',
    'uppercase'            => ':attribute darf nur Großbuchstaben enthalten.',
    'url'                  => ':attribute muss eine gültige URL sein.',

    /*
    |--------------------------------------------------------------------------
    | Benutzerdefinierte Meldungen
    |--------------------------------------------------------------------------
    */
    'custom' => [
        'items' => [
            'required' => 'Ihr Warenkorb ist leer.',
            'json'     => 'Ihr Warenkorb konnte nicht gelesen werden. Bitte laden Sie die Seite neu.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Feldbezeichnungen
    |--------------------------------------------------------------------------
    | Sorgt dafür, dass in Fehlermeldungen "Vorname" statt "first name" steht.
    */
    'attributes' => [
        'first_name'          => 'Vorname',
        'last_name'           => 'Nachname',
        'email'               => 'E-Mail-Adresse',
        'phone'               => 'Telefonnummer',
        'address'             => 'Straße und Hausnummer',
        'zip'                 => 'Postleitzahl',
        'city'                => 'Stadt',
        'country'             => 'Land',
        'notes'               => 'Anmerkung',
        'items'               => 'Warenkorb',
        'different_shipping'  => 'abweichende Lieferadresse',
        'shipping_first_name' => 'Vorname (Lieferadresse)',
        'shipping_last_name'  => 'Nachname (Lieferadresse)',
        'shipping_address'    => 'Straße und Hausnummer (Lieferadresse)',
        'shipping_zip'        => 'Postleitzahl (Lieferadresse)',
        'shipping_city'       => 'Ort (Lieferadresse)',
        'shipping_country'    => 'Land (Lieferadresse)',
        'name'                => 'Name',
        'subject'             => 'Betreff',
        'message'             => 'Nachricht',
        'password'            => 'Passwort',
    ],

];
