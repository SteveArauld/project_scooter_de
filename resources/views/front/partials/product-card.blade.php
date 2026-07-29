@php
  $t = $product->getTranslation('title', 'de');
@endphp
<div class="col">
  <div class="card card-product h-100">
    <div class="card-body">
      <div class="text-center position-relative">
        @if($product->on_sale)
          <div class="position-absolute top-0 start-0"><span class="badge bg-danger">Angebot</span></div>
        @endif
        @if($product->is_preorder)
          <div class="position-absolute top-0 end-0">
            <span class="badge bg-warning text-dark"><i class="feather-icon icon-clock me-1"></i>Vorbestellung</span>
          </div>
        @endif
        <a href="{{ route('products.show', $product->slug) }}">
          <img src="{{ $product->main_image }}" alt="{{ $t }}" class="mb-3 img-fluid" style="height:180px;object-fit:contain" loading="lazy" />
        </a>
        <div class="card-product-action">
          <a href="#!" class="btn-action" title="Schnellansicht"
             data-quick-view
             data-slug="{{ $product->slug }}"
             data-title="{{ $t }}"
             data-price="{{ number_format((float) $product->price, 2, ',', '.') }} €"
             data-price-raw="{{ $product->price }}"
             data-image="{{ $product->main_image }}"
             data-category="{{ $product->category_label }}"
             data-brand="{{ $product->brand }}"
             data-availability="{{ $product->availability }}"
             data-url="{{ route('products.show', $product->slug) }}"><i class="bi bi-eye"></i></a>
        </div>
      </div>
      <div class="text-small mb-1">
        <span class="text-muted"><small>{{ $product->category_label }}</small></span>
      </div>
      <h2 class="fs-6">
        <a href="{{ route('products.show', $product->slug) }}" class="text-inherit text-decoration-none">{{ \Illuminate\Support\Str::limit($t, 55) }}</a>
      </h2>
      @if($product->brand)
      <div class="mb-2"><small class="text-muted">{{ $product->brand }}</small></div>
      @endif
      <div class="d-flex justify-content-between align-items-center mt-3">
        <div>
          <span class="text-dark fw-bold">{{ number_format((float) $product->price, 2, ',', '.') }} €</span>
          @if($product->is_preorder)
          <div><small class="text-warning-emphasis">Erscheint am {{ $product->release_date->translatedFormat('j. F Y') }}</small></div>
          @else
          <div><small class="text-muted">inkl. MwSt., kostenloser Versand</small></div>
          @endif
        </div>
        @if($product->is_preorder)
        {{-- Vorbestellung: kein direkter "Kaufen"-Button, sondern Weg zur Produktseite --}}
        <a href="{{ route('products.show', $product->slug) }}" class="btn btn-outline-warning btn-sm text-nowrap">
          <i class="feather-icon icon-clock"></i> Vorbestellen
        </a>
        @else
        <button type="button" class="btn btn-primary btn-sm"
                data-add-to-cart
                data-slug="{{ $product->slug }}"
                data-title="{{ $t }}"
                data-price="{{ $product->price }}"
                data-image="{{ $product->main_image }}"
                data-url="{{ route('products.show', $product->slug) }}"
                data-added-label="<i class='bi bi-check-lg'></i>">
          <i class="feather-icon icon-plus"></i> Kaufen
        </button>
        @endif
      </div>
    </div>
  </div>
</div>
