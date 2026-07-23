@extends('front.layouts.app')

@section('title', 'Häufige Fragen')
@section('meta_description', 'Antworten auf die häufigsten Fragen zu E-Rollern und E-Scootern: Führerschein, Versicherung, Reichweite, Akku, Versand, Rückgabe und Garantie.')

@push('structured_data')
@php
    $faqItems = [];
    foreach ($categories as $group) {
        foreach ($group['questions'] as $q) {
            $faqItems[] = [
                '@type' => 'Question',
                'name'  => $q['question'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $q['answer']],
            ];
        }
    }
    $faqLd = [
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => $faqItems,
    ];
@endphp
<script type="application/ld+json">
    {!! json_encode($faqLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush

@section('content')
<main>
  @include('front.partials.page-header', [
    'title' => 'Häufige Fragen',
    'subtitle' => 'Antworten rund um E-Roller, E-Scooter, Bestellung und Service',
  ])

  <section class="py-lg-10 py-8">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          @foreach($categories as $ci => $group)
          <div class="mb-8">
            <h2 class="fs-4 mb-4">
              <i class="feather-icon {{ $group['icon'] }} text-primary me-2"></i>{{ $group['title'] }}
            </h2>
            <div class="accordion" id="faq-{{ $ci }}">
              @foreach($group['questions'] as $qi => $q)
              <div class="accordion-item">
                <h3 class="accordion-header" id="heading-{{ $ci }}-{{ $qi }}">
                  <button class="accordion-button {{ $qi === 0 ? '' : 'collapsed' }}" type="button"
                          data-bs-toggle="collapse" data-bs-target="#collapse-{{ $ci }}-{{ $qi }}"
                          aria-expanded="{{ $qi === 0 ? 'true' : 'false' }}"
                          aria-controls="collapse-{{ $ci }}-{{ $qi }}">
                    {{ $q['question'] }}
                  </button>
                </h3>
                <div id="collapse-{{ $ci }}-{{ $qi }}"
                     class="accordion-collapse collapse {{ $qi === 0 ? 'show' : '' }}"
                     aria-labelledby="heading-{{ $ci }}-{{ $qi }}" data-bs-parent="#faq-{{ $ci }}">
                  <div class="accordion-body text-muted">{{ $q['answer'] }}</div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          @endforeach

          <div class="border-top pt-6">
            <h2 class="fs-5 mb-3">Ihre Frage war nicht dabei?</h2>
            <p class="text-muted mb-4">
              Schreiben Sie uns – wir antworten in der Regel innerhalb eines Werktages.
            </p>
            <a href="{{ route('contact') }}" class="btn btn-primary">Kontakt aufnehmen</a>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card border">
            <div class="card-body p-5">
              <h2 class="fs-5 mb-3">Direkter Kontakt</h2>
              <p class="mb-2 small"><i class="feather-icon icon-phone me-2"></i>{{ config('shop.phone') }}</p>
              <p class="mb-4 small"><i class="feather-icon icon-mail me-2"></i>{{ config('shop.email') }}</p>
              <p class="text-muted small mb-0">Montag bis Freitag von 9 bis 18 Uhr erreichbar.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
