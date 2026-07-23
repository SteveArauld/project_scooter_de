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

      @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
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
                    <label class="form-label">Vorname *</label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" required>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Nachname *</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" required>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">E-Mail *</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Telefon *</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" required>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Straße und Hausnummer *</label>
                    <input type="text" name="address" value="{{ old('address') }}" class="form-control" required>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">PLZ *</label>
                    <input type="text" name="zip" value="{{ old('zip') }}" class="form-control" required>
                  </div>
                  <div class="col-md-8">
                    <label class="form-label">Stadt *</label>
                    <input type="text" name="city" value="{{ old('city') }}" class="form-control" required>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Land *</label>
                    <input type="text" name="country" value="{{ old('country', 'Deutschland') }}" class="form-control" required>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Anmerkung (optional)</label>
                    <textarea name="notes" rows="3" class="form-control">{{ old('notes') }}</textarea>
                  </div>
                </div>

                <!-- Abweichende Lieferadresse -->
                <hr class="my-5">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="1"
                         name="different_shipping" id="differentShipping"
                         {{ old('different_shipping') ? 'checked' : '' }}>
                  <label class="form-check-label fw-semibold" for="differentShipping">
                    An eine andere Adresse liefern
                  </label>
                  <div class="form-text">
                    Aktivieren Sie diese Option, wenn die Lieferung an eine andere Anschrift oder in ein
                    anderes Land erfolgen soll als die Rechnungsadresse.
                  </div>
                </div>

                <div id="shippingFields" class="mt-4 {{ old('different_shipping') ? '' : 'd-none' }}">
                  <h2 class="fs-6 mb-3">Abweichende Lieferadresse</h2>
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label class="form-label" for="shipping_first_name">Vorname *</label>
                      <input type="text" id="shipping_first_name" name="shipping_first_name"
                             value="{{ old('shipping_first_name') }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="shipping_last_name">Nachname *</label>
                      <input type="text" id="shipping_last_name" name="shipping_last_name"
                             value="{{ old('shipping_last_name') }}" class="form-control">
                    </div>
                    <div class="col-12">
                      <label class="form-label" for="shipping_address">Straße und Hausnummer *</label>
                      <input type="text" id="shipping_address" name="shipping_address"
                             value="{{ old('shipping_address') }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label" for="shipping_zip">PLZ *</label>
                      <input type="text" id="shipping_zip" name="shipping_zip"
                             value="{{ old('shipping_zip') }}" class="form-control">
                    </div>
                    <div class="col-md-8">
                      <label class="form-label" for="shipping_city">Ort *</label>
                      <input type="text" id="shipping_city" name="shipping_city"
                             value="{{ old('shipping_city') }}" class="form-control">
                    </div>
                    <div class="col-12">
                      <label class="form-label" for="shipping_country">Land *</label>
                      <input type="text" id="shipping_country" name="shipping_country"
                             value="{{ old('shipping_country', 'Deutschland') }}" class="form-control">
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
      return '<li class="list-group-item px-0 d-flex justify-content-between">' +
        '<span class="small">' + i.title + ' <span class="text-muted">× ' + i.qty + '</span></span>' +
        '<span class="fw-medium small">' + euroFormat(i.price * i.qty) + '</span></li>';
    }).join('');
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
