@extends('front.layouts.app')

@section('title', 'Zahlungsarten')
@section('meta_description', 'Diese Zahlungsarten stehen Ihnen bei ' . config('shop.name') . ' zur Verfügung: '
    . implode(', ', array_column(config('shop.payment_methods', []), 'label')) . '.')

@section('content')
<main>
  @include('front.partials.page-header', [
    'title' => 'Zahlungsarten',
    'subtitle' => 'So können Sie Ihre Bestellung bezahlen',
  ])

  <section class="py-lg-10 py-8">
    <div class="container">
      {{-- Übersicht aller Logos --}}
      <div class="mb-8">
        @include('front.partials.payment-methods', [
          'title' => 'Unsere Zahlungsarten auf einen Blick',
          'align' => 'start',
          'showLink' => false,
          'size' => 36,
        ])
      </div>

      {{-- Details je Zahlungsart – gepflegt in config/shop.php --}}
      <div class="row g-4 mb-8">
        @foreach(config('shop.payment_methods', []) as $method)
        <div class="col-md-4">
          <div class="card border h-100">
            <div class="card-body p-5">
              <img src="{{ asset($method['logo']) }}" alt="{{ $method['label'] }}"
                   width="79" height="40" style="width:79px;height:auto" class="rounded">
              <h2 class="fs-5 mt-3 mb-2">{{ $method['label'] }}</h2>
              <p class="text-muted small mb-0">{{ $method['description'] }}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <div class="mb-8">
        @include('front.partials.shipping-carriers', [
          'title' => 'Unsere Versandpartner',
          'align' => 'start',
          'showLink' => true,
          'size' => 36,
        ])
      </div>

      <div class="row">
        <div class="col-lg-8">
          <h2 class="fs-5 mb-3">Preisangaben</h2>
          <p class="text-muted mb-5">
            Alle im Shop angegebenen Preise sind Endpreise in Euro und enthalten die gesetzliche Mehrwertsteuer
            von {{ config('shop.vat_rate') }} %. Der Versand innerhalb Deutschlands ist kostenlos – es fallen
            keine zusätzlichen Liefer- oder Versandkosten an.
          </p>

          <h2 class="fs-5 mb-3">Sicherheit</h2>
          <p class="text-muted mb-5">
            Die Übertragung Ihrer Daten erfolgt verschlüsselt über SSL/TLS. Wir speichern keine Kartendaten in
            unserem System. Weitere Informationen finden Sie in unserer
            <a href="{{ route('privacy') }}">Datenschutzerklärung</a>.
          </p>

          <h2 class="fs-5 mb-3">Fragen zur Zahlung?</h2>
          <p class="text-muted mb-0">
            Unser Team hilft Ihnen gerne weiter – telefonisch unter {{ config('shop.phone') }} oder per E-Mail an
            <a href="mailto:{{ config('shop.email') }}">{{ config('shop.email') }}</a>.
            Alle weiteren Bedingungen finden Sie in unseren <a href="{{ route('terms') }}">AGB</a>.
          </p>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
