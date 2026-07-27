@extends('front.layouts.app')

@section('title', 'Versand & Rückgabe')
@section('meta_description', 'Kostenloser Versand in ganz Deutschland, Lieferung in ' . config('shop.delivery_days') . ' und ' . config('shop.return_days') . ' Tage Widerrufsrecht – alle Informationen zu Versand und Rückgabe.')

@section('content')
<main>
  @include('front.partials.page-header', [
    'title' => 'Versand & Rückgabe',
    'subtitle' => 'Kostenlose Lieferung in ganz Deutschland',
  ])

  <section class="py-lg-10 py-8">
    <div class="container">

      <div class="mb-lg-10 mb-8">
        @include('front.partials.shipping-carriers', [
          'title' => 'Unsere Versandpartner',
          'align' => 'start',
          'showLink' => false,
          'size' => 36,
        ])
      </div>

      <div class="row g-4 mb-lg-10 mb-8">
        <div class="col-md-4">
          <div class="card border h-100">
            <div class="card-body p-5">
              <i class="feather-icon icon-truck fs-3 text-primary"></i>
              <h2 class="fs-5 mt-3 mb-2">Kostenloser Versand</h2>
              <p class="text-muted small mb-0">Innerhalb Deutschlands versenden wir ohne Zusatzkosten – unabhängig vom Bestellwert.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card border h-100">
            <div class="card-body p-5">
              <i class="feather-icon icon-clock fs-3 text-primary"></i>
              <h2 class="fs-5 mt-3 mb-2">{{ config('shop.delivery_days') }}</h2>
              <p class="text-muted small mb-0">Übliche Lieferzeit ab Bestellung. Fahrzeuge werden per Spedition zugestellt.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card border h-100">
            <div class="card-body p-5">
              <i class="feather-icon icon-refresh-cw fs-3 text-primary"></i>
              <h2 class="fs-5 mt-3 mb-2">{{ config('shop.return_days') }} Tage Rückgabe</h2>
              <p class="text-muted small mb-0">Gesetzliches Widerrufsrecht. Die Kosten der Rücksendung übernehmen wir.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-8">

          <h2 class="fs-5 mb-3">Versandkosten</h2>
          <p class="text-muted mb-5">
            Der Versand innerhalb Deutschlands ist für Sie kostenlos. Es fallen keine zusätzlichen Liefer- oder
            Versandkosten an. Alle angegebenen Preise sind Endpreise inklusive der gesetzlichen Mehrwertsteuer
            von {{ config('shop.vat_rate') }} %. Eine Lieferung auf Inseln oder ins Ausland ist derzeit nicht
            möglich.
          </p>

          <h2 class="fs-5 mb-3">Lieferzeit und Zustellung</h2>
          <p class="text-muted mb-3">
            Nach Eingang Ihrer Bestellung bereiten wir Ihr Fahrzeug sorgfältig für den Versand vor: Wir bauen es
            auf, prüfen alle Funktionen und fahren es Probe. Die übliche Lieferzeit beträgt
            {{ config('shop.delivery_days') }} ab Vertragsschluss.
          </p>
          <p class="text-muted mb-5">
            Die Zustellung erfolgt per Spedition an die von Ihnen angegebene Lieferanschrift. Das
            Speditionsunternehmen meldet sich vorab telefonisch zur Terminabstimmung – geben Sie deshalb bitte
            eine Telefonnummer an, unter der Sie tagsüber erreichbar sind. Sobald Ihre Bestellung unser Lager
            verlässt, erhalten Sie eine Sendungsverfolgung per E-Mail.
          </p>

          <h2 class="fs-5 mb-3">Bitte bei der Annahme prüfen</h2>
          <p class="text-muted mb-5">
            Kontrollieren Sie die Sendung bei der Übergabe auf äußere Schäden. Sollte die Verpackung sichtbar
            beschädigt sein, lassen Sie dies bitte direkt vom Fahrer auf dem Lieferschein vermerken und
            informieren Sie uns umgehend. So können wir den Schaden gegenüber der Spedition geltend machen und
            Ihnen schnell helfen.
          </p>

          <h2 class="fs-5 mb-3">Rückgabe und Widerruf</h2>
          <p class="text-muted mb-3">
            Als Verbraucher haben Sie das Recht, den Vertrag innerhalb von {{ config('shop.return_days') }} Tagen
            ab Erhalt der Ware ohne Angabe von Gründen zu widerrufen. Die vollständigen Bedingungen und das
            Muster-Widerrufsformular finden Sie in unserer
            <a href="{{ route('withdrawal') }}">Widerrufsbelehrung</a>.
          </p>
          <p class="text-muted mb-5">
            Bitte kontaktieren Sie uns vor der Rücksendung, damit wir die Abholung durch die Spedition
            organisieren können. Die Kosten der Rücksendung übernehmen wir. Für einen etwaigen Wertverlust müssen
            Sie nur aufkommen, wenn dieser auf einen Umgang mit der Ware zurückzuführen ist, der zur Prüfung
            ihrer Beschaffenheit und Funktionsweise nicht notwendig war.
          </p>

          <h2 class="fs-5 mb-3">Rückerstattung</h2>
          <p class="text-muted mb-5">
            Nach Eingang Ihres Widerrufs erstatten wir Ihnen alle erhaltenen Zahlungen einschließlich der
            Lieferkosten spätestens innerhalb von 14 Tagen. Die Rückzahlung erfolgt über dasselbe Zahlungsmittel,
            das Sie bei der Bestellung verwendet haben. Wir können die Rückzahlung zurückhalten, bis wir die Ware
            zurückerhalten haben oder Sie den Nachweis der Rücksendung erbracht haben.
          </p>

          <h2 class="fs-5 mb-3">Fragen zu Ihrer Lieferung?</h2>
          <p class="text-muted mb-0">
            Unser Kundenservice hilft Ihnen gerne weiter – telefonisch unter {{ config('shop.phone') }} oder per
            E-Mail an <a href="mailto:{{ config('shop.email') }}">{{ config('shop.email') }}</a>.
            <a href="{{ route('contact') }}">Zum Kontaktformular</a>.
          </p>

        </div>
      </div>
    </div>
  </section>
</main>
@endsection
