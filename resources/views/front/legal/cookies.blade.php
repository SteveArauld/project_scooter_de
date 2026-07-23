@extends('front.layouts.app')

@section('title', 'Cookie-Richtlinie')
@section('meta_description', 'Informationen zu den auf ' . config('shop.name') . ' eingesetzten Cookies – wir verwenden ausschließlich technisch notwendige Cookies.')

@section('content')
<main>
  @include('front.partials.page-header', [
    'title' => 'Cookie-Richtlinie',
    'subtitle' => 'Welche Cookies wir einsetzen und warum',
  ])

  <section class="py-lg-10 py-8">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">

          <h2 class="fs-5 mb-3">Was sind Cookies?</h2>
          <p class="text-muted mb-5">
            Cookies sind kleine Textdateien, die beim Besuch einer Website auf Ihrem Endgerät gespeichert werden.
            Sie richten auf Ihrem Gerät keinen Schaden an und enthalten keine Viren.
          </p>

          <h2 class="fs-5 mb-3">Welche Cookies wir verwenden</h2>
          <p class="text-muted mb-4">
            Wir setzen ausschließlich technisch notwendige Cookies ein. Diese sind für den Betrieb der Website
            und die Sicherheit Ihrer Sitzung erforderlich und bedürfen nach § 25 Abs. 2 TDDDG keiner
            Einwilligung. Wir nutzen <strong>kein</strong> Tracking, keine Werbe-Cookies und keine Analysedienste
            von Drittanbietern.
          </p>

          <div class="table-responsive mb-5">
            <table class="table table-bordered align-middle">
              <thead class="table-light">
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Zweck</th>
                  <th scope="col">Speicherdauer</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><code>laravel_session</code></td>
                  <td>Ordnet Ihre Anfragen Ihrer Sitzung zu und ermöglicht den Bestellvorgang.</td>
                  <td>Sitzungsende (max. 2 Stunden)</td>
                </tr>
                <tr>
                  <td><code>XSRF-TOKEN</code></td>
                  <td>Schützt Formulare vor Cross-Site-Request-Forgery-Angriffen.</td>
                  <td>Sitzungsende (max. 2 Stunden)</td>
                </tr>
              </tbody>
            </table>
          </div>

          <h2 class="fs-5 mb-3">Lokaler Speicher (localStorage)</h2>
          <p class="text-muted mb-5">
            Ihr Warenkorb wird nicht in einem Cookie, sondern im lokalen Speicher Ihres Browsers abgelegt
            (Schlüssel <code>cart</code>). Diese Daten verbleiben ausschließlich auf Ihrem Gerät und werden erst
            beim Absenden einer Bestellung an uns übertragen. Sie können den Warenkorb jederzeit leeren oder die
            Daten über die Einstellungen Ihres Browsers löschen.
          </p>

          <h2 class="fs-5 mb-3">Cookies verwalten</h2>
          <p class="text-muted mb-5">
            Sie können Ihren Browser so einstellen, dass Sie über das Setzen von Cookies informiert werden,
            Cookies nur im Einzelfall erlauben oder generell ausschließen. Bitte beachten Sie, dass bei der
            Deaktivierung der technisch notwendigen Cookies der Bestellvorgang nicht mehr funktioniert.
          </p>

          <h2 class="fs-5 mb-3">Weitere Informationen</h2>
          <p class="text-muted mb-0">
            Wie wir Ihre personenbezogenen Daten verarbeiten, erfahren Sie in unserer
            <a href="{{ route('privacy') }}">Datenschutzerklärung</a>.
          </p>

        </div>
      </div>
    </div>
  </section>
</main>
@endsection
