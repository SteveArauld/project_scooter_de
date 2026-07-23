@extends('front.layouts.app')

@php
  $title = $product->getTranslation('title', 'de');
  $desc = $product->getTranslation('description', 'de');
  $images = $product->imageUrls();
  if (empty($images)) { $images = [$product->main_image]; }
  $metaDesc = $product->plainDescription(300) ?: $title;
@endphp

@section('title', $title)
@section('meta_description', $metaDesc)
@section('canonical', route('products.show', $product->slug))
@section('og_type', 'product')
@section('og_image', url($product->main_image))

@push('structured_data')
@php
    $productLd = array_filter([
        '@context'    => 'https://schema.org',
        '@type'       => 'Product',
        'name'        => $title,
        'description' => $product->plainDescription(0) ?: $title,
        'image'       => array_map(fn ($i) => url($i), $images),
        'sku'         => $product->slug,
        'mpn'         => $product->mpn,
        'brand'       => $product->brand ? ['@type' => 'Brand', 'name' => $product->brand] : null,
        'category'    => $product->category_label,
        'offers'      => [
            '@type'           => 'Offer',
            'url'             => route('products.show', $product->slug),
            'priceCurrency'   => $product->currency ?: 'EUR',
            'price'           => number_format((float) $product->price, 2, '.', ''),
            'priceValidUntil' => now()->addYear()->format('Y-m-d'),
            'itemCondition'   => 'https://schema.org/NewCondition',
            'availability'    => $product->schema_availability,
            'seller'          => ['@type' => 'Organization', 'name' => config('shop.name')],
            'shippingDetails' => [
                '@type'        => 'OfferShippingDetails',
                'shippingRate' => [
                    '@type'    => 'MonetaryAmount',
                    'value'    => number_format((float) config('shop.shipping_cost'), 2, '.', ''),
                    'currency' => 'EUR',
                ],
                'shippingDestination' => [
                    '@type'          => 'DefinedRegion',
                    'addressCountry' => 'DE',
                ],
                'deliveryTime' => [
                    '@type'        => 'ShippingDeliveryTime',
                    'handlingTime' => ['@type' => 'QuantitativeValue', 'minValue' => 1, 'maxValue' => 2, 'unitCode' => 'DAY'],
                    'transitTime'  => ['@type' => 'QuantitativeValue', 'minValue' => 5, 'maxValue' => 8, 'unitCode' => 'DAY'],
                ],
            ],
            'hasMerchantReturnPolicy' => [
                '@type'                => 'MerchantReturnPolicy',
                'applicableCountry'    => 'DE',
                'returnPolicyCategory' => 'https://schema.org/MerchantReturnFiniteReturnWindow',
                'merchantReturnDays'   => (int) config('shop.return_days'),
                'returnMethod'         => 'https://schema.org/ReturnByMail',
                'returnFees'           => 'https://schema.org/FreeReturn',
            ],
        ],
    ]);

    $breadcrumbLd = [
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Startseite', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => $product->category_label, 'item' => route('categories.index', $product->category)],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $title],
        ],
    ];
