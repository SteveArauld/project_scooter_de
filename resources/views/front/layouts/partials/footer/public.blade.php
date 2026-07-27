<footer class="footer bg-light mt-lg-14 mt-8">
    <div class="container">
        <div class="row g-4 py-8">

            <!-- Marke -->
            <div class="col-lg-4 col-md-12">
                <img src="{{ asset('assets/images/logo/freshcart-logo.png') }}" alt="{{ config('shop.name') }}" height="46" class="mb-3" />
                <p class="text-muted">
                    Ihr Spezialist für Elektroroller und E-Scooter. Straßenzugelassen, geprüft und fahrfertig
                    geliefert – mit kostenlosem Versand in ganz Deutschland.
                </p>
                <ul class="list-unstyled text-muted small mb-3">
                    <li class="mb-1"><i class="feather-icon icon-map-pin me-2"></i>{{ config('shop.street') }}, {{ config('shop.zip') }} {{ config('shop.city') }}</li>
                    <li class="mb-1"><i class="feather-icon icon-phone me-2"></i><a href="tel:{{ preg_replace('/\s+/', '', config('shop.phone')) }}" class="text-muted text-decoration-none">{{ config('shop.phone') }}</a></li>
                    <li class="mb-1"><i class="feather-icon icon-mail me-2"></i><a href="mailto:{{ config('shop.email') }}" class="text-muted text-decoration-none">{{ config('shop.email') }}</a></li>
                </ul>
                <div class="d-flex gap-3 fs-5">
                    <a href="#!" class="text-muted" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#!" class="text-muted" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#!" class="text-muted" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            <!-- Kategorien -->
            <div class="col-lg-2 col-6 col-md-3">
                <h2 class="h6 mb-4">Sortiment</h2>
                <ul class="nav flex-column">
                    @foreach(\App\Models\Product::CATEGORIES as $cslug => $clabel)
                    <li class="nav-item mb-2"><a href="{{ route('categories.index', $cslug) }}" class="nav-link">{{ $clabel }}</a></li>
                    @endforeach
                    <li class="nav-item mb-2"><a href="{{ route('products.index') }}" class="nav-link">Alle Fahrzeuge</a></li>
                </ul>
            </div>

            <!-- Service -->
            <div class="col-lg-3 col-6 col-md-4">
                <h2 class="h6 mb-4">Kundenservice</h2>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="{{ route('about') }}" class="nav-link">Über uns</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('contact') }}" class="nav-link">Kontakt</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('faq') }}" class="nav-link">Häufige Fragen</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('shipping') }}" class="nav-link">Versand &amp; Rückgabe</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('payment') }}" class="nav-link">Zahlungsarten</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('warranty') }}" class="nav-link">Garantie</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('stores') }}" class="nav-link">Filialen</a></li>
                </ul>
            </div>

            <!-- Rechtliches -->
            <div class="col-lg-3 col-md-5">
                <h2 class="h6 mb-4">Rechtliches</h2>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="{{ route('imprint') }}" class="nav-link">Impressum</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('privacy') }}" class="nav-link">Datenschutz</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('terms') }}" class="nav-link">AGB</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('withdrawal') }}" class="nav-link">Widerrufsrecht</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('cookies') }}" class="nav-link">Cookie-Richtlinie</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('career') }}" class="nav-link">Karriere</a></li>
                </ul>
            </div>
        </div>

        <!-- Zahlungsarten & Versandpartner -->
        <div class="border-top py-5">
            @include('front.partials.payment-methods', [
                'title' => 'Unsere Zahlungsarten',
                'align' => 'center',
                'showLink' => true,
            ])

            <div class="mt-5">
                @include('front.partials.shipping-carriers', [
                    'title' => 'Unsere Versandpartner',
                    'align' => 'center',
                    'showLink' => true,
                ])
            </div>

            <ul class="list-unstyled d-flex flex-wrap gap-2 justify-content-center mt-5 mb-0">
                <li><span class="badge bg-white border text-dark fw-normal px-3 py-2"><i class="feather-icon icon-truck text-primary me-2"></i>Kostenloser Versand</span></li>
                <li><span class="badge bg-white border text-dark fw-normal px-3 py-2"><i class="feather-icon icon-shield text-primary me-2"></i>{{ config('shop.warranty_months') }} Monate Garantie</span></li>
                <li><span class="badge bg-white border text-dark fw-normal px-3 py-2"><i class="feather-icon icon-rotate-ccw text-primary me-2"></i>{{ config('shop.return_days') }} Tage Widerrufsrecht</span></li>
                <li><span class="badge bg-white border text-dark fw-normal px-3 py-2"><i class="feather-icon icon-lock text-primary me-2"></i>SSL-verschlüsselt</span></li>
            </ul>
        </div>

        <div class="border-top py-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <span class="small text-muted">&copy; {{ date('Y') }} {{ config('shop.legal_name') }} – Alle Rechte vorbehalten.</span>
                </div>
                <div class="col-md-6 text-md-end mt-2 mt-md-0">
                    <span class="small text-muted">
                        Alle Preise inkl. {{ config('shop.vat_rate') }} % MwSt. · Kostenloser Versand ·
                        {{ config('shop.warranty_months') }} Monate Garantie
                    </span>
                </div>
            </div>
        </div>
    </div>
</footer>
