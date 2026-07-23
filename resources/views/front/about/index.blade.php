@extends('front.layouts.app')

@section('title', 'Über uns')
@section('meta_description', 'Wir sind Ihr Spezialist für Elektroroller und E-Scooter mit Straßenzulassung: geprüfte Fahrzeuge, kostenloser Versand in Deutschland, eigene Werkstatt und persönliche Beratung.')

@section('content')
<main>
  @include('front.partials.page-header', [
    'title' => 'Über uns',
    'subtitle' => 'Ihr Spezialist für Elektroroller und E-Scooter',
  ])

  <section class="py-lg-10 py-8">
    <div class="container">
      <div class="row align-items-center g-5 mb-lg-12 mb-8">
        <div class="col-lg-6">
          <h2 class="fs-3 mb-3">Zwei Fahrzeugklassen – dafür richtig gut</h2>
          <p class="text-muted">
            Wir haben uns bewusst auf zwei Fahrzeugklassen konzentriert, statt alles ein bisschen anzubieten:
            <strong>E-Roller</strong> für alle, die im Sitzen unterwegs sind und Reichweite brauchen, und
            <strong>E-Scooter</strong> für alle, die kompakt, wendig und schnell durch die Stadt kommen wollen.
          </p>
          <p class="text-muted">
            Diese Spezialisierung ist unser Vorteil: Wir kennen jedes Modell in unserem Sortiment, wir wissen,
            welches Fahrzeug zu welchem Fahrprofil passt, und wir können Ersatzteile und Service auch Jahre nach
            dem Kauf noch zuverlässig bereitstellen.
          </p>
          <p class="text-muted mb-0">
            Jedes Fahrzeug, das unser Lager verlässt, wurde vorher geprüft, aufgebaut und Probe gefahren.
            Sie erhalten es fahrfertig geliefert – nicht als Bausatz im Karton.
          </p>
        </div>
        <div class="col-lg-6">
          <img src="{{ asset('assets/images/slider/slide-1.jpg') }}" alt="Elektroroller im Straßenverkehr" class="img-fluid rounded" loading="lazy" />
        </div>
      </div>

      <div class="row g-4 mb-lg-12 mb-8">
        <div class="col-md-6">
          <div class="card border h-100">
            <div class="card-body p-5">
              <i class="feather-icon icon-truck fs-3 text-primary"></i>
              <h2 class="fs-5 mt-3 mb-2">E-Roller</h2>
              <p class="text-muted mb-3">
                Elektroroller mit Sitzposition, für Alltag und Pendelstrecken. Je nach Modell mit 25, 45 oder
                mehr km/h Höchstgeschwindigkeit, Reichweiten bis über 100 km und Platz für zwei Personen.
                Viele Modelle mit herausnehmbarem Akku, der bequem in der Wohnung geladen werden kann.
              </p>
              <a href="{{ route('categories.index', 'e-roller') }}" class="btn btn-outline-primary btn-sm">E-Roller ansehen</a>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card border h-100">
            <div class="card-body p-5">
              <i class="feather-icon icon-zap fs-3 text-primary"></i>
              <h2 class="fs-5 mt-3 mb-2">E-Scooter</h2>
              <p class="text-muted mb-3">
                E-Scooter (Elektro-Tretroller) für die letzte Meile und den Weg zur Arbeit. Kompakt, meist
                faltbar und leicht zu verstauen. Modelle mit ABE dürfen in Deutschland am Straßenverkehr
                teilnehmen – die entsprechende Kennzeichnung finden Sie in jeder Produktbeschreibung.
              </p>
              <a href="{{ route('categories.index', 'e-scooter') }}" class="btn btn-outline-primary btn-sm">E-Scooter ansehen</a>
            </div>
          </div>
        </div>
      </div>

      <div class="row mb-lg-12 mb-8">
        <div class="col-lg-8">
          <h2 class="fs-3 mb-3">Wofür wir stehen</h2>
          <p class="text-muted">
            Elektromobilität ist für uns kein Trend, sondern die praktischste Art, kurze und mittlere Strecken
            zurückzulegen. Ein E-Roller ersetzt im Stadtverkehr das Auto auf den meisten Wegen – bei einem
            Bruchteil der Kosten und ohne lokale Emissionen. Genau dafür beraten wir: nicht für das teuerste
            Modell, sondern für das, das zu Ihrer Strecke passt.
          </p>
          <p class="text-muted mb-0">
            Deshalb finden Sie bei uns zu jedem Fahrzeug vollständige technische Daten: Reichweite, Motorleistung,
            Akkukapazität, zulässiges Gesamtgewicht und Ladezeit. Damit Sie vergleichen können, bevor Sie kaufen.
          </p>
        </div>
      </div>

      <div class="row g-4">
        <div class="col-md-3 col-6">
          <div class="border rounded p-4 h-100">
            <i class="feather-icon icon-truck fs-4 text-primary"></i>
            <h3 class="fs-6 mt-3 mb-1">Kostenloser Versand</h3>
            <p class="text-muted small mb-0">Versandkostenfrei in ganz Deutschland, Lieferung in {{ config('shop.delivery_days') }}.</p>
          </div>
        </div>
        <div class="col-md-3 col-6">
          <div class="border rounded p-4 h-100">
            <i class="feather-icon icon-shield fs-4 text-primary"></i>
            <h3 class="fs-6 mt-3 mb-1">{{ config('shop.warranty_months') }} Monate Garantie</h3>
            <p class="text-muted small mb-0">Zusätzlich zur gesetzlichen Gewährleistung von zwei Jahren.</p>
          </div>
        </div>
        <div class="col-md-3 col-6">
          <div class="border rounded p-4 h-100">
            <i class="feather-icon icon-refresh-cw fs-4 text-primary"></i>
            <h3 class="fs-6 mt-3 mb-1">{{ config('shop.return_days') }} Tage Rückgabe</h3>
            <p class="text-muted small mb-0">Gesetzliches Widerrufsrecht, Rücksendekosten übernehmen wir.</p>
          </div>
        </div>
        <div class="col-md-3 col-6">
          <div class="border rounded p-4 h-100">
            <i class="feather-icon icon-tool fs-4 text-primary"></i>
            <h3 class="fs-6 mt-3 mb-1">Eigene Werkstatt</h3>
            <p class="text-muted small mb-0">Service, Ersatzteile und Reparatur auch nach der Garantiezeit.</p>
          </div>
        </div>
      </div>

      <div class="row mt-lg-12 mt-8">
        <div class="col-lg-8">
          <h2 class="fs-3 mb-3">Fragen zu einem Fahrzeug?</h2>
          <p class="text-muted mb-4">
            Wir beraten Sie gerne persönlich – telefonisch, per E-Mail oder direkt in einer unserer Filialen.
          </p>
          <a href="{{ route('contact') }}" class="btn btn-primary me-2">Kontakt aufnehmen</a>
          <a href="{{ route('stores') }}" class="btn btn-outline-dark">Filialen ansehen</a>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
