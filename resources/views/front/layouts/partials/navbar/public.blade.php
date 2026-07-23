<div class="border-bottom">
	<!-- BARRE DE NAVIGATION PRINCIPALE -->
	<div class="py-4">
		<div class="container">
			<div class="row w-100 align-items-center gx-lg-2 gx-0">
				
				<!-- LOGO -->
				<div class="col-xxl-2 col-lg-3 col-md-6 col-5">
					<a class="navbar-brand d-none d-lg-block" href="{{ route('home') }}">
						<img src="{{ asset('assets/images/logo/freshcart-logo.png') }}" alt="E-Roller Shop" height="50" />
					</a>
					<div class="d-flex justify-content-between w-100 d-lg-none">
						<a class="navbar-brand" href="{{ route('home') }}">
							<img src="{{ asset('assets/images/logo/freshcart-logo.png') }}" alt="E-Roller Shop" height="40" />
						</a>
					</div>
				</div>

				<!-- BARRE DE RECHERCHE -->
				<div class="col-xxl-5 col-lg-5 d-none d-lg-block">
					<form action="{{ route('products.index') }}" method="GET">
						<div class="input-group">
							<input class="form-control rounded" type="search" name="q" placeholder="Fahrzeug oder Zubehör suchen..." />
							<span class="input-group-append">
								<button class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end" type="submit">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
										<circle cx="11" cy="11" r="8"></circle>
										<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
									</svg>
								</button>
							</span>
						</div>
					</form>
				</div>

				<!-- LOCALISATION -->
				<div class="col-md-2 col-xxl-3 d-none d-lg-block">
				
				</div>

				<!-- ICÔNES UTILISATEUR / PANIER -->
				<div class="col-lg-2 col-xxl-2 text-end col-md-6 col-7">
					<div class="list-inline">
						
			

						<!-- Panier -->
						<div class="list-inline-item me-4 me-lg-0">
							<a class="text-muted position-relative" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" href="#!" role="button" aria-controls="offcanvasRight">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag">
									<path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
									<line x1="3" y1="6" x2="21" y2="6"></line>
									<path d="M16 10a4 4 0 0 1-8 0"></path>
								</svg>
								<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success" data-cart-count>0</span>
							</a>
						</div>

						<!-- Menu Mobile -->
						<div class="list-inline-item d-inline-block d-lg-none">
							<button class="navbar-toggler collapsed" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbar-default" aria-controls="navbar-default" aria-label="Toggle navigation">
								<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-text-indent-left text-primary" viewBox="0 0 16 16">
									<path d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm.646 2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708zM7 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
								</svg>
							</button>
						</div>

					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- MENU DE NAVIGATION PRINCIPAL -->
	<nav class="navbar navbar-expand-lg navbar-light navbar-default py-0 pb-lg-4" aria-label="Offcanvas navbar large">
		<div class="container">
			<div class="offcanvas offcanvas-start" tabindex="-1" id="navbar-default" aria-labelledby="navbar-defaultLabel">
				<div class="offcanvas-header pb-1">
					<a href="{{ route('home') }}">
						<img src="{{ asset('assets/images/logo/freshcart-logo.png') }}" alt="E-Roller Shop" height="40" />
					</a>
					<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
				</div>
				<div class="offcanvas-body">
					
					<!-- RECHERCHE MOBILE -->
					<div class="d-block d-lg-none mb-4">
						<form action="{{ route('products.index') }}" method="GET">
							<div class="input-group">
								<input class="form-control rounded" type="search" name="q" placeholder="Produkt suchen..." />
								<span class="input-group-append">
									<button class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end" type="submit">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
											<circle cx="11" cy="11" r="8"></circle>
											<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
										</svg>
									</button>
								</span>
							</div>
						</form>
						<div class="mt-2">
							<button type="button" class="btn btn-outline-gray-400 text-muted w-100" data-bs-toggle="modal" data-bs-target="#locationModal">
								<i class="feather-icon icon-map-pin me-2"></i>
								Standort wählen
							</button>
						</div>
					</div>

					<!-- BOUTON CATÉGORIES MOBILE -->
					<div class="d-block d-lg-none mb-4">
						<a class="btn btn-primary w-100 d-flex justify-content-center align-items-center" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
							<span class="me-2">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
									<rect x="3" y="3" width="7" height="7"></rect>
									<rect x="14" y="3" width="7" height="7"></rect>
									<rect x="14" y="14" width="7" height="7"></rect>
									<rect x="3" y="14" width="7" height="7"></rect>
								</svg>
							</span>
							Alle Kategorien
						</a>
						<div class="collapse mt-2" id="collapseExample">
							<div class="card card-body">
								<ul class="mb-0 list-unstyled">
									@foreach(\App\Models\Product::CATEGORIES as $cslug => $clabel)<li><a class="dropdown-item" href="{{ route('categories.index', $cslug) }}">{{ $clabel }}</a></li>@endforeach
								
								</ul>
							</div>
						</div>
					</div>

					<!-- BOUTON CATÉGORIES DESKTOP -->
					<div class="dropdown me-3 d-none d-lg-block">
						<button class="btn btn-primary px-6" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
							<span class="me-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
									<rect x="3" y="3" width="7" height="7"></rect>
									<rect x="14" y="3" width="7" height="7"></rect>
									<rect x="14" y="14" width="7" height="7"></rect>
									<rect x="3" y="14" width="7" height="7"></rect>
								</svg>
							</span>
							Alle Kategorien
						</button>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
							@foreach(\App\Models\Product::CATEGORIES as $cslug => $clabel)<li><a class="dropdown-item" href="{{ route('categories.index', $cslug) }}">{{ $clabel }}</a></li>@endforeach
								
						</ul>
					</div>

					<!-- MENU PRINCIPAL -->
					<div>
						<ul class="navbar-nav align-items-center">
							
							<!-- Accueil -->
							<li class="nav-item w-100 w-lg-auto">
								<a class="nav-link" href="{{ route('home') }}">Startseite</a>
							</li>

							<!-- Catégories -->
							<li class="nav-item dropdown w-100 w-lg-auto">
								<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Fahrzeuge</a>
								<ul class="dropdown-menu">
										@foreach(\App\Models\Product::CATEGORIES as $cslug => $clabel)<li><a class="dropdown-item" href="{{ route('categories.index', $cslug) }}">{{ $clabel }}</a></li>@endforeach
								
								</ul>
							</li>

						

							<!-- Contact -->
							<li class="nav-item w-100 w-lg-auto">
								<a class="nav-link" href="{{ route('contact') }}">Contact</a>
							</li>

							<!-- À propos -->
							<li class="nav-item w-100 w-lg-auto">
								<a class="nav-link" href="{{ route('about') }}">Über uns</a>
							</li>

						</ul>
					</div>

				</div>
			</div>
		</div>
	</nav>
</div>


<!-- Shop Cart -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
	<div class="offcanvas-header border-bottom">
		<div class="text-start">
			<h5 id="offcanvasRightLabel" class="mb-0 fs-4">Warenkorb</h5>
			<small class="text-muted">Kostenloser Versand in Deutschland</small>
		</div>
		<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Schließen"></button>
	</div>
	<div class="offcanvas-body">
		<ul class="list-group list-group-flush" data-cart-offcanvas-items></ul>
	</div>
	<div class="offcanvas-footer border-top p-4" data-cart-offcanvas-footer style="display:none">
		<div class="d-flex justify-content-between mb-3">
			<span class="fw-bold">Gesamt</span>
			<span class="fw-bold" data-cart-total>0,00 €</span>
		</div>
		<a href="{{ route('cart') }}" class="btn btn-outline-dark w-100 mb-2">Warenkorb ansehen</a>
		<a href="{{ route('checkout') }}" class="btn btn-primary w-100">Zur Kasse</a>
	</div>
</div>
