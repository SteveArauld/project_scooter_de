@php
    $c = $order['customer'];
    $s = $order['shipping'];
    $url = rtrim(config('app.url'), '/');
    $itemCount = array_sum(array_column($order['items'], 'qty'));
@endphp

@component('emails.layout', [
    'preheader'  => 'Neue Bestellung ' . $order['number'] . ' über ' . number_format($order['total'], 2, ',', '.') . ' €',
    'heading'    => 'Neue Bestellung eingegangen',
    'subheading' => $order['number'] . ' · ' . $order['date'],
    'accent'     => '#1a7f4b',
])

    {{-- Kennzahlen auf einen Blick --}}
    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%"
           style="margin:0 0 24px 0; border-collapse:separate; border-spacing:8px 0;">
        <tr>
            <td width="33%" align="center" style="background-color:#f8f9fa; border-radius:8px; padding:14px 8px;
                       font-family:Arial,Helvetica,sans-serif;">
                <div style="font-size:12px; color:#6c757d;">Bestellwert</div>
                <div style="font-size:18px; font-weight:bold; color:#212529;">
                    {{ number_format($order['total'], 2, ',', '.') }} €
                </div>
            </td>
            <td width="33%" align="center" style="background-color:#f8f9fa; border-radius:8px; padding:14px 8px;
                       font-family:Arial,Helvetica,sans-serif;">
                <div style="font-size:12px; color:#6c757d;">Artikel</div>
                <div style="font-size:18px; font-weight:bold; color:#212529;">{{ $itemCount }}</div>
            </td>
            <td width="33%" align="center" style="background-color:#f8f9fa; border-radius:8px; padding:14px 8px;
                       font-family:Arial,Helvetica,sans-serif;">
                <div style="font-size:12px; color:#6c757d;">Positionen</div>
                <div style="font-size:18px; font-weight:bold; color:#212529;">{{ count($order['items']) }}</div>
            </td>
        </tr>
    </table>

    @if($order['different_shipping'])
        <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%"
               style="background-color:#fff4e5; border-left:4px solid #f0932b; border-radius:6px; margin:0 0 24px 0;">
            <tr>
                <td style="padding:12px 16px; font-family:Arial,Helvetica,sans-serif; font-size:14px; color:#212529;">
                    <strong>Achtung:</strong> Der Kunde hat eine abweichende Lieferadresse angegeben.
                </td>
            </tr>
        </table>
    @endif

    {{-- Kundendaten --}}
    <h2 style="margin:0 0 12px 0; font-family:Arial,Helvetica,sans-serif; font-size:16px; color:#212529;">
        Kundendaten
    </h2>
    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%"
           style="border-collapse:collapse; margin:0 0 24px 0; font-family:Arial,Helvetica,sans-serif; font-size:14px;">
        <tr>
            <td width="130" style="padding:7px 0; color:#6c757d; border-bottom:1px solid #f1f2f4;">Name</td>
            <td style="padding:7px 0; color:#212529; border-bottom:1px solid #f1f2f4;">
                <strong>{{ $c['first_name'] }} {{ $c['last_name'] }}</strong>
            </td>
        </tr>
        <tr>
            <td style="padding:7px 0; color:#6c757d; border-bottom:1px solid #f1f2f4;">E-Mail</td>
            <td style="padding:7px 0; border-bottom:1px solid #f1f2f4;">
                <a href="mailto:{{ $c['email'] }}" style="color:#0d6efd; text-decoration:none;">{{ $c['email'] }}</a>
            </td>
        </tr>
        <tr>
            <td style="padding:7px 0; color:#6c757d; border-bottom:1px solid #f1f2f4;">Telefon</td>
            <td style="padding:7px 0; border-bottom:1px solid #f1f2f4;">
                <a href="tel:{{ preg_replace('/\s+/', '', $c['phone']) }}"
                   style="color:#0d6efd; text-decoration:none;">{{ $c['phone'] }}</a>
            </td>
        </tr>
    </table>

    {{-- Adressen --}}
    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="margin:0 0 24px 0;">
        <tr>
            <td width="50%" valign="top" style="padding-right:12px; font-family:Arial,Helvetica,sans-serif;
                       font-size:14px; line-height:21px; color:#212529;">
                <strong style="display:block; margin-bottom:6px;">Lieferadresse</strong>
                {{ $s['first_name'] }} {{ $s['last_name'] }}<br>
                {{ $s['address'] }}<br>
                {{ $s['zip'] }} {{ $s['city'] }}<br>
                {{ $s['country'] }}
            </td>
            <td width="50%" valign="top" style="padding-left:12px; font-family:Arial,Helvetica,sans-serif;
                       font-size:14px; line-height:21px; color:#212529;">
                <strong style="display:block; margin-bottom:6px;">Rechnungsadresse</strong>
                {{ $c['first_name'] }} {{ $c['last_name'] }}<br>
                {{ $c['address'] }}<br>
                {{ $c['zip'] }} {{ $c['city'] }}<br>
                {{ $c['country'] }}
            </td>
        </tr>
    </table>

    @if(!empty($c['notes']))
        <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%"
               style="background-color:#f8f9fa; border-radius:8px; margin:0 0 24px 0;">
            <tr>
                <td style="padding:14px 18px; font-family:Arial,Helvetica,sans-serif; font-size:14px;
                           line-height:21px; color:#212529;">
                    <strong>Anmerkung des Kunden:</strong><br>{{ $c['notes'] }}
                </td>
            </tr>
        </table>
    @endif

    {{-- Artikel --}}
    <h2 style="margin:0 0 12px 0; font-family:Arial,Helvetica,sans-serif; font-size:16px; color:#212529;">
        Bestellte Artikel
    </h2>
    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%"
           style="border-collapse:collapse; font-family:Arial,Helvetica,sans-serif; font-size:14px;">
        <tr style="background-color:#f8f9fa;">
            <th align="left" style="padding:10px 8px; font-size:12px; color:#6c757d; text-transform:uppercase;
                       border-bottom:1px solid #e6e8eb;">Artikel</th>
            <th align="center" width="60" style="padding:10px 8px; font-size:12px; color:#6c757d;
                       text-transform:uppercase; border-bottom:1px solid #e6e8eb;">Menge</th>
            <th align="right" width="100" style="padding:10px 8px; font-size:12px; color:#6c757d;
                       text-transform:uppercase; border-bottom:1px solid #e6e8eb;">Summe</th>
        </tr>
        @foreach($order['items'] as $item)
            <tr>
                <td style="padding:12px 8px; border-bottom:1px solid #f1f2f4; color:#212529;">
                    <a href="{{ $url }}/produkte/{{ $item['slug'] }}"
                       style="color:#212529; text-decoration:none;">{{ $item['title'] }}</a>
                    @if(!empty($item['reference']))
                        <br><span style="color:#8a9099; font-size:12px;">Art.-Nr.: {{ $item['reference'] }}</span>
                    @endif
                    <br><span style="color:#6c757d; font-size:12px;">
                        Einzelpreis: {{ number_format($item['price'], 2, ',', '.') }} €
                    </span>
                </td>
                <td align="center" style="padding:12px 8px; border-bottom:1px solid #f1f2f4; color:#212529;">
                    {{ $item['qty'] }}
                </td>
                <td align="right" style="padding:12px 8px; border-bottom:1px solid #f1f2f4;
                           color:#212529; font-weight:bold; white-space:nowrap;">
                    {{ number_format($item['line_total'], 2, ',', '.') }} €
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2" align="right" style="padding:14px 8px; border-top:2px solid #212529;
                       font-size:16px; font-weight:bold; color:#212529;">Gesamtsumme</td>
            <td align="right" style="padding:14px 8px; border-top:2px solid #212529;
                       font-size:19px; font-weight:bold; color:#212529; white-space:nowrap;">
                {{ number_format($order['total'], 2, ',', '.') }} €
            </td>
        </tr>
    </table>

    <p style="margin:16px 0 0 0; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#8a9099;">
        Alle Preise inkl. {{ config('shop.vat_rate') }} % MwSt. Bitte den Kunden zeitnah zur Zahlungs- und
        Terminabstimmung kontaktieren.
    </p>

@endcomponent
