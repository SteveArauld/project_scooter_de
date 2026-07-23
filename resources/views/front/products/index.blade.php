@extends('front.layouts.app')

@section('title', 'Alle E-Roller & E-Scooter')

@section('content')
<main>
  <div class="mt-4">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Startseite</a></li>
              <li class="breadcrumb-item active" aria-current="page">Shop</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>

  <div class="mt-6 mb-lg-14 mb-8">
    <div class="container">
      <div class="row gx-6">
        <!-- Sidebar Filter -->
        <aside class="col-lg-3 col-md-4 mb-6 mb-md-0">
          <form action="{{ route('products.index') }}" method="GET">
            <input type="hidden" name="sort" value="{{ request('sort') }}">
            <div class="mb-6">
              <h5 class="mb-3">Suche</h5>
              <input type="search" name="q" value="{{ request('q') }}" class="form-control" placeholder="Modell, Marke ..." />
            </div>
            <div class="mb-6">
              <h5 class="mb-3">Kategorien</h5>
              <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="category" value="" id="cat-all" {{ request('category') ? '' : 'checked' }} onchange="this.form.submit()">
                <label class="form-check-label d-flex justify-content-between" for="cat-all">
                  <span>Alle anzeigen</span>
                  <span class="text-muted small">{{ $categoryCounts->sum() }}</span>
                </label>
              </div>
              @foreach($categories as $slug => $label)
              <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="category" value="{{ $slug }}" id="cat-{{ $slug }}" {{ request('category') === $slug ? 'checked' : '' }} onchange="this.form.submit()">
                <label class="form-check-label d-flex justify-content-between" for="cat-{{ $slug }}">
                  <span>{{ $label }}</span>
                  <span class="text-muted small">{{ $categoryCounts[$slug] ?? 0 }}</span>
                </label>
              </div>
              @endforeach
            </div>

            <div class="mb-6">
              <h5 class="mb-3">Artikelart</h5>
              <select name="subcategory" class="form-select" onchange="this.form.submit()">
                <option value="">Alle Artikelarten</option>
                @foreach($subcategories as $slug => $label)
                <option value="{{ $slug }}" {{ request('subcategory') === $slug ? 'selected' : '' }}>
                  {{ $label }} ({{ $subcategoryCounts[$slug] ?? 0 }})
                </option>
                @endforeach
              </select>
            </div>

            <div class="mb-6">
              <h5 class="mb-3">Marke</h5>
              <select name="brand" class="form-select" onchange="this.form.submit()">
                <option value="">Alle Marken</option>
                @foreach($brands as $brand => $n)
                <option value="{{ $brand }}" {{ request('brand') === (string) $brand ? 'selected' : '' }}>{{ $brand }} ({{ $n }})</option>
                @endforeach
              </select>
            </div>

            <div class="mb-6">
              <h5 class="mb-3">Angebote</h5>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="sale" value="1" id="f-sale" {{ request()->boolean('sale') ? 'checked' : '' }} onchange="this.form.submit()">
                <label class="form-check-label" for="f-sale">Nur Aktionsartikel</label>
              </div>
            </div>

            <div class="mb-6">
              <h5 class="mb-3">Preis (€)</h5>
              <div class="d-flex gap-2">
                <input type="number" name="min" value="{{ request('min') }}" class="form-control" placeholder="Min" min="0" />
                <input type="number" name="max" value="{{ request('max') }}" class="form-control" placeholder="Max" min="0" />
              </div>
              <button type="submit" class="btn btn-outline-dark btn-sm mt-3 w-100">Filtern</button>
              @if(request()->hasAny(['q','category','subcategory','brand','sale','min','max']))
              <a href="{{ route('products.index') }}" class="btn btn-link btn-sm w-100 mt-1 text-muted">Filter zurücksetzen</a>
              @endif
            </div>
          </form>
        </aside>

        <!-- Liste -->
        <section class="col-lg-9 col-md-8">
          <div class="card mb-4 bg-light border-0">
            <div class="card-body p-6">
              <h2 class="mb-0 fs-3">{{ request('category') ? ($categories[request('category')] ?? 'Shop') : 'Alle Fahrzeuge' }}</h2>
            </div>
          </div>

          <div class="d-md-flex justify-content-between align-items-center mb-4">
            <p class="mb-2 mb-md-0"><span class="text-dark fw-bold">{{ $products->total() }}</span> Produkte gefunden</p>
            <form action="{{ route('products.index') }}" method="GET" class="d-flex align-items-center">
              @foreach(['q','category','subcategory','brand','sale','min','max'] as $keep)
                @if(request($keep))<input type="hidden" name="{{ $keep }}" value="{{ request($keep) }}">@endif
              @endforeach
              <label class="me-2 text-muted small">Sortieren:</label>
              <select name="sort" class="form-select" onchange="this.form.submit()">
                <option value="" {{ request('sort') ? '' : 'selected' }}>Neueste</option>
                <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Preis: aufsteigend</option>
                <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Preis: absteigend</option>
                <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Name (A–Z)</option>
              </select>
            </form>
          </div>

          @if($products->count())
          <div class="row g-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-1 row-cols-2 mt-2">
            @foreach($products as $product)
              @include('front.partials.product-card', ['product' => $product])
            @endforeach
          </div>
          <div class="row mt-8">
            <div class="col">
              {{ $products->links() }}
            </div>
          </div>
          @else
          <div class="text-center py-12">
            <i class="feather-icon icon-search fs-1 text-muted"></i>
            <h4 class="mt-4">Keine Produkte gefunden</h4>
            <p class="text-muted">Bitte passen Sie Ihre Filter an.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Alle Produkte anzeigen</a>
          </div>
          @endif
        </section>
      </div>
    </div>
  </div>
</main>
@endsection
