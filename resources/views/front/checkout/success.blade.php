@extends('front.layouts.app')

@section('title', 'Bestellung bestätigt')

@section('content')
<main>
  <section class="my-lg-14 my-10">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <i class="bi bi-check-circle-fill text-success" style="font-size:4rem"></i>
          <h1 class="mt-4 mb-2">Vielen Dank für Ihre Bestellung!</h1>
          <p class="lead text-muted">Ihre Bestellnummer lautet <strong>{{ $order['number'] }}</strong>.</p>
          <p>Wir haben eine Bestätigung an <strong>{{ $order['customer']['email'] }}</strong> gesendet. Unser Team setzt sich in Kürze mit Ihnen in Verbindung.</p>

          <div class="card border shadow-sm text-start mt-6">
            <div class="card-body p-6">
              <h5 class="mb-4">Bestellübersicht</h5>
              <ul class="list-group list-group-flush mb-3">
                @foreach($order['items'] as $item)
                <li class="list-group-item px-0 d-flex justify-content-between">
                  <span>{{ $item['title'] }} <span class="text-muted">× {{ $item['qty'] }}</span></span>
                  <span class="fw-medium">{{ number_format($item['line_total'], 2, ',', '.') }} €</span>
                </li>
                @endforeach
              </ul>
              <div class="d-flex justify-content-between fw-bold fs-5">
                <span>Gesamt</span>
                <span>{{ number_format($order['total'], 2, ',', '.') }} €</span>
              </div>
            </div>
          </div>

          <a href="{{ route('products.index') }}" class="btn btn-primary mt-6">Weiter einkaufen</a>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection

@push('scripts')
<script>
  // Warenkorb nach erfolgreicher Bestellung leeren
  if (window.Cart) { Cart.clear(); }
  sessionStorage.removeItem('clearCartOnSuccess');
</script>
@endpush
