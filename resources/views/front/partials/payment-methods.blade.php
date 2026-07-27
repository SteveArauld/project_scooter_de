{{--
    Logos der akzeptierten Zahlungsarten.
    Wird im Footer, an der Kasse, auf der Bestellbestätigung und auf der Seite
    /zahlungsarten eingebunden, damit die Zahlungsarten vor Abschluss der
    Bestellung sichtbar sind (Anforderung Google Merchant Center).

    Parameter:
      $title    – Überschrift (null = keine Überschrift)
      $align    – 'start' | 'center' | 'end'
      $showLink – Link zur Seite /zahlungsarten anzeigen
      $size     – Logohöhe in Pixeln
--}}
@php
    $title    = $title    ?? 'Unsere Zahlungsarten';
    $align    = $align    ?? 'start';
    $showLink = $showLink ?? true;
    $size     = $size     ?? 28;
    $methods  = config('shop.payment_methods', []);
@endphp

<div class="payment-methods text-{{ $align }}">
    @if($title)
        <h2 class="h6 mb-3">{{ $title }}</h2>
    @endif

    {{-- Alle Logos haben eine viewBox von 85×43, daher einheitliche Breite --}}
    <ul class="list-unstyled d-flex flex-wrap align-items-center gap-2 mb-0 justify-content-{{ $align }}">
        @foreach($methods as $method)
            <li>
                <img src="{{ asset($method['logo']) }}"
                     class="payment-logo d-block rounded"
                     alt="{{ $method['label'] }}"
                     title="{{ $method['description'] }}"
                     loading="lazy"
                     width="{{ round($size * 85 / 43) }}" height="{{ $size }}"
                     style="width:{{ round($size * 85 / 43) }}px;height:auto">
            </li>
        @endforeach
    </ul>

    @if($showLink)
        <p class="small text-muted mt-2 mb-0">
            Alle Details zu den Zahlungsarten finden Sie unter
            <a href="{{ route('payment') }}">Zahlungsarten</a>.
        </p>
    @endif
</div>
