{{--
    Schwebende WhatsApp-Schaltfläche – auf allen Seiten sichtbar.
    Nummer und Nachricht kommen aus config/shop.php.
--}}
@php
    // wa.me erwartet die Nummer ohne "+", Leerzeichen oder Trennzeichen
    $waNumber = preg_replace('/\D+/', '', (string) config('shop.whatsapp'));
    $waMessage = (string) config('shop.whatsapp_message');
    $waLink = 'https://wa.me/' . $waNumber . '?text=' . rawurlencode($waMessage);
@endphp

@if($waNumber)
<a href="{{ $waLink }}"
   class="whatsapp-float"
   target="_blank"
   rel="noopener noreferrer"
   aria-label="Kontakt über WhatsApp aufnehmen"
   title="Schreiben Sie uns auf WhatsApp">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="30" height="30"
         fill="currentColor" aria-hidden="true" focusable="false">
        <path d="M16.004 0h-.008C7.174 0 .001 7.175.001 16c0 3.5 1.128 6.744 3.046 9.377L1.05 31.29l6.117-1.956A15.898 15.898 0 0 0 16.004 32C24.827 32 32 24.825 32 16S24.827 0 16.004 0zm9.318 22.593c-.386 1.09-1.919 1.995-3.142 2.259-.836.178-1.929.32-5.607-1.204-4.705-1.949-7.735-6.73-7.971-7.04-.226-.31-1.901-2.532-1.901-4.83s1.167-3.428 1.638-3.909c.386-.394.837-.574 1.366-.574.171 0 .325.009.463.016.394.017.592.04.852.663.323.78 1.111 2.778 1.205 2.975.096.198.191.466.057.776-.125.32-.235.438-.433.666-.198.229-.386.404-.584.65-.181.213-.386.442-.157.838.229.386.02 1.354 1.833 3.036 2.34 2.081 4.234 2.744 4.673 2.927.328.137.718.104.957-.15.303-.328.678-.872 1.06-1.408.271-.384.613-.432.973-.297.365.128 2.31 1.09 2.708 1.288.398.198.66.293.756.458.094.166.094.948-.292 2.038z"/>
    </svg>
    <span class="whatsapp-float__label">WhatsApp</span>
</a>
@endif
