<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />

    @php
        // Abschnittsinhalte kommen bereits HTML-kodiert zurück. Einmal dekodieren,
        // damit {{ }} anschließend genau einmal escaped (sonst wird aus "&" ein "&amp;amp;").
        $plain = fn ($value) => trim(html_entity_decode(strip_tags((string) $value), ENT_QUOTES, 'UTF-8'));

        $shopName  = config('shop.name');
        $pageTitle = $plain(View::yieldContent('title'));
        $fullTitle = $pageTitle !== '' ? $pageTitle . ' | ' . $shopName : $shopName;
        $metaDesc  = \Illuminate\Support\Str::limit(
            $plain(View::yieldContent('meta_description')) ?: config('shop.default_description'),
            300,
            ''
        );
        $canonical = View::yieldContent('canonical') ?: url()->current();
        $ogImage   = View::yieldContent('og_image') ?: url('/assets/images/slider/slide-1.jpg');
        $robots    = View::yieldContent('robots') ?: 'index, follow';
    @endphp

    <title>{{ $fullTitle }}</title>
    <meta name="description" content="{{ $metaDesc }}" />
    <meta name="robots" content="{{ $robots }}" />
    <link rel="canonical" href="{{ $canonical }}" />

    <!-- Open Graph / Social -->
    <meta property="og:type" content="{{ View::yieldContent('og_type') ?: 'website' }}" />
    <meta property="og:site_name" content="{{ $shopName }}" />
    <meta property="og:title" content="{{ $fullTitle }}" />
    <meta property="og:description" content="{{ $metaDesc }}" />
    <meta property="og:url" content="{{ $canonical }}" />
    <meta property="og:image" content="{{ $ogImage }}" />
    <meta property="og:locale" content="de_DE" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $fullTitle }}" />
    <meta name="twitter:description" content="{{ $metaDesc }}" />
    <meta name="twitter:image" content="{{ $ogImage }}" />

    <!-- Organisation (strukturierte Daten) -->
    @php
        $organizationLd = [
            '@context'  => 'https://schema.org',
            '@type'     => 'OnlineStore',
            'name'      => config('shop.name'),
            'url'       => url('/'),
            'logo'      => url('/assets/images/logo/freshcart-logo.png'),
            'email'     => config('shop.email'),
            'telephone' => config('shop.phone'),
            'address'   => [
                '@type'           => 'PostalAddress',
                'streetAddress'   => config('shop.street'),
                'postalCode'      => config('shop.zip'),
                'addressLocality' => config('shop.city'),
                'addressCountry'  => 'DE',
            ],
            'areaServed' => 'DE',
        ];
    @endphp
    <script type="application/ld+json">
        {!! json_encode($organizationLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>

    @stack('structured_data')

    <link href="/assets/libs/slick-carousel/slick/slick.css" rel="stylesheet" />
    <link href="/assets/libs/slick-carousel/slick/slick-theme.css" rel="stylesheet" />
    <link href="/assets/libs/tiny-slider/dist/tiny-slider.css" rel="stylesheet" />

 
    <link rel="shortcut icon" type="image/x-icon" href="/assets/images/favicon/favicon.ico">


    <link href="/assets/libs/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="/assets/libs/feather-webfont/dist/feather-icons.css" rel="stylesheet">
    <link href="/assets/libs/simplebar/dist/simplebar.min.css" rel="stylesheet">


    <link rel="stylesheet" href="/assets/css/theme.min.css">
    <link rel="stylesheet" href="/assets/css/custom.css">


    @stack('styles')
    <style>
      .whatsapp-float {
    position: fixed;
    right: 20px;
    bottom: 20px;
    z-index: 1040; /* unter Modals (1055), über dem Seiteninhalt */
    display: inline-flex;
    align-items: center;
    gap: 0;
    height: 56px;
    padding: 0 13px;
    border-radius: 28px;
    background-color: #25d366;
    color: #fff;
    text-decoration: none;
    box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4);
    transition: gap 0.25s ease, padding 0.25s ease, background-color 0.2s ease;
}

.whatsapp-float:hover,
.whatsapp-float:focus {
    background-color: #1da851;
    color: #fff;
    gap: 9px;
    padding-right: 22px;
}

.whatsapp-float:focus-visible {
    outline: 3px solid #0d6efd;
    outline-offset: 3px;
}

/* Beschriftung erscheint erst beim Überfahren */
.whatsapp-float__label {
    max-width: 0;
    overflow: hidden;
    white-space: nowrap;
    font-weight: 600;
    font-size: 0.95rem;
    opacity: 0;
    transition: max-width 0.25s ease, opacity 0.2s ease;
}

.whatsapp-float:hover .whatsapp-float__label,
.whatsapp-float:focus .whatsapp-float__label {
    max-width: 120px;
    opacity: 1;
}

/* Auf kleinen Bildschirmen nur das Symbol, etwas höher wegen Browserleisten */
@media (max-width: 575.98px) {
    .whatsapp-float {
        right: 16px;
        bottom: 16px;
        height: 52px;
        padding: 0 11px;
    }

    .whatsapp-float__label,
    .whatsapp-float:hover .whatsapp-float__label {
        display: none;
    }
}

@media (prefers-reduced-motion: reduce) {
    .whatsapp-float,
    .whatsapp-float__label {
        transition: none;
    }
}
    </style>

</head>

<body>

    @include('front.layouts.partials.navbar.public')

    <div id="main" class="wrapper">
        @yield('content')
    </div>

    @include('front.layouts.partials.footer.public')

    <!-- Schwebende WhatsApp-Schaltfläche -->
    @include('front.partials.whatsapp')

    <!-- Schnellansicht Modal (Template-Style) -->
    <div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body p-8">
            <div class="position-absolute top-0 end-0 me-3 mt-3">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Schließen"></button>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="border rounded p-4 text-center mb-3">
                  <img id="qvImage" src="" alt="" class="img-fluid" style="max-height:360px;object-fit:contain" />
                </div>
                <div class="row g-3" id="qvThumbnails"></div>
              </div>
              <div class="col-lg-6">
                <div class="ps-lg-8 mt-6 mt-lg-0">
                  <a href="#!" id="qvCategory" class="mb-3 d-block text-muted"></a>
                  <h2 class="mb-1 h3" id="qvTitle"></h2>
                  <div class="fs-3 fw-bold text-dark mb-1" id="qvPrice"></div>
                  <p class="text-muted small mb-2">inkl. MwSt., kostenloser Versand in Deutschland</p>
                  <p id="qvBrand" class="text-muted small mb-1"></p>
                  <p id="qvAvailability" class="text-success small mb-3"></p>
                  <p id="qvDesc" class="text-muted small mb-3"></p>
                  <hr class="my-4">
                  <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="input-group input-spinner" style="max-width:130px">
                      <input type="button" value="-" class="button-minus btn btn-sm border" onclick="var q=document.getElementById('qvQty');q.value=Math.max(1,(parseInt(q.value)||1)-1)">
                      <input type="number" min="1" value="1" id="qvQty" class="quantity-field form-control-sm form-input text-center border">
                      <input type="button" value="+" class="button-plus btn btn-sm border" onclick="var q=document.getElementById('qvQty');q.value=(parseInt(q.value)||1)+1">
                    </div>
                    <button type="button" class="btn btn-primary flex-grow-1" id="qvAddToCart"
                            data-add-to-cart data-qty-from-modal
                            data-added-label="<i class='bi bi-check-lg me-2'></i>Hinzugefügt">
                      <i class="feather-icon icon-shopping-bag me-2"></i>In den Warenkorb
                    </button>
                  </div>
                  <a href="#" class="btn btn-outline-dark w-100" id="qvDetails">Alle Details ansehen</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>




    <script src="/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/libs/simplebar/dist/simplebar.min.js"></script>

    <!-- Theme JS -->
    <script src="/assets/js/theme.min.js"></script>

    <script src="/assets/js/vendors/jquery.min.js"></script>
    <script src="/assets/js/vendors/countdown.js"></script>
    <script src="/assets/libs/slick-carousel/slick/slick.min.js"></script>
    <script src="/assets/js/vendors/slick-slider.js"></script>
    <script src="/assets/libs/tiny-slider/dist/min/tiny-slider.js"></script>
    <script src="/assets/js/vendors/tns-slider.js"></script>
    <script src="/assets/js/vendors/zoom.js"></script>
    <script src="/assets/js/vendors/validation.js"></script>
    <script src="/assets/js/cart.js"></script>
    @stack('scripts')
</body>


</html>