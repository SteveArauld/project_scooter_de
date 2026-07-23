@extends('front.layouts.app')

@section('title', 'Datenschutzerklärung')
@section('meta_description', 'Informationen zur Verarbeitung Ihrer personenbezogenen Daten nach der Datenschutz-Grundverordnung (DSGVO) bei ' . config('shop.name') . '.')

@section('content')
<main>
  @include('front.partials.page-header', [
    'title' => 'Datenschutzerklärung',
    'subtitle' => 'Informationen zur Verarbeitung Ihrer Daten nach Art. 13 DSGVO',
  ])

  <section class="py-lg-10 py-8">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">

          <h2 class="fs-5 mb-3">1. Verantwortlicher</h2>
          <p class="text-muted mb-5">
            Verantwortlich für die Datenverarbeitung auf dieser Website ist:<br>
            {{ config('shop.legal_name') }}, {{ config('shop.street') }},
            {{ config('shop.zip') }} {{ config('shop.city') }}<br>
            E-Mail: <a href="mailto:{{ config('shop.email') }}">{{ config('shop.email') }}</a>,
            Telefon: {{ config('shop.phone') }}
          </p>

          <h2 class="fs-5 mb-3">2. Grundsatz</h2>
          <p class="text-muted mb-5">
            Wir verarbeiten personenbezogene Daten ausschließlich auf Grundlage der gesetzlichen Bestimmungen
            (DSGVO, BDSG, TDDDG). Personenbezogene Daten sind alle Daten, mit denen Sie persönlich identifiziert
            werden können. Wir erheben nur die Daten, die für den jeweiligen Zweck erforderlich sind.
          </p>

          <h2 class="fs-5 mb-3">3. Aufruf unserer Website (Server-Logfiles)</h2>
          <p class="text-muted mb-3">
            Beim Aufruf unserer Website werden automatisch Informationen an unseren Server übermittelt und
            temporär in sogenannten Logfiles gespeichert: IP-Adresse, Datum und Uhrzeit des Zugriffs, aufgerufene
            Seite, übertragene Datenmenge, verwendeter Browser und Betriebssystem.
          </p>
          <p class="text-muted mb-5">
            <strong>Zweck und Rechtsgrundlage:</strong> Die Verarbeitung dient dem sicheren und stabilen Betrieb
            der Website. Rechtsgrundlage ist Art. 6 Abs. 1 lit. f DSGVO (berechtigtes Interesse).
            <strong>Speicherdauer:</strong> Die Logfiles werden nach spätestens 30 Tagen gelöscht.
          </p>

          <h2 class="fs-5 mb-3">4. Warenkorb (lokale Speicherung)</h2>
          <p class="text-muted mb-5">
            Ihr Warenkorb wird ausschließlich lokal in Ihrem Browser gespeichert (localStorage). Diese Daten
            werden nicht an uns übertragen, solange Sie keine Bestellung abschicken. Sie können den Warenkorb
            jederzeit selbst leeren oder die Daten über die Einstellungen Ihres Browsers löschen.
            Rechtsgrundlage ist Art. 6 Abs. 1 lit. f DSGVO (Bereitstellung der Shop-Funktion).
          </p>

          <h2 class="fs-5 mb-3">5. Bestellung</h2>
          <p class="text-muted mb-3">
            Wenn Sie eine Bestellung aufgeben, erheben wir folgende Daten: Vor- und Nachname, E-Mail-Adresse,
            Telefonnummer, Lieferanschrift (Straße, Postleitzahl, Ort, Land) sowie die bestellten Artikel.
          </p>
          <p class="text-muted mb-5">
            <strong>Zweck und Rechtsgrundlage:</strong> Diese Daten benötigen wir zur Bearbeitung und Auslieferung
            Ihrer Bestellung sowie zur Zusendung der Bestellbestätigung. Rechtsgrundlage ist
            Art. 6 Abs. 1 lit. b DSGVO (Vertragserfüllung).
            <strong>Speicherdauer:</strong> Wir speichern diese Daten für die Dauer der Geschäftsbeziehung und
            darüber hinaus im Rahmen der handels- und steuerrechtlichen Aufbewahrungsfristen
            (in der Regel 6 bzw. 10 Jahre gemäß § 257 HGB, § 147 AO).
          </p>

          <h2 class="fs-5 mb-3">6. Kontaktaufnahme</h2>
          <p class="text-muted mb-5">
            Wenn Sie uns über das Kontaktformular oder per E-Mail kontaktieren, verarbeiten wir Ihre Angaben zur
            Bearbeitung Ihrer Anfrage. Rechtsgrundlage ist Art. 6 Abs. 1 lit. b DSGVO bei vertragsbezogenen
            Anfragen, ansonsten Art. 6 Abs. 1 lit. f DSGVO. Ihre Anfrage wird gelöscht, sobald sie abschließend
            bearbeitet ist und keine gesetzlichen Aufbewahrungspflichten entgegenstehen.
          </p>

          <h2 class="fs-5 mb-3">7. E-Mail-Versand</h2>
          <p class="text-muted mb-5">
            Zur Zustellung von Bestellbestätigungen setzen wir einen E-Mail-Dienstleister ein, der Ihre Daten
            weisungsgebunden im Rahmen einer Auftragsverarbeitung nach Art. 28 DSGVO verarbeitet.
          </p>

          <h2 class="fs-5 mb-3">8. Cookies</h2>
          <p class="text-muted mb-5">
            Wir setzen ausschließlich technisch notwendige Cookies ein, die für den Betrieb der Website und die
            Sicherheit Ihrer Sitzung erforderlich sind (z. B. Sitzungs-Cookie und CSRF-Schutz). Diese Cookies
            bedürfen keiner Einwilligung (§ 25 Abs. 2 TDDDG). Weitere Informationen finden Sie in unserer
            <a href="{{ route('cookies') }}">Cookie-Richtlinie</a>.
          </p>

          <h2 class="fs-5 mb-3">9. Ihre Rechte</h2>
          <p class="text-muted mb-3">Ihnen stehen als betroffene Person folgende Rechte zu:</p>
          <ul class="text-muted mb-3">
            <li>Auskunft über die zu Ihrer Person gespeicherten Daten (Art. 15 DSGVO)</li>
            <li>Berichtigung unrichtiger Daten (Art. 16 DSGVO)</li>
            <li>Löschung Ihrer Daten (Art. 17 DSGVO)</li>
            <li>Einschränkung der Verarbeitung (Art. 18 DSGVO)</li>
            <li>Datenübertragbarkeit (Art. 20 DSGVO)</li>
            <li>Widerspruch gegen die Verarbeitung (Art. 21 DSGVO)</li>
            <li>Widerruf einer erteilten Einwilligung mit Wirkung für die Zukunft (Art. 7 Abs. 3 DSGVO)</li>
          </ul>
          <p class="text-muted mb-5">
            Zur Ausübung Ihrer Rechte genügt eine Nachricht an
            <a href="mailto:{{ config('shop.email') }}">{{ config('shop.email') }}</a>.
          </p>

          <h2 class="fs-5 mb-3">10. Beschwerderecht bei der Aufsichtsbehörde</h2>
          <p class="text-muted mb-5">
            Sie haben das Recht, sich bei einer Datenschutz-Aufsichtsbehörde über die Verarbeitung Ihrer
            personenbezogenen Daten zu beschweren. Zuständig ist die Aufsichtsbehörde Ihres gewöhnlichen
            Aufenthaltsortes oder unseres Unternehmenssitzes.
          </p>

          <h2 class="fs-5 mb-3">11. Datensicherheit</h2>
          <p class="text-muted mb-5">
            Wir verwenden eine SSL/TLS-Verschlüsselung, um die Übertragung Ihrer Daten zu schützen. Eine
            verschlüsselte Verbindung erkennen Sie an der Adresszeile Ihres Browsers („https://“) und am
            Schloss-Symbol.
          </p>

          <h2 class="fs-5 mb-3">12. Aktualität dieser Erklärung</h2>
          <p class="text-muted mb-0">
            Diese Datenschutzerklärung ist aktuell gültig. Durch die Weiterentwicklung unserer Website oder
            aufgrund geänderter gesetzlicher Vorgaben kann es notwendig werden, sie anzupassen.
          </p>

        </div>
      </div>
    </div>
  </section>
</main>
@endsection
