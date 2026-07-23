@php
    $c = $order['customer'];
    $s = $order['shipping'];
    $url = rtrim(config('app.url'), '/');
@endphp

@component('emails.layout', [
    'preheader'  => 'Wir haben Ihre Bestellung ' . $order['number'] . ' erhalten. Vielen Dank!',
    'heading'    => 'Vielen Dank für Ihre Bestellung!',
    'subheading' => 'Bestellnummer ' . $order['number'] . ' · ' . $order['date'],
])

    <p style="margin:0 0 16px 0;">
        Hallo {{ $c['first_name'] }} {{ $c['last_name'] }},
    </p>

    <p style="margin:0 0 16px 0;">
        vielen Dank für Ihr Vertrauen. Wir haben Ihre Bestellung erhalten und prüfen sie jetzt.
        Unser Team meldet sich in Kürze bei Ihnen, um Zahlung und Liefertermin abzustimmen.
    </p>

    {{-- Nächste Schritte --}}
    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%"
           style="background-color:#f8f9fa; border-radius:8px; margin:0 0 24px 0;">
        <tr>
            <td style="padding:18px 20px; font-family:Arial,Helvetica,sans-serif; font-size:14px; line-height:22px; color:#212529;">
                <strong style="display:block; margin-bottom:8px;">So geht es weiter</strong>
                1. Wir bestätigen Ihre Bestellung und stimmen die Zahlung mit Ihnen ab.<br>
                2. Wir bauen Ihr Fahrzeug auf, prüfen alle Funktionen und fahren es Probe.<br>
                3. Der Versand erfolgt per Spedition – übliche Lieferzeit: {{ config('shop.delivery_days') }}.<br>
                4. Die Spedition meldet sich vorab telefonisch zur Terminabstimmung.
            </td>
        </tr>
    </table>

    {{-- Artikel --}}
    <h2 style="margin:0 0 12px 0; font-family:Arial,Helvetica,sans-serif; font-size:16px; color:#212529;">
        Ihre Artikel
    </h2>

    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%"
           style="border-collapse:collapse; margin:0 0 8px 0;">
        @foreach($order['items'] as $item)
            <tr>
                <td width="64" style="padding:12px 12px 12px 0; border-bottom:1px solid #eceef0; vertical-align:top;">
                    <img src="{{ $url . $item['image'] }}" alt="" width="56"
                         style="display:block; width:56px; height:56px; object-fit:contain;
                                border:1px solid #eceef0; border-radius:6px; background:#fff;">
                </td>
                <td style="padding:12px 8px 12px 0; border-bottom:1px solid #eceef0;
                           font-family:Arial,Helvetica,sans-serif; font-size:14px; line-height:20px; color:#212529;">
                    {{ $item['title'] }}
                    @if(!empty($item['reference']))
                        <br><span style="color:#8a9099; font-size:12px;">Art.-Nr.: {{ $item['reference'] }}</span>
                    @endif
                    <br><span style="color:#6c757d; font-size:13px;">
                        {{ $item['qty'] }} × {{ number_format($item['price'], 2, ',', '.') }} €
                    </span>
                </td>
                <td align="right" style="padding:12px 0; border-bottom:1px solid #eceef0; white-space:nowrap;
                           font-family:Arial,Helvetica,sans-serif; font-size:14px; color:#212529; font-weight:bold;">
                    {{ number_format($item['line_total'], 2, ',', '.') }} €
                </td>
            </tr>
        @endforeach

        <tr>
            <td colspan="2" style="padding:10px 8px 4px 0; font-family:Arial,Helvetica,sans-serif;
                       font-size:14px; color:#6c757d;">Zwischensumme</td>
            <td align="right" style="padding:10px 0 4px 0; font-family:Arial,Helvetica,sans-serif;
                       font-size:14px; color:#212529;">{{ number_format($order['total'], 2, ',', '.') }} €</td>
        </tr>
        <tr>
            <td colspan="2" style="padding:0 8px 10px 0; font-family:Arial,Helvetica,sans-serif;
                       font-size:14px; color:#6c757d;">Versand</td>
            <td align="right" style="padding:0 0 10px 0; font-family:Arial,Helvetica,sans-serif;
                       font-size:14px; color:#1a7f4b;">Kostenlos</td>
        </tr>
        <tr>
            <td colspan="2" style="padding:12px 8px 12px 0; border-top:2px solid #212529;
                       font-family:Arial,Helvetica,sans-serif; font-size:16px; color:#212529; font-weight:bold;">
                Gesamtsumme
            </td>
            <td align="right" style="padding:12px 0; border-top:2px solid #212529;
                       font-family:Arial,Helvetica,sans-serif; font-size:19px; color:#212529; font-weight:bold;">
                {{ number_format($order['total'], 2, ',', '.') }} €
            </td>
        </tr>
    </table>

    <p style="margin:0 0 24px 0; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#8a9099;">
        Alle Preise inkl. {{ config('shop.vat_rate') }} % MwSt. Der Versand innerhalb Deutschlands ist kostenlos.
    </p>

    {{-- Adressen --}}
    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="margin:0 0 24px 0;">
        <tr>
            <td width="50%" valign="top" style="padding-right:12px; font-family:Arial,Helvetica,sans-serif;
                       font-size:14px; line-height:21px; color:#212529;">
                <strong style="display:block; margin-bottom:6px;">Lieferadresse</strong>
                {{ $s['first_name'] }} {{ $s['last_name'] }}<br>
                {{ $s['address'] }}<br>
                {{ $s['zip'] }} {{ $s['city'] }}<br>
                {{ $s['country'] }}<br>
                <span style="color:#6c757d;">Telefon: {{ $c['phone'] }}</span>
            </td>
            <td width="50%" valign="top" style="padding-left:12px; font-family:Arial,Helvetica,sans-serif;
                       font-size:14px; line-height:21px; color:#212529;">
                <strong style="display:block; margin-bottom:6px;">Rechnungsadresse</strong>
                @if($order['different_shipping'])
                    {{ $c['first_name'] }} {{ $c['last_name'] }}<br>
                    {{ $c['address'] }}<br>
                    {{ $c['zip'] }} {{ $c['city'] }}<br>
                    {{ $c['country'] }}
                @else
                    <span style="color:#6c757d;">Entspricht der Lieferadresse.</span>
                @endif
            </td>
        </tr>
    </table>

    @if(!empty($c['notes']))
        <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%"
               style="background-color:#f8f9fa; border-radius:8px; margin:0 0 24px 0;">
            <tr>
                <td style="padding:14px 18px; font-family:Arial,Helvetica,sans-serif; font-size:14px;
                           line-height:21px; color:#212529;">
                    <strong>Ihre Anmerkung:</strong><br>{{ $c['notes'] }}
                </td>
            </tr>
        </table>
    @endif

    {{-- Widerruf --}}
    <p style="margin:0 0 20px 0; font-family:Arial,Helvetica,sans-serif; font-size:13px;
              line-height:20px; color:#6c757d;">
        Als Verbraucher haben Sie ein {{ config('shop.return_days') }}-tägiges Widerrufsrecht.
        Die Einzelheiten finden Sie in unserer
        <a href="{{ $url }}/widerrufsbelehrung" style="color:#0d6efd;">Widerrufsbelehrung</a>.
    </p>

    <p style="margin:0;">
        Bei Fragen erreichen Sie uns unter {{ config('shop.phone') }} oder
        <a href="mailto:{{ config('shop.email') }}" style="color:#0d6efd;">{{ config('shop.email') }}</a>.
    </p>

    <p style="margin:20px 0 0 0;">
        Mit freundlichen Grüßen<br>
        <strong>Ihr {{ config('shop.name') }} Team</strong>
    </p>

@endcomponent