@endphp
<script type="application/ld+json">
    {!! json_encode($productLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
<script type="application/ld+json">
    {!! json_encode($breadcrumbLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush

@section('content')
<main>
  <div class="mt-4">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Startseite</a></li>
          <li class="breadcrumb-item"><a href="{{ route('categories.index', $product->category) }}">{{ $product->category_label }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ \Illuminate\Support\Str::limit($title, 40) }}</li>
        </ol>
      </nav>
    </div>
  </div>

  <section class="mt-8">
    <div class="container">
      <div class="row">
        <!-- Galerie -->
        <div class="col-md-6">
          <div class="mb-3 text-center border rounded p-4">
            <img id="mainImage" src="{{ $images[0] }}" alt="{{ $title }}" class="img-fluid" style="max-height:420px;object-fit:contain" />
          </div>
          <div class="row g-2">
            @foreach($images as $img)
            <div class="col-3">
              <div class="border rounded p-2 thumb-select" style="cursor:pointer" onclick="document.getElementById('mainImage').src='{{ $img }}'">
                <img src="{{ $img }}" alt="" class="img-fluid" style="height:70px;object-fit:contain;width:100%" />
              </div>
            </div>
            @endforeach
          </div>
        </div>

        <!-- Infos -->
        <div class="col-md-6">
          <div class="ps-lg-8 mt-6 mt-md-0">
            <span class="mb-2 d-block text-muted">{{ $product->category_label }}</span>
            <h1 class="mb-2 fs-2">{{ $title }}</h1>
            @if($product->brand)<p class="text-muted mb-3">Marke: <strong>{{ $product->brand }}</strong></p>@endif

            <div class="fs-3 mb-3">
              <span class="fw-bold text-dark">{{ number_format((float) $product->price, 2, ',', '.') }} €</span>
              <span class="fs-6 text-muted ms-2">inkl. MwSt.</span>
            </div>

            @if($product->availability)
            <p class="text-success mb-4"><i class="bi bi-check-circle-fill me-1"></i>{{ $product->availability }}</p>
            @endif

            <hr class="my-5" />

            <div class="d-flex align-items-center gap-3 mb-4">
              <div class="input-group input-spinner" style="max-width:140px">
                <input type="button" value="-" class="button-minus btn btn-sm border" onclick="var q=document.querySelector('[data-qty-input]');q.value=Math.max(1,(parseInt(q.value)||1)-1)" />
                <input type="number" min="1" value="1" data-qty-input class="quantity-field form-control-sm form-input text-center border" />
                <input type="button" value="+" class="button-plus btn btn-sm border" onclick="var q=document.querySelector('[data-qty-input]');q.value=(parseInt(q.value)||1)+1" />
              </div>
              <button type="button" class="btn btn-primary flex-grow-1"
                      data-add-to-cart data-qty-from-input data-open-cart
                      data-slug="{{ $product->slug }}"
                      data-title="{{ $title }}"
                      data-price="{{ $product->price }}"
                      data-image="{{ $product->main_image }}"
                      data-url="{{ route('products.show', $product->slug) }}"
                      data-added-label="<i class='bi bi-check-lg me-2'></i>Hinzugefügt">
                <i class="feather-icon icon-shopping-bag me-2"></i>In den Warenkorb
              </button>
            </div>

            <a href="{{ route('cart') }}" class="btn btn-outline-dark w-100 mb-4">Zum Warenkorb</a>

            <table class="table table-borderless mb-0">
              <tbody>
                @if($product->reference)
                <tr><td class="ps-0 text-muted">Produktnummer:</td><td>{{ $product->reference }}</td></tr>
                @endif
                <tr><td class="ps-0 text-muted">Kategorie:</td><td>{{ $product->category_label }}</td></tr>
                <tr><td class="ps-0 text-muted">Versand:</td><td>Kostenloser Versand in Deutschland</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Tabs -->
  <section class="mt-lg-14 mt-8">
    <div class="container">
      <ul class="nav nav-pills nav-lb-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#desc-pane" type="button" role="tab">Beschreibung</button>
        </li>
        @if($product->specifications)
        <li class="nav-item" role="presentation">
          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#spec-pane" type="button" role="tab">Technische Daten</button>
        </li>
        @endif
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active py-6" id="desc-pane" role="tabpanel">
          @if(!empty($product->description_html))
            <div class="product-description">{!! $product->description_html !!}</div>
          @else
            <p style="white-space:pre-line">{{ $desc }}</p>
          @endif
        </div>
        @if($product->specifications)
        <div class="tab-pane fade py-6" id="spec-pane" role="tabpanel">
          <div class="row">
            <div class="col-lg-8">
              <table class="table table-striped">
                <tbody>
                  @foreach($product->specifications as $key => $value)
                    @if(trim((string) $value) !== '')
                    <tr><th style="width:40%">{{ rtrim($key, ':') }}</th><td>{{ $value }}</td></tr>
                    @endif
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>
  </section>

  <!-- Ähnliche Produkte -->
  @if($related->count())
  <section class="my-lg-14 my-10">
    <div class="container">
      <h3 class="mb-6">Ähnliche Fahrzeuge</h3>
      <div class="row g-4 row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-2">
        @foreach($related as $product)
          @include('front.partials.product-card', ['product' => $product])
        @endforeach
      </div>
    </div>
  </section>
  @endif
</main>
@endsection
