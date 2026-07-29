@extends('front.layouts.app')

@section('title', 'Warenkorb')

@section('content')
<main>
  <div class="mt-4">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Startseite</a></li>
          <li class="breadcrumb-item active" aria-current="page">Warenkorb</li>
        </ol>
      </nav>
    </div>
  </div>

  <section class="mb-lg-14 mt-8">
    <div class="container">
      <h1 class="fs-2 mb-6">Ihr Warenkorb</h1>
      <div class="row">
        <div class="col-lg-8 mb-6 mb-lg-0">
          <div id="cartEmpty" class="text-center py-12 d-none">
            <i class="feather-icon icon-shopping-bag fs-1 text-muted"></i>
            <h4 class="mt-4">Ihr Warenkorb ist leer</h4>
            <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Weiter einkaufen</a>
          </div>
          <div id="cartTableWrap" class="table-responsive">
            <table class="table align-middle">
              <thead class="border-bottom">
                <tr>
                  <th>Produkt</th>
                  <th class="text-center">Menge</th>
                  <th class="text-end">Preis</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="cartRows"></tbody>
            </table>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card border shadow-sm">
            <div class="card-body p-6">
              <h5 class="mb-4">Zusammenfassung</h5>
              <div class="d-flex justify-content-between mb-2">
                <span>Zwischensumme</span>
                <span data-cart-total>0,00 €</span>
              </div>
              <div class="d-flex justify-content-between mb-3">
                <span>Versand</span>
                <span class="text-success">Kostenlos</span>
              </div>
              <hr />
              <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                <span>Gesamt</span>
                <span data-cart-total>0,00 €</span>
              </div>
              <a href="{{ route('checkout') }}" id="checkoutBtn" class="btn btn-primary w-100">Zur Kasse</a>
              <a href="{{ route('products.index') }}" class="btn btn-outline-dark w-100 mt-2">Weiter einkaufen</a>

              <p class="small text-muted mt-3 mb-0">
                Alle Preise inkl. {{ config('shop.vat_rate') }} % MwSt., der Versand innerhalb
                Deutschlands ist kostenlos.
              </p>

              <hr class="my-4">
              @include('front.partials.payment-methods', [
                'title' => 'Unsere Zahlungsarten',
                'align' => 'start',
                'showLink' => true,
                'size' => 30,
              ])
            </div>
          </div>
        </div>

        <!-- Zahlungsarten & Versandpartner -->
        <div class="col-12 mt-8">
          <div class="card border shadow-sm">
            <div class="card-body p-6">
              <div class="row g-5">
                <div class="col-lg-7">
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

                  <ul class="list-unstyled row row-cols-1 row-cols-md-2 g-3 mt-2 mb-0">
                    @foreach(config('shop.payment_methods', []) as $method)
                      <li class="col">
                        <span class="fw-semibold small d-block mb-1">{{ $method['label'] }}</span>
                        <span class="text-muted small">{{ $method['description'] }}</span>
                      </li>
                    @endforeach
                  </ul>
                </div>

                <div class="col-lg-5">
                  <h5 class="mb-1">Versand</h5>
                  <p class="text-muted small mb-4">
                    Kostenloser Versand innerhalb Deutschlands, Lieferzeit {{ config('shop.delivery_days') }}.
                    Große Fahrzeuge liefern wir per Spedition.
                  </p>

                  @include('front.partials.shipping-carriers', [
                    'title' => null,
                    'align' => 'start',
                    'showLink' => true,
                    'size' => 36,
                  ])
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection

@push('scripts')
<script>
  // ISO-Datum (YYYY-MM-DD) in deutsche Schreibweise umwandeln
  function formatReleaseDate(iso) {
    var d = new Date(iso);
    if (isNaN(d.getTime())) return iso;
    return d.toLocaleDateString('de-DE', { day: 'numeric', month: 'long', year: 'numeric' });
  }

  function renderCartPage() {
    var items = Cart.items();
    var rows = document.getElementById('cartRows');
    var empty = document.getElementById('cartEmpty');
    var wrap = document.getElementById('cartTableWrap');
    var checkout = document.getElementById('checkoutBtn');
    if (!items.length) {
      empty.classList.remove('d-none');
      wrap.classList.add('d-none');
      if (checkout) checkout.classList.add('disabled');
      return;
    }
    empty.classList.add('d-none');
    wrap.classList.remove('d-none');
    if (checkout) checkout.classList.remove('disabled');
    rows.innerHTML = items.map(function (i) {
      return '<tr>' +
        '<td><div class="d-flex align-items-center">' +
        '<img src="' + i.image + '" style="width:70px;height:70px;object-fit:contain" class="me-3" />' +
        '<div><a href="' + i.url + '" class="text-inherit text-decoration-none">' + i.title + '</a>' +
        (i.preorder ? '<div class="mt-1"><span class="badge bg-warning text-dark">Vorbestellung</span>' +
          '<small class="text-muted ms-2">Lieferbar ab ' + formatReleaseDate(i.preorder) + '</small></div>' : '') +
        '</div></div></td>' +
        '<td class="text-center" style="min-width:140px">' +
        '<div class="input-group input-spinner flex-nowrap justify-content-center" style="max-width:140px;margin:auto">' +
        '<button type="button" class="button-minus btn btn-sm border" aria-label="Menge verringern"' +
        ' data-dec="' + i.slug + '"' + (i.qty <= 1 ? ' disabled' : '') + '>&minus;</button>' +
        '<input type="number" min="1" step="1" value="' + i.qty + '" aria-label="Menge"' +
        ' class="form-control form-control-sm text-center border" data-qty="' + i.slug + '" />' +
        '<button type="button" class="button-plus btn btn-sm border" aria-label="Menge erhöhen"' +
        ' data-inc="' + i.slug + '">+</button>' +
        '</div></td>' +
        '<td class="text-end fw-bold">' + euroFormat(i.price * i.qty) + '</td>' +
        '<td class="text-end"><a href="#!" class="text-danger" data-cart-remove="' + i.slug + '"><i class="feather-icon icon-trash-2"></i></a></td>' +
        '</tr>';
    }).join('');
  }

  document.addEventListener('cart:updated', renderCartPage);
  document.addEventListener('DOMContentLoaded', renderCartPage);

  function currentQty(slug) {
    var item = Cart.items().find(function (x) { return x.slug === slug; });
    return item ? (parseInt(item.qty, 10) || 1) : 1;
  }

  // In der Capture-Phase, damit der generische .input-group-Handler aus
  // theme.min.js (der button-plus/button-minus ebenfalls abfängt und dabei
  // auf einem leeren input[name] scheitert) hier nicht mehr greift.
  document.addEventListener('click', function (e) {
    var inc = e.target.closest('[data-inc]');
    if (inc) {
      e.preventDefault();
      e.stopPropagation();
      Cart.setQty(inc.getAttribute('data-inc'), currentQty(inc.getAttribute('data-inc')) + 1);
      return;
    }
    var dec = e.target.closest('[data-dec]');
    if (dec) {
      e.preventDefault();
      e.stopPropagation();
      var slug = dec.getAttribute('data-dec');
      var next = currentQty(slug) - 1;
      if (next < 1) return;
      Cart.setQty(slug, next);
    }
  }, true);

  document.addEventListener('change', function (e) {
    var q = e.target.closest('[data-qty]');
    if (!q) return;
    var value = parseInt(q.value, 10);
    if (isNaN(value) || value < 1) value = 1;
    Cart.setQty(q.getAttribute('data-qty'), value);
  });
</script>
@endpush
