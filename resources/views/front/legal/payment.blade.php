@extends('front.layouts.app')

@section('title', 'Zahlungsarten')
@section('meta_description', 'Diese Zahlungsarten stehen Ihnen bei ' . config('shop.name') . ' zur Verfügung: Vorkasse per Überweisung, Kauf auf Rechnung und Barzahlung bei Abholung.')

@section('content')
<main>
  @include('front.partials.page-header', [
    'title' => 'Zahlungsarten',
    'subtitle' => 'So können Sie Ihre Bestellung bezahlen',
  ])

  <section class="py-lg-10 py-8">
    <div class="container">
      <div class="row g-4 mb-8">
        <div class="col-md-4">
          <div class="card border h-100">
            <div class="card-body p-5">
              <i class="feather-icon icon-credit-card fs-3 text-primary"></i>
              <h2 class="fs-5 mt-3 mb-2">Vorkasse per Überweisung</h2>
              <p class="text-muted small mb-0">
                Nach Ihrer Bestellung erhalten Sie von uns eine E-Mail mit allen Bankdaten und Ihrer
                Bestellnummer. Sobald der Betrag bei uns eingegangen ist, versenden wir Ihre Ware.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card border h-100">
            <div class="card-body p-5">
              <i class="feather-icon icon-file-text fs-3 text-primary"></i>
              <h2 class="fs-5 mt-3 mb-2">Kauf auf Rechnung</h2>
              <p class="text-muted small mb-0">
                Für Bestandskunden und Gewerbekunden bieten wir den Kauf auf Rechnung an. Der Rechnungsbetrag
                ist innerhalb von 14 Tagen ab Rechnungsdatum ohne Abzug fällig.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card border h-100">
            <div class="card-body p-5">
              <i class="feather-icon icon-shopping-bag fs-3 text-primary"></i>
              <h2 class="fs-5 mt-3 mb-2">Barzahlung bei Abholung</h2>
              <p class="text-muted small mb-0">
                Sie können Ihr Fahrzeug in einer unserer <a href="{{ route('stores') }}">Filialen</a> abholen und
                vor Ort bar oder mit EC-Karte bezahlen.
              </p>
            </div>
          </div>
        </div>
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
