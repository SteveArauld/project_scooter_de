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
        '<a href="' + i.url + '" class="text-inherit text-decoration-none">' + i.title + '</a></div></td>' +
        '<td class="text-center" style="min-width:130px">' +
        '<div class="input-group input-spinner" style="max-width:130px;margin:auto">' +
        '<button class="btn btn-sm border" type="button" data-dec="' + i.slug + '">-</button>' +
        '<input type="number" min="1" value="' + i.qty + '" class="form-control form-control-sm text-center border" data-qty="' + i.slug + '" />' +
        '<button class="btn btn-sm border" type="button" data-inc="' + i.slug + '">+</button>' +
        '</div></td>' +
        '<td class="text-end fw-bold">' + euroFormat(i.price * i.qty) + '</td>' +
        '<td class="text-end"><a href="#!" class="text-danger" data-cart-remove="' + i.slug + '"><i class="feather-icon icon-trash-2"></i></a></td>' +
        '</tr>';
    }).join('');
  }

  document.addEventListener('cart:updated', renderCartPage);
  document.addEventListener('DOMContentLoaded', renderCartPage);
  document.addEventListener('click', function (e) {
    var inc = e.target.closest('[data-inc]');
    var dec = e.target.closest('[data-dec]');
    if (inc) { var s = inc.getAttribute('data-inc'); var it = Cart.items().find(x=>x.slug===s); Cart.setQty(s,(it?it.qty:1)+1); }
    if (dec) { var s2 = dec.getAttribute('data-dec'); var it2 = Cart.items().find(x=>x.slug===s2); Cart.setQty(s2,(it2?it2.qty:1)-1); }
  });
  document.addEventListener('change', function (e) {
    var q = e.target.closest('[data-qty]');
    if (q) Cart.setQty(q.getAttribute('data-qty'), q.value);
  });
</script>
@endpush
