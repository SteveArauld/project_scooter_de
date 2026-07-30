@extends('front.layouts.app')

@section('title', 'Elektroroller & E-Scooter online kaufen')
@section('meta_description', 'E-Roller und E-Scooter mit Straßenzulassung online kaufen: geprüfte Fahrzeuge, kostenloser Versand in ganz Deutschland, ' . config('shop.warranty_months') . ' Monate Garantie und persönliche Beratung.')

@section('content')
<main>

  <!-- Hero-Slider (reine Werbeflächen, ohne Preisangaben) -->
  <section class="mt-6">
    <div class="container">
      <div class="hero-slider">
        <div class="media-banner hero-banner" style="background-image: url(/assets/images/slider/slide-1.jpg)">
          <div class="ps-lg-10 py-lg-12 col-xxl-6 col-md-8 py-10 px-8">
            <span class="badge text-bg-warning mb-3">Straßenzugelassen &amp; fahrfertig geliefert</span>
            <h2 class="display-5 fw-bold mb-3">Elektroroller für jeden Weg</h2>
            <p class="lead mb-4">
              Leistungsstark, umweltfreundlich und alltagstauglich – mit kostenlosem Versand in ganz Deutschland.
            </p>
            <a href="{{ route('categories.index', 'e-roller') }}" class="btn btn-primary">
              E-Roller entdecken<i class="feather-icon icon-arrow-right ms-1"></i>
            </a>
          </div>
        </div>
        <div class="media-banner hero-banner" style="background-image: url(/assets/images/slider/slider-2.jpg)">
          <div class="ps-lg-10 py-lg-12 col-xxl-6 col-md-8 py-10 px-8">
            <span class="badge text-bg-warning mb-3">Kostenloser Versand in Deutschland</span>
            <h2 class="display-5 fw-bold mb-3">Kompakt durch die Stadt</h2>
            <p class="lead mb-4">
              E-Scooter mit ABE – faltbar, wendig und ideal für den Weg zur Arbeit und die letzte Meile.
            </p>
            <a href="{{ route('categories.index', 'e-scooter') }}" class="btn btn-primary">
              E-Scooter entdecken<i class="feather-icon icon-arrow-right ms-1"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Kategorien -->
  <section class="my-lg-12 my-8">
    <div class="container">
      <div class="row mb-6">
        <div class="col-12">
          <h2 class="fs-3 mb-1">Unsere Kategorien</h2>
          <p class="text-muted mb-0">Wir führen ausschließlich E-Roller und E-Scooter – dafür in großer Auswahl.</p>
        </div>
      </div>
      <div class="row g-4">
        @foreach($sections as $section)
        <div class="col-md-6">
          <a href="{{ route('categories.index', $section['slug']) }}"
             class="media-banner media-banner--center category-tile h-100"
             style="background-image: url('{{ $section['image'] }}')">
            <div>
              <h3 class="fs-2 fw-bold">{{ $section['label'] }}</h3>
              <p class="mb-3">
                @if($section['slug'] === 'e-roller')
                  Sitzend unterwegs: mehr Reichweite, Platz für zwei und Stauraum für den Alltag.
                @else
                  Stehend unterwegs: kompakt, faltbar und schnell zur Hand.
                @endif
              </p>
              <span class="btn btn-primary btn-sm">{{ $section['total'] }} Modelle ansehen</span>
            </div>
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Produktblöcke je Kategorie -->
  @foreach($sections as $section)
  <section class="my-lg-12 my-8">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-6">
        <div>
          <h2 class="fs-3 mb-1">{{ $section['label'] }}</h2>
          <p class="text-muted mb-0">{{ $section['total'] }} Modelle verfügbar</p>
        </div>
        <a href="{{ route('categories.index', $section['slug']) }}" class="btn btn-outline-dark btn-sm">
          Alle anzeigen
        </a>
      </div>
      <div class="row g-4 row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-2">
        @foreach($section['products'] as $product)
          @include('front.partials.product-card', ['product' => $product])
        @endforeach
      </div>
    </div>
  </section>
  @endforeach

  <!-- Tagesangebote mit Countdown -->
  <section class="my-lg-12 my-8">
    <div class="container">
      <div class="row mb-6">
        <div class="col-12">
          <h2 class="fs-3 mb-1">Tagesangebote</h2>
          <p class="text-muted mb-0">Nur für kurze Zeit – sichern Sie sich unsere Aktionspreise.</p>
        </div>
      </div>
      <div class="row row-cols-lg-4 row-cols-1 row-cols-md-2 g-4">
        <div class="col">
          <div class="media-banner media-banner--center h-100 d-flex align-items-end p-6" style="background-image: url(/assets/images/banner/banner-deal.jpg); min-height: 420px">
            <div>
              <h3 class="fw-bold">Aktion des Monats</h3>
              <p class="mb-3">Sichern Sie sich das Angebot, bevor die Zeit abläuft.</p>
              <a href="{{ route('products.index') }}?sale=1" class="btn btn-primary btn-sm">
                Angebote ansehen<i class="feather-icon icon-arrow-right ms-1"></i>
              </a>
            </div>
          </div>
        </div>
        @foreach($deals as $product)
        @php
          $t = $product->getTranslation('title', 'de');
          /*
            Aktions- und Streichpreis kommen ausschließlich aus den Produktdaten
            (price / list_price) – dieselbe Quelle wie g:price und g:sale_price
            im Merchant-Feed. Ohne hinterlegten Streichpreis wird nur der
            reguläre Preis ohne Rabatt-Badge angezeigt.
          */
          $promo = (float) $product->price;
          $discount = $product->discount_percent;
          $orig = $product->is_discounted ? (float) $product->list_price : null;
        @endphp
        <div class="col">
          <div class="card card-product h-100">
            <div class="card-body">
              <div class="text-center position-relative">
