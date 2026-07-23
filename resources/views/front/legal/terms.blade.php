@extends('front.layouts.app')

@section('title', 'Allgemeine Geschäftsbedingungen')
@section('meta_description', 'Allgemeine Geschäftsbedingungen (AGB) für den Kauf von E-Rollern und E-Scootern bei ' . config('shop.name') . '.')

@section('content')
<main>
  @include('front.partials.page-header', [
    'title' => 'Allgemeine Geschäftsbedingungen',
    'subtitle' => 'AGB für Bestellungen über ' . config('shop.name'),
  ])

  <section class="py-lg-10 py-8">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">

          <h2 class="fs-5 mb-3">§ 1 Geltungsbereich</h2>
          <p class="text-muted mb-5">
            Für alle Bestellungen über unseren Onlineshop gelten die nachfolgenden Allgemeinen
            Geschäftsbedingungen in der zum Zeitpunkt der Bestellung gültigen Fassung. Vertragspartner ist
            {{ config('shop.legal_name') }}, {{ config('shop.street') }}, {{ config('shop.zip') }} {{ config('shop.city') }}.
            Abweichende Bedingungen des Kunden werden nicht Vertragsbestandteil, es sei denn, wir stimmen ihrer
            Geltung ausdrücklich schriftlich zu.
          </p>

          <h2 class="fs-5 mb-3">§ 2 Vertragspartner und Vertragsschluss</h2>
          <p class="text-muted mb-3">
            Die Darstellung der Produkte im Onlineshop stellt kein rechtlich bindendes Angebot, sondern eine
            unverbindliche Aufforderung zur Bestellung dar.
          </p>
          <p class="text-muted mb-5">
            Mit dem Absenden der Bestellung über die Schaltfläche „Zahlungspflichtig bestellen“ geben Sie eine
            verbindliche Bestellung ab. Der Eingang Ihrer Bestellung wird Ihnen unverzüglich per E-Mail bestätigt.
            Diese Eingangsbestätigung stellt noch keine Annahme des Vertragsangebots dar. Der Kaufvertrag kommt
            zustande, sobald wir die Bestellung ausdrücklich annehmen oder die Ware versenden.
          </p>

          <h2 class="fs-5 mb-3">§ 3 Preise und Versandkosten</h2>
          <p class="text-muted mb-3">
            Alle angegebenen Preise sind Endpreise in Euro und enthalten die gesetzliche Mehrwertsteuer von
            {{ config('shop.vat_rate') }} %.
          </p>
          <p class="text-muted mb-5">
            Der Versand innerhalb Deutschlands ist für Sie kostenfrei. Es fallen keine zusätzlichen Liefer- oder
            Versandkosten an. Weitere Einzelheiten finden Sie auf der Seite
            <a href="{{ route('shipping') }}">Versand und Rückgabe</a>.
          </p>

          <h2 class="fs-5 mb-3">§ 4 Zahlungsbedingungen</h2>
          <p class="text-muted mb-5">
            Die verfügbaren Zahlungsarten werden Ihnen im Bestellprozess angezeigt und sind auf der Seite
            <a href="{{ route('payment') }}">Zahlungsarten</a> beschrieben. Bei Zahlung auf Rechnung ist der
            Rechnungsbetrag ohne Abzug innerhalb von 14 Tagen ab Rechnungsdatum fällig. Gerät der Kunde in
            Zahlungsverzug, sind wir berechtigt, Verzugszinsen in gesetzlicher Höhe zu berechnen.
          </p>

          <h2 class="fs-5 mb-3">§ 5 Lieferung</h2>
          <p class="text-muted mb-5">
            Die Lieferung erfolgt innerhalb Deutschlands an die von Ihnen angegebene Lieferanschrift. Die
            übliche Lieferzeit beträgt {{ config('shop.delivery_days') }} nach Vertragsschluss, sofern beim
            jeweiligen Produkt nichts anderes angegeben ist. Fahrzeuge werden per Spedition zugestellt. Sollte
            ein bestellter Artikel nicht verfügbar sein, informieren wir Sie unverzüglich und erstatten bereits
            geleistete Zahlungen ohne schuldhaftes Zögern zurück.
          </p>

          <h2 class="fs-5 mb-3">§ 6 Eigentumsvorbehalt</h2>
          <p class="text-muted mb-5">
            Die gelieferte Ware bleibt bis zur vollständigen Bezahlung unser Eigentum.
          </p>

          <h2 class="fs-5 mb-3">§ 7 Widerrufsrecht</h2>
          <p class="text-muted mb-5">
            Verbrauchern steht ein gesetzliches Widerrufsrecht von {{ config('shop.return_days') }} Tagen zu.
            Die Einzelheiten entnehmen Sie bitte unserer
            <a href="{{ route('withdrawal') }}">Widerrufsbelehrung</a>.
          </p>

          <h2 class="fs-5 mb-3">§ 8 Gewährleistung und Garantie</h2>
          <p class="text-muted mb-5">
            Es gelten die gesetzlichen Gewährleistungsrechte. Die Gewährleistungsfrist für neue Waren beträgt
            zwei Jahre ab Erhalt der Ware. Zusätzlich gewähren wir auf unsere Fahrzeuge eine Herstellergarantie
            von {{ config('shop.warranty_months') }} Monaten. Einzelheiten finden Sie auf der Seite
            <a href="{{ route('warranty') }}">Garantie</a>. Die gesetzlichen Gewährleistungsrechte werden durch
            die Garantie nicht eingeschränkt.
          </p>

          <h2 class="fs-5 mb-3">§ 9 Straßenzulassung und Nutzung</h2>
          <p class="text-muted mb-5">
            Für die Teilnahme am öffentlichen Straßenverkehr sind je nach Fahrzeugtyp eine Versicherung
            (Versicherungskennzeichen) sowie eine entsprechende Fahrerlaubnis erforderlich. Die Angaben zur
            Zulassung finden Sie in der jeweiligen Produktbeschreibung. Der Kunde ist selbst dafür
            verantwortlich, die für sein Fahrzeug geltenden gesetzlichen Vorschriften einzuhalten.
          </p>

          <h2 class="fs-5 mb-3">§ 10 Haftung</h2>
          <p class="text-muted mb-5">
            Wir haften uneingeschränkt bei Vorsatz und grober Fahrlässigkeit sowie bei der Verletzung von Leben,
            Körper oder Gesundheit. Bei leichter Fahrlässigkeit haften wir nur bei Verletzung einer wesentlichen
            Vertragspflicht und begrenzt auf den vertragstypischen, vorhersehbaren Schaden. Im Übrigen ist die
            Haftung ausgeschlossen. Die Haftung nach dem Produkthaftungsgesetz bleibt unberührt.
          </p>

          <h2 class="fs-5 mb-3">§ 11 Streitbeilegung</h2>
          <p class="text-muted mb-5">
            Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung bereit:
            <a href="https://ec.europa.eu/consumers/odr" target="_blank" rel="noopener noreferrer">https://ec.europa.eu/consumers/odr</a>.
            Wir sind nicht bereit und nicht verpflichtet, an Streitbeilegungsverfahren vor einer
            Verbraucherschlichtungsstelle teilzunehmen.
          </p>

          <h2 class="fs-5 mb-3">§ 12 Schlussbestimmungen</h2>
          <p class="text-muted mb-0">
            Es gilt das Recht der Bundesrepublik Deutschland unter Ausschluss des UN-Kaufrechts. Zwingende
            Verbraucherschutzvorschriften des Staates, in dem der Verbraucher seinen gewöhnlichen Aufenthalt hat,
            bleiben unberührt. Sollten einzelne Bestimmungen dieser AGB unwirksam sein, bleibt die Wirksamkeit
            der übrigen Bestimmungen davon unberührt.
          </p>

        </div>
      </div>
    </div>
  </section>
</main>
@endsection
