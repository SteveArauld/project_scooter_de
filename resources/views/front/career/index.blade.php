@extends('front.layouts.app')

@section('title', 'Karriere')
@section('meta_description', 'Arbeiten Sie mit uns an der Elektromobilität von morgen. Aktuelle Stellenangebote in Verkauf, Werkstatt, Kundenservice und Logistik.')

@section('content')
<main>
  @include('front.partials.page-header', [
    'title' => 'Karriere',
    'subtitle' => 'Werden Sie Teil unseres Teams',
  ])

  <section class="py-lg-10 py-8">
    <div class="container">
      <div class="row mb-8">
        <div class="col-lg-8">
          <h2 class="fs-5 mb-3">Arbeiten bei {{ config('shop.name') }}</h2>
          <p class="text-muted mb-3">
            Wir sind ein Team, das Elektromobilität nicht nur verkauft, sondern selbst fährt. Bei uns arbeiten
            Menschen, die wissen, wovon sie sprechen – vom Verkauf über die Werkstatt bis zur Logistik.
          </p>
          <p class="text-muted mb-0">
            Wir bieten Ihnen unbefristete Verträge, faire Bezahlung, geregelte Arbeitszeiten und die Möglichkeit,
            ein Dienstfahrzeug aus unserem Sortiment zu nutzen. Quereinsteiger sind bei uns ausdrücklich
            willkommen.
          </p>
        </div>
      </div>

      <h2 class="fs-5 mb-4">Offene Stellen</h2>
      <div class="row g-4">
        @foreach($jobs as $job)
        <div class="col-lg-6">
          <div class="card border h-100">
            <div class="card-body p-5 d-flex justify-content-between align-items-center flex-wrap gap-3">
              <div>
                <h3 class="fs-6 mb-1">{{ $job['title'] }}</h3>
                <span class="text-muted small">
                  <i class="feather-icon icon-map-pin me-1"></i>{{ $job['location'] }} · {{ $job['type'] }}
                </span>
              </div>
              <a href="{{ route('contact') }}" class="btn btn-primary btn-sm">Jetzt bewerben</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <div class="row mt-lg-10 mt-8">
        <div class="col-lg-8">
          <h2 class="fs-5 mb-3">Keine passende Stelle dabei?</h2>
          <p class="text-muted mb-4">
            Wir freuen uns jederzeit über Initiativbewerbungen. Schreiben Sie uns kurz, was Sie können und was
            Sie bei uns machen möchten – wir melden uns zurück.
          </p>
          <a href="{{ route('contact') }}" class="btn btn-outline-dark">Initiativbewerbung senden</a>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