@if($discount)
                <div class="position-absolute top-0 start-0">
                  <span class="badge bg-danger">-{{ $discount }}%</span>
                </div>
@endif
                <a href="{{ route('products.show', $product->slug) }}">
                  <img src="{{ $product->main_image }}" alt="{{ $t }}" class="mb-3 img-fluid" style="height:160px;object-fit:contain" loading="lazy" />
                </a>
                <div class="card-product-action">
                  <a href="#!" class="btn-action" title="Schnellansicht" data-quick-view
                     data-slug="{{ $product->slug }}" data-title="{{ $t }}"
                     data-price="{{ number_format($promo, 2, ',', '.') }} €"
                     data-price-raw="{{ $product->price }}" data-image="{{ $product->main_image }}"
                     data-category="{{ $product->category_label }}" data-brand="{{ $product->brand }}"
                     data-availability="{{ $product->availability }}"
                     data-url="{{ route('products.show', $product->slug) }}"><i class="bi bi-eye"></i></a>
                </div>
              </div>
              <div class="text-small mb-1"><small class="text-muted">{{ $product->category_label }}</small></div>
              <h3 class="fs-6"><a href="{{ route('products.show', $product->slug) }}" class="text-inherit text-decoration-none">{{ \Illuminate\Support\Str::limit($t, 45) }}</a></h3>
              <div class="mt-2">
                <span class="{{ $orig ? 'text-danger' : 'text-dark' }} fw-bold">{{ number_format($promo, 2, ',', '.') }} €</span>
@if($orig)
                <span class="text-decoration-line-through text-muted small ms-1">{{ number_format($orig, 2, ',', '.') }} €</span>
@endif
                <div><small class="text-muted">inkl. MwSt., kostenloser Versand</small></div>
              </div>
              <div class="d-grid mt-3">
                <button type="button" class="btn btn-primary btn-sm"
                        data-add-to-cart data-slug="{{ $product->slug }}" data-title="{{ $t }}"
                        data-price="{{ $product->price }}" data-image="{{ $product->main_image }}"
                        data-url="{{ route('products.show', $product->slug) }}"
                        data-added-label="<i class='bi bi-check-lg'></i>">
                  <i class="feather-icon icon-plus"></i> In den Warenkorb
                </button>
              </div>
              <div class="d-flex justify-content-start text-center mt-3">
                <div class="deals-countdown w-100" data-countdown="{{ $dealEnds }}"></div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Vorteile -->
  <section class="bg-light py-lg-10 py-8">
    <div class="container">
      <div class="row text-center g-4">
        <div class="col-md-3 col-6">
          <i class="feather-icon icon-truck fs-3 text-primary"></i>
          <h3 class="fs-6 mt-3 mb-1">Kostenloser Versand</h3>
          <p class="text-muted small mb-0">In ganz Deutschland, ohne Mindestbestellwert.</p>
        </div>
        <div class="col-md-3 col-6">
          <i class="feather-icon icon-shield fs-3 text-primary"></i>
          <h3 class="fs-6 mt-3 mb-1">{{ config('shop.warranty_months') }} Monate Garantie</h3>
          <p class="text-muted small mb-0">Zusätzlich zur gesetzlichen Gewährleistung.</p>
        </div>
        <div class="col-md-3 col-6">
          <i class="feather-icon icon-refresh-cw fs-3 text-primary"></i>
          <h3 class="fs-6 mt-3 mb-1">{{ config('shop.return_days') }} Tage Rückgabe</h3>
          <p class="text-muted small mb-0">Rücksendekosten übernehmen wir.</p>
        </div>
        <div class="col-md-3 col-6">
          <i class="feather-icon icon-headphones fs-3 text-primary"></i>
          <h3 class="fs-6 mt-3 mb-1">Persönliche Beratung</h3>
          <p class="text-muted small mb-0">Mo–Fr 9–18 Uhr, telefonisch und per E-Mail.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Einleitungstext (SEO) -->
  <section class="my-lg-12 my-8">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <h2 class="fs-4 mb-3">E-Roller und E-Scooter online kaufen</h2>
          <p class="text-muted">
            Ob Sie täglich zur Arbeit pendeln oder nur die letzte Meile zurücklegen möchten: Ein Elektrofahrzeug
            bringt Sie leise, günstig und ohne lokale Emissionen ans Ziel. Bei uns finden Sie ausschließlich
            E-Roller und E-Scooter – dafür mit vollständigen technischen Daten zu Reichweite, Motorleistung,
            Akkukapazität und zulässigem Gesamtgewicht, damit Sie in Ruhe vergleichen können.
          </p>
          <p class="text-muted mb-0">
            Jedes Fahrzeug wird vor dem Versand von uns aufgebaut, geprüft und Probe gefahren. Sie erhalten es
            fahrfertig geliefert – nicht als Bausatz. Welche Führerscheinklasse Sie für welches Modell benötigen
            und wie es um Versicherung und Zulassung steht, erklären wir in unseren
            <a href="{{ route('faq') }}">häufigen Fragen</a>.
          </p>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
