@extends('front.layouts.app')

@section('title', 'Impressum')
@section('meta_description', 'Impressum und Anbieterkennzeichnung gemäß § 5 TMG von ' . config('shop.legal_name') . '.')

@section('content')
<main>
  @include('front.partials.page-header', ['title' => 'Impressum', 'subtitle' => 'Angaben gemäß § 5 TMG'])

  <section class="py-lg-10 py-8">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">

          <h2 class="fs-5 mb-3">Anbieter</h2>
          <p class="text-muted mb-5">
            {{ config('shop.legal_name') }}<br>
            {{ config('shop.street') }}<br>
            {{ config('shop.zip') }} {{ config('shop.city') }}<br>
            {{ config('shop.country') }}
          </p>

          <h2 class="fs-5 mb-3">Vertreten durch</h2>
          <p class="text-muted mb-5">Geschäftsführer: {{ config('shop.ceo') }}</p>

          <h2 class="fs-5 mb-3">Kontakt</h2>
          <p class="text-muted mb-5">
            Telefon: {{ config('shop.phone') }}<br>
            E-Mail: <a href="mailto:{{ config('shop.email') }}">{{ config('shop.email') }}</a>
          </p>

          <h2 class="fs-5 mb-3">Registereintrag</h2>
          <p class="text-muted mb-5">
            Registergericht: {{ config('shop.register_court') }}<br>
            Registernummer: {{ config('shop.register_no') }}
          </p>

          <h2 class="fs-5 mb-3">Umsatzsteuer-Identifikationsnummer</h2>
          <p class="text-muted mb-5">
            Umsatzsteuer-Identifikationsnummer gemäß § 27 a Umsatzsteuergesetz:<br>
            {{ config('shop.vat_id') }}
          </p>

          <h2 class="fs-5 mb-3">Verantwortlich für den Inhalt nach § 18 Abs. 2 MStV</h2>
          <p class="text-muted mb-5">
            {{ config('shop.ceo') }}<br>
            {{ config('shop.street') }}, {{ config('shop.zip') }} {{ config('shop.city') }}
          </p>

          <h2 class="fs-5 mb-3">Online-Streitbeilegung</h2>
          <p class="text-muted mb-3">
            Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit:
            <a href="https://ec.europa.eu/consumers/odr" target="_blank" rel="noopener noreferrer">https://ec.europa.eu/consumers/odr</a>.
            Unsere E-Mail-Adresse finden Sie oben in diesem Impressum.
          </p>
          <p class="text-muted mb-5">
            Wir sind nicht bereit und nicht verpflichtet, an Streitbeilegungsverfahren vor einer
            Verbraucherschlichtungsstelle teilzunehmen.
          </p>

          <h2 class="fs-5 mb-3">Haftung für Inhalte</h2>
          <p class="text-muted mb-5">
            Als Diensteanbieter sind wir gemäß § 7 Abs. 1 TMG für eigene Inhalte auf diesen Seiten nach den
            allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10 TMG sind wir als Diensteanbieter jedoch nicht
            verpflichtet, übermittelte oder gespeicherte fremde Informationen zu überwachen oder nach Umständen
            zu forschen, die auf eine rechtswidrige Tätigkeit hinweisen.
          </p>

          <h2 class="fs-5 mb-3">Haftung für Links</h2>
          <p class="text-muted mb-5">
            Unser Angebot enthält Links zu externen Websites Dritter, auf deren Inhalte wir keinen Einfluss haben.
            Deshalb können wir für diese fremden Inhalte auch keine Gewähr übernehmen. Für die Inhalte der
            verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich.
          </p>

          <h2 class="fs-5 mb-3">Urheberrecht</h2>
          <p class="text-muted mb-0">
            Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen
            Urheberrecht. Die Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der
            Grenzen des Urheberrechtes bedürfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers.
          </p>

        </div>
      </div>
    </div>
  </section>
</main>
@endsection
