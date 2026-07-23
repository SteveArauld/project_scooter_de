{{--
    Gemeinsames E-Mail-Layout.
    Bewusst mit Tabellen und Inline-Styles aufgebaut, da Outlook & Co.
    weder Flexbox/Grid noch externe Stylesheets zuverlässig unterstützen.

    Erwartete Variablen:
      $preheader  – kurzer Vorschautext im Postfach
      $heading    – Überschrift im Kopfbereich
      $subheading – optionale Zeile unter der Überschrift
      $accent     – Farbe des Kopfbereichs (Standard: Markenblau)
--}}
@php
    $accent = $accent ?? '#0d6efd';
    $logo = rtrim(config('app.url'), '/') . '/assets/images/logo/freshcart-logo.svg';
    $shopName = config('shop.name');
@endphp
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light">
    <title>{{ $heading ?? $shopName }}</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f5f7; -webkit-font-smoothing:antialiased;">

{{-- Vorschautext: im Postfach sichtbar, in der Mail selbst nicht --}}
<div style="display:none; max-height:0; overflow:hidden; opacity:0; color:transparent; height:0; width:0;">
    {{ $preheader ?? '' }}
</div>

<table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%"
       style="background-color:#f4f5f7; padding:24px 12px;">
    <tr>
        <td align="center">

            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="600"
                   style="width:100%; max-width:600px; background-color:#ffffff; border-radius:10px;
                          overflow:hidden; border:1px solid #e6e8eb;">

                {{-- Kopf mit Logo --}}
                <tr>
                    <td align="center" style="padding:28px 32px 0 32px;">
                        <img src="{{ $logo }}" alt="{{ $shopName }}" height="40"
                             style="display:block; height:40px; width:auto; border:0;">
                    </td>
                </tr>

                {{-- Farbiger Titelbereich --}}
                <tr>
                    <td style="padding:24px 32px 0 32px;">
                        <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%"
                               style="background-color:{{ $accent }}; border-radius:8px;">
                            <tr>
                                <td style="padding:22px 24px; text-align:center;">
                                    <h1 style="margin:0; font-family:Arial,Helvetica,sans-serif; font-size:21px;
                                               line-height:28px; color:#ffffff; font-weight:bold;">
                                        {{ $heading ?? '' }}
                                    </h1>
                                    @if(!empty($subheading))
                                        <p style="margin:6px 0 0 0; font-family:Arial,Helvetica,sans-serif;
                                                  font-size:14px; line-height:20px; color:#ffffff; opacity:0.9;">
                                            {{ $subheading }}
                                        </p>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                {{-- Inhalt --}}
                <tr>
                    <td style="padding:28px 32px 32px 32px; font-family:Arial,Helvetica,sans-serif;
                               font-size:15px; line-height:23px; color:#212529;">
                        {{ $slot }}
                    </td>
                </tr>

                {{-- Fußbereich --}}
                <tr>
                    <td style="padding:22px 32px; background-color:#f8f9fa; border-top:1px solid #e6e8eb;
                               font-family:Arial,Helvetica,sans-serif; font-size:12px; line-height:19px;
                               color:#6c757d;">
                        <p style="margin:0 0 8px 0; color:#212529; font-weight:bold; font-size:13px;">
                            {{ config('shop.legal_name') }}
                        </p>
                        <p style="margin:0 0 8px 0;">
                            {{ config('shop.street') }}, {{ config('shop.zip') }} {{ config('shop.city') }},
                            {{ config('shop.country') }}<br>
                            Telefon: {{ config('shop.phone') }} &nbsp;·&nbsp;
                            E-Mail: <a href="mailto:{{ config('shop.email') }}"
                                       style="color:{{ $accent }}; text-decoration:none;">{{ config('shop.email') }}</a>
                        </p>
                        <p style="margin:0 0 8px 0;">
                            Geschäftsführer: {{ config('shop.ceo') }} ·
                            {{ config('shop.register_court') }}, {{ config('shop.register_no') }} ·
                            USt-IdNr.: {{ config('shop.vat_id') }}
                        </p>
                        <p style="margin:0;">
                            <a href="{{ url('/impressum') }}" style="color:#6c757d;">Impressum</a> &nbsp;·&nbsp;
                            <a href="{{ url('/datenschutz') }}" style="color:#6c757d;">Datenschutz</a> &nbsp;·&nbsp;
                            <a href="{{ url('/agb') }}" style="color:#6c757d;">AGB</a> &nbsp;·&nbsp;
                            <a href="{{ url('/widerrufsbelehrung') }}" style="color:#6c757d;">Widerrufsbelehrung</a>
                        </p>
                    </td>
                </tr>
            </table>

            <p style="margin:16px 0 0 0; font-family:Arial,Helvetica,sans-serif; font-size:11px; color:#9aa0a6;">
                Diese E-Mail wurde automatisch erzeugt. Bitte antworten Sie bei Rückfragen an
                {{ config('shop.email') }}.
            </p>

        </td>
    </tr>
</table>
</body>
</html>
