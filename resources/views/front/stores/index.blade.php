@extends('front.layouts.app')

@section('title', 'Filialen')
@section('meta_description', 'Besuchen Sie uns vor Ort: Unsere Filialen in Berlin, München, Hamburg und Köln beraten Sie persönlich zu E-Rollern und E-Scootern.')

@section('content')
<main>
  @include('front.partials.page-header', [
    'title' => 'Unsere Filialen',
    'subtitle' => 'Persönliche Beratung und Probefahrt vor Ort',
  ])

  <section class="py-lg-10 py-8">
    <div class="container">
      <div class="row mb-8">
        <div class="col-lg-8">
          <p class="text-muted mb-0">
            In unseren Filialen können Sie unsere E-Roller und E-Scooter in Ruhe ansehen, Probe fahren und sich
            persönlich beraten lassen. Sie können online bestellte Fahrzeuge dort auch abholen und vor Ort
            bezahlen. Eine Terminvereinbarung ist nicht erforderlich, für eine Probefahrt aber empfehlenswert.
          </p>
        </div>
      </div>

      <div class="row g-4">
        @foreach($stores as $store)
        <div class="col-lg-3 col-md-6">
          <div class="card h-100 border">
            <div class="card-body p-5">
              <h2 class="fs-5 mb-3">{{ $store['city'] }}</h2>
              <p class="text-muted small mb-3">{{ $store['address'] }}</p>
              <p class="mb-1 small">
                <i class="feather-icon icon-phone me-2"></i>
                <a href="tel:{{ preg_replace('/\s+/', '', $store['phone']) }}" class="text-reset text-decoration-none">{{ $store['phone'] }}</a>
              </p>
              <p class="text-muted small mb-0"><i class="feather-icon icon-clock me-2"></i>{{ $store['hours'] }}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <div class="row mt-lg-10 mt-8">
        <div class="col-lg-8">
          <h2 class="fs-5 mb-3">Nicht in Ihrer Nähe?</h2>
          <p class="text-muted mb-4">
            Kein Problem: Wir liefern kostenlos in ganz Deutschland und beraten Sie gerne telefonisch oder per
            E-Mail. Jedes Fahrzeug wird vor dem Versand von uns aufgebaut und geprüft, sodass Sie es fahrfertig
            erhalten.
          </p>
          <a href="{{ route('contact') }}" class="btn btn-primary me-2">Kontakt aufnehmen</a>
          <a href="{{ route('products.index') }}" class="btn btn-outline-dark">Fahrzeuge ansehen</a>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
