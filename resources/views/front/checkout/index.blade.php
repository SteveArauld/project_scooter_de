@extends('front.layouts.app')

@section('title', 'Kasse')

@section('content')
<main>
  <div class="mt-4">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Startseite</a></li>
          <li class="breadcrumb-item"><a href="{{ route('cart') }}">Warenkorb</a></li>
          <li class="breadcrumb-item active" aria-current="page">Kasse</li>
        </ol>
      </nav>
    </div>
  </div>

  <section class="mb-lg-14 mt-8">
    <div class="container">
      <h1 class="fs-2 mb-6">Kasse</h1>

      @php
        // Der Block „Abweichende Lieferadresse“ muss offen bleiben, wenn dort Fehler auftraten
        $shippingKeys  = ['shipping_first_name','shipping_last_name','shipping_address','shipping_zip','shipping_city','shipping_country'];
        $shippingOpen  = old('different_shipping') || $errors->hasAny($shippingKeys);
      @endphp

      @if($errors->any())
      <div class="alert alert-danger">
        <p class="fw-semibold mb-1">Bitte prüfen Sie Ihre Eingaben.</p>
        <p class="mb-0 small">Die betroffenen Felder sind unten rot markiert.</p>
        @foreach(['items', 'mail'] as $globalKey)
          @error($globalKey)<p class="mb-0 mt-2">{{ $message }}</p>@enderror
        @endforeach
      </div>
      @endif

      <form method="POST" action="{{ route('order.store') }}" id="checkoutForm" novalidate>
        @csrf
        <input type="hidden" name="items" id="itemsField" value="">
        <div class="row">
          <!-- Rechnungsdaten -->
          <div class="col-lg-7 mb-6 mb-lg-0">
            <div class="card border shadow-sm">
              <div class="card-body p-6">
                <h5 class="mb-4">Lieferadresse</h5>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label" for="first_name">Vorname *</label>
                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}"
                           class="form-control @error('first_name') is-invalid @enderror" required>
                    @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="last_name">Nachname *</label>
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}"
                           class="form-control @error('last_name') is-invalid @enderror" required>
                    @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="email">E-Mail *</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                           class="form-control @error('email') is-invalid @enderror" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="phone">Telefon *</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                           class="form-control @error('phone') is-invalid @enderror" required>
                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  <div class="col-12">
                    <label class="form-label" for="address">Straße und Hausnummer *</label>
                    <input type="text" id="address" name="address" value="{{ old('address') }}"
                           class="form-control @error('address') is-invalid @enderror" required>
                    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  <div class="col-md-4">
                    <label class="form-label" for="zip">PLZ *</label>
                    <input type="text" id="zip" name="zip" value="{{ old('zip') }}"
                           class="form-control @error('zip') is-invalid @enderror" required>
                    @error('zip')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  <div class="col-md-8">
                    <label class="form-label" for="city">Stadt *</label>
                    <input type="text" id="city" name="city" value="{{ old('city') }}"
                           class="form-control @error('city') is-invalid @enderror" required>
                    @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  <div class="col-12">
                    <label class="form-label" for="country">Land *</label>
                    <input type="text" id="country" name="country" value="{{ old('country', 'Deutschland') }}"
                           class="form-control @error('country') is-invalid @enderror" required>
                    @error('country')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  <div class="col-12">
                    <label class="form-label" for="notes">Anmerkung (optional)</label>
                    <textarea id="notes" name="notes" rows="3"
                              class="form-control @error('notes') is-invalid @enderror">{{ old('notes') }}</textarea>
                    @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                </div>

                <!-- Abweichende Lieferadresse -->
                <hr class="my-5">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="1"
                         name="different_shipping" id="differentShipping"
                         {{ $shippingOpen ? 'checked' : '' }}>
                  <label class="form-check-label fw-semibold" for="differentShipping">
                    An eine andere Adresse liefern
                  </label>
                  <div class="form-text">
                    Aktivieren Sie diese Option, wenn die Lieferung an eine andere Anschrift oder in ein
                    anderes Land erfolgen soll als die Rechnungsadresse.
                  </div>
                </div>

                <div id="shippingFields" class="mt-4 {{ $shippingOpen ? '' : 'd-none' }}">
                  <h2 class="fs-6 mb-3">Abweichende Lieferadresse</h2>
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label class="form-label" for="shipping_first_name">Vorname *</label>
                      <input type="text" id="shipping_first_name" name="shipping_first_name"
                             value="{{ old('shipping_first_name') }}"
                             class="form-control @error('shipping_first_name') is-invalid @enderror">
                      @error('shipping_first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="shipping_last_name">Nachname *</label>
                      <input type="text" id="shipping_last_name" name="shipping_last_name"
                             value="{{ old('shipping_last_name') }}"
                             class="form-control @error('shipping_last_name') is-invalid @enderror">
                      @error('shipping_last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                      <label class="form-label" for="shipping_address">Straße und Hausnummer *</label>
                      <input type="text" id="shipping_address" name="shipping_address"
                             value="{{ old('shipping_address') }}"
                             class="form-control @error('shipping_address') is-invalid @enderror">
                      @error('shipping_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                      <label class="form-label" for="shipping_zip">PLZ *</label>
                      <input type="text" id="shipping_zip" name="shipping_zip"
                             value="{{ old('shipping_zip') }}"
                             class="form-control @error('shipping_zip') is-invalid @enderror">
                      @error('shipping_zip')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-8">
                      <label class="form-label" for="shipping_city">Ort *</label>
                      <input type="text" id="shipping_city" name="shipping_city"
                             value="{{ old('shipping_city') }}"
                             class="form-control @error('shipping_city') is-invalid @enderror">
                      @error('shipping_city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                      <label class="form-label" for="shipping_country">Land *</label>
                      <input type="text" id="shipping_country" name="shipping_country"
                             value="{{ old('shipping_country', 'Deutschland') }}"
                             class="form-control @error('shipping_country') is-invalid @enderror">
                      @error('shipping_country')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- Bestellübersicht -->
          <div class="col-lg-5">
            <div class="card border shadow-sm">
              <div class="card-body p-6">
                <h5 class="mb-4">Ihre Bestellung</h5>
                <ul class="list-group list-group-flush mb-3" id="summaryItems"></ul>
                <div class="d-flex justify-content-between mb-2">
                  <span>Zwischensumme</span><span data-cart-total>0,00 €</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                  <span>Versand</span><span class="text-success">Kostenlos</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                  <span>Gesamt</span><span data-cart-total>0,00 €</span>
                </div>
                <div id="preorderNotice" class="alert alert-warning small py-2 px-3 d-none" role="status">
                  <span class="fw-semibold d-block">Ihre Bestellung enthält Vorbestellungen.</span>
                  Vorbestellte Artikel werden erst ab dem jeweils angegebenen Erscheinungsdatum
                  versandt. Bereits lieferbare Artikel senden wir sofort – die Bestellung wird bei
                  Bedarf in Teillieferungen aufgeteilt, ohne Mehrkosten für Sie.
                </div>
                <button type="submit" class="btn btn-primary w-100" id="placeOrderBtn">Bestellung aufgeben</button>
                <p class="small text-muted mt-3 mb-0">
                    Mit dem Absenden Ihrer Bestellung erkennen Sie unsere
                    <a href="{{ route('terms') }}">AGB</a> an und bestätigen, die
                    <a href="{{ route('withdrawal') }}">Widerrufsbelehrung</a> sowie die
                    <a href="{{ route('privacy') }}">Datenschutzerklärung</a> zur Kenntnis genommen zu haben.
                    Alle Preise verstehen sich inkl. {{ config('shop.vat_rate') }} % MwSt., der Versand
                    innerhalb Deutschlands ist kostenlos. Sie erhalten eine Bestätigung per E-Mail.
                </p>
              </div>
            </div>
          </div>

          <!-- Zahlungsarten (nur Information, keine Auswahl an der Kasse) -->
          <div class="col-12 mt-6">
            <div class="card border shadow-sm">
              <div class="card-body p-6">
                <h5 class="mb-1">Zahlungsarten</h5>
                <p class="text-muted small mb-4">
                  Diese Zahlungsarten stehen Ihnen zur Verfügung. Nach dem Absenden Ihrer Bestellung
                  erhalten Sie von uns alle Zahlungsinformationen per E-Mail. Es fallen keine
                  zusätzlichen Zahlungsgebühren an.
                </p>

                @include('front.partials.payment-methods', [
                  'title' => null,
                  'align' => 'start',
                  'showLink' => false,
                  'size' => 36,
                ])

                <ul class="list-unstyled row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mt-2 mb-3">
                  @foreach(config('shop.payment_methods', []) as $method)
                    <li class="col">
                      <span class="fw-semibold small d-block mb-1">{{ $method['label'] }}</span>
                      <span class="text-muted small">{{ $method['description'] }}</span>
                    </li>
                  @endforeach
                </ul>

                <p class="small text-muted mb-0">
                  Die Übertragung Ihrer Daten erfolgt verschlüsselt über SSL/TLS. Weitere Informationen
                  finden Sie unter <a href="{{ route('payment') }}">Zahlungsarten</a>.
                </p>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
</main>
@endsection

@push('scripts')
<script>
  function renderCheckout() {
    var items = Cart.items();
    var box = document.getElementById('summaryItems');
    box.innerHTML = items.map(function (i) {
      var release = '';
      if (i.preorder) {
        var d = new Date(i.preorder);
        var label = isNaN(d.getTime()) ? i.preorder
          : d.toLocaleDateString('de-DE', { day: 'numeric', month: 'long', year: 'numeric' });
        release = '<div class="mt-1"><span class="badge bg-warning text-dark">Vorbestellung</span>' +
          '<small class="text-muted ms-2">Lieferbar ab ' + label + '</small></div>';
      }
      return '<li class="list-group-item px-0 d-flex justify-content-between">' +
        '<span class="small">' + i.title + ' <span class="text-muted">× ' + i.qty + '</span>' + release + '</span>' +
        '<span class="fw-medium small text-nowrap ms-2">' + euroFormat(i.price * i.qty) + '</span></li>';
    }).join('');
    var hasPreorder = items.some(function (i) { return !!i.preorder; });
    var notice = document.getElementById('preorderNotice');
    if (notice) notice.classList.toggle('d-none', !hasPreorder);
    document.getElementById('itemsField').value = JSON.stringify(items.map(function (i) {
      return { slug: i.slug, qty: i.qty };
    }));
    if (!items.length) {
      document.getElementById('placeOrderBtn').disabled = true;
    }
  }
  document.addEventListener('cart:updated', renderCheckout);
  document.addEventListener('DOMContentLoaded', renderCheckout);

  // Abweichende Lieferadresse ein-/ausblenden und Pflichtfelder mitschalten
  (function () {
    var toggle = document.getElementById('differentShipping');
    var block = document.getElementById('shippingFields');
    if (!toggle || !block) return;

    var fields = block.querySelectorAll('input');

    function sync() {
      var on = toggle.checked;
      block.classList.toggle('d-none', !on);
      fields.forEach(function (f) {
        f.required = on;
        if (!on) f.setCustomValidity('');
      });
    }

    toggle.addEventListener('change', sync);
    sync();
  })();
  document.getElementById('checkoutForm').addEventListener('submit', function () {
    document.getElementById('itemsField').value = JSON.stringify(Cart.items().map(function (i) {
      return { slug: i.slug, qty: i.qty };
    }));
    // Warenkorb nach erfolgreicher Absendung leeren (Server rendert Erfolgsseite)
    sessionStorage.setItem('clearCartOnSuccess', '1');
  });
</script>
@endpush
