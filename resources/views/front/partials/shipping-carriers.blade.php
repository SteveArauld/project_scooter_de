{{--
    Logos unserer Versandpartner.
    Parameter: $title, $align, $showLink, $size (analog zu payment-methods).
--}}
@php
    $title    = $title    ?? 'Unsere Versandpartner';
    $align    = $align    ?? 'start';
    $showLink = $showLink ?? true;
    $size     = $size     ?? 28;
    $carriers = config('shop.shipping_carriers', []);
@endphp

<div class="shipping-carriers text-{{ $align }}">
    @if($title)
        <h2 class="h6 mb-3">{{ $title }}</h2>
    @endif

    {{-- Alle Logos haben eine viewBox von 85×43, daher einheitliche Breite --}}
    <ul class="list-unstyled d-flex flex-wrap align-items-center gap-2 mb-0 justify-content-{{ $align }}">
        @foreach($carriers as $carrier)
            <li>
                <img src="{{ asset($carrier['logo']) }}"
                     class="shipping-logo d-block rounded"
                     alt="{{ $carrier['label'] }}"
                     title="{{ $carrier['label'] }}"
                     loading="lazy"
                     width="{{ round($size * 85 / 43) }}" height="{{ $size }}"
                     style="width:{{ round($size * 85 / 43) }}px;height:auto">
            </li>
        @endforeach
    </ul>

    @if($showLink)
        <p class="small text-muted mt-2 mb-0">
            Details zu Lieferzeit und Versandkosten unter
            <a href="{{ route('shipping') }}">Versand &amp; Rückgabe</a>.
        </p>
    @endif
</div>
