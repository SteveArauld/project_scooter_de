{{--
    Schlichter Seitenkopf für Informations- und Rechtsseiten.
    Erwartet: $title, optional $subtitle, optional $crumb (Zwischenebene).
--}}
<section class="border-bottom bg-white">
  <div class="container py-6">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-3 small">
        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-muted text-decoration-none">Startseite</a></li>
        @isset($crumb)
          <li class="breadcrumb-item"><a href="{{ $crumb['url'] }}" class="text-muted text-decoration-none">{{ $crumb['label'] }}</a></li>
        @endisset
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
      </ol>
    </nav>
    <h1 class="fs-2 fw-bold mb-1">{{ $title }}</h1>
    @isset($subtitle)
      <p class="text-muted mb-0">{{ $subtitle }}</p>
    @endisset
  </div>
</section>
