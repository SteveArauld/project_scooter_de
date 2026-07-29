@extends('front.layouts.app')

@section('title', 'Garantie & Service')
@section('meta_description', 'Auf alle E-Roller und E-Scooter gewähren wir ' . config('shop.warranty_months') . ' Monate Herstellergarantie – zusätzlich zur gesetzlichen Gewährleistung von zwei Jahren.')

@section('content')
<main>
  @include('front.partials.page-header', [
    'title' => 'Garantie & Service',
    'subtitle' => config('shop.warranty_months') . ' Monate Herstellergarantie auf alle Fahrzeuge',
  ])

  <section class="py-lg-10 py-8">
    <div class="container">
      <div class="row g-5">
        <div class="col-lg-8">

          <h2 class="fs-5 mb-3">Gesetzliche Gewährleistung</h2>
          <p class="text-muted mb-5">
            Für alle bei uns gekauften Fahrzeuge gilt die gesetzliche Gewährleistung von zwei Jahren ab Erhalt
            der Ware. Zeigt sich innerhalb der ersten zwölf Monate ein Mangel, wird vermutet, dass dieser bereits
            bei Übergabe vorlag. Ihre gesetzlichen Rechte werden durch unsere zusätzliche Garantie nicht
            eingeschränkt.
          </p>

          <h2 class="fs-5 mb-3">Unsere Herstellergarantie</h2>
          <p class="text-muted mb-3">
            Zusätzlich gewähren wir Ihnen {{ config('shop.warranty_months') }} Monate Garantie auf Material- und
            Verarbeitungsfehler. Abgedeckt sind insbesondere:
          </p>
          <ul class="text-muted mb-5">
            <li>Motor und Steuerelektronik</li>
            <li>Rahmen und tragende Bauteile</li>
            <li>Ladegerät und Bordelektrik</li>
            <li>Verarbeitungsfehler an Karosserie und Anbauteilen</li>
          </ul>

          <h2 class="fs-5 mb-3">Was nicht abgedeckt ist</h2>
          <p class="text-muted mb-3">Von der Garantie ausgenommen sind:</p>
          <ul class="text-muted mb-5">
            <li>Verschleißteile wie Reifen, Bremsbeläge, Bremsscheiben und Leuchtmittel</li>
            <li>Der normale, altersbedingte Kapazitätsverlust des Akkus</li>
            <li>Schäden durch Unfälle, Stürze, Überlastung oder unsachgemäße Nutzung</li>
            <li>Schäden durch Eingriffe Dritter, Tuning oder nicht freigegebene Ersatzteile</li>
            <li>Optische Gebrauchsspuren, die die Funktion nicht beeinträchtigen</li>
          </ul>

          <h2 class="fs-5 mb-3">So melden Sie einen Garantiefall</h2>
          <ol class="text-muted mb-5">
            <li class="mb-2">Kontaktieren Sie uns per E-Mail oder telefonisch und halten Sie Ihre Bestellnummer bereit.</li>
            <li class="mb-2">Beschreiben Sie den Mangel möglichst genau – Fotos oder ein kurzes Video helfen uns sehr.</li>
            <li class="mb-2">Unser Serviceteam prüft Ihren Fall und meldet sich innerhalb von 48 Stunden bei Ihnen.</li>
            <li class="mb-2">Bei einem berechtigten Garantiefall organisieren wir Reparatur, Ersatzteil oder Austausch – für Sie kostenfrei.</li>
          </ol>

          <h2 class="fs-5 mb-3">Service und Ersatzteile</h2>
          <p class="text-muted mb-5">
            Auch nach Ablauf der Garantie lassen wir Sie nicht allein: In unserer eigenen Werkstatt führen wir
            Wartungen und Reparaturen durch und halten Ersatzteile für die von uns verkauften Modelle vor.
            Sprechen Sie uns einfach an.
          </p>

          <h2 class="fs-5 mb-3">Pflegehinweise für eine lange Lebensdauer</h2>
          <ul class="text-muted mb-0">
            <li>Laden Sie den Akku regelmäßig und lagern Sie ihn nicht dauerhaft vollständig entladen.</li>
            <li>Vermeiden Sie das Laden bei Temperaturen unter 0 °C.</li>
            <li>Prüfen Sie regelmäßig Reifendruck, Bremsen und Beleuchtung.</li>
            <li>Reinigen Sie das Fahrzeug im Winter von Streusalz – aber niemals mit dem Hochdruckreiniger.</li>
          </ul>

        </div>

        <div class="col-lg-4">
          <div class="card border">
            <div class="card-body p-5">
              <h2 class="fs-5 mb-3">Garantiefall melden</h2>
              <p class="text-muted small mb-4">
                Unser Serviceteam ist Montag bis Freitag von 9 bis 18 Uhr für Sie da.
              </p>
              <p class="mb-2 small"><i class="feather-icon icon-phone me-2"></i><a href="tel:{{ config('shop.phone_e164') }}" class="text-reset text-decoration-none">{{ config('shop.phone') }}</a></p>
              <p class="mb-4 small"><i class="feather-icon icon-mail me-2"></i><a href="mailto:{{ config('shop.email') }}" class="text-reset text-decoration-none">{{ config('shop.email') }}</a></p>
              <a href="{{ route('contact') }}" class="btn btn-primary w-100">Kontakt aufnehmen</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
