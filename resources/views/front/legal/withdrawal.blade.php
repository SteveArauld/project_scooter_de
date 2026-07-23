@extends('front.layouts.app')

@section('title', 'Widerrufsrecht')
@section('meta_description', 'Widerrufsbelehrung und Muster-Widerrufsformular für Verbraucher – 14 Tage Widerrufsrecht bei ' . config('shop.name') . '.')

@section('content')
<main>
  @include('front.partials.page-header', [
    'title' => 'Widerrufsbelehrung',
    'subtitle' => 'Ihr gesetzliches Widerrufsrecht als Verbraucher',
  ])

  <section class="py-lg-10 py-8">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">

          <h2 class="fs-5 mb-3">Widerrufsrecht</h2>
          <p class="text-muted mb-3">
            Sie haben das Recht, binnen {{ config('shop.return_days') }} Tagen ohne Angabe von Gründen diesen
            Vertrag zu widerrufen.
          </p>
          <p class="text-muted mb-5">
            Die Widerrufsfrist beträgt {{ config('shop.return_days') }} Tage ab dem Tag, an dem Sie oder ein von
            Ihnen benannter Dritter, der nicht der Beförderer ist, die Waren in Besitz genommen haben bzw. hat.
            Um Ihr Widerrufsrecht auszuüben, müssen Sie uns
            ({{ config('shop.legal_name') }}, {{ config('shop.street') }}, {{ config('shop.zip') }} {{ config('shop.city') }},
            E-Mail: <a href="mailto:{{ config('shop.email') }}">{{ config('shop.email') }}</a>,
            Telefon: {{ config('shop.phone') }}) mittels einer eindeutigen Erklärung (z. B. ein mit der Post
            versandter Brief oder eine E-Mail) über Ihren Entschluss, diesen Vertrag zu widerrufen, informieren.
            Sie können dafür das beigefügte Muster-Widerrufsformular verwenden, das jedoch nicht vorgeschrieben ist.
          </p>
          <p class="text-muted mb-5">
            Zur Wahrung der Widerrufsfrist reicht es aus, dass Sie die Mitteilung über die Ausübung des
            Widerrufsrechts vor Ablauf der Widerrufsfrist absenden.
          </p>

          <h2 class="fs-5 mb-3">Folgen des Widerrufs</h2>
          <p class="text-muted mb-3">
            Wenn Sie diesen Vertrag widerrufen, haben wir Ihnen alle Zahlungen, die wir von Ihnen erhalten haben,
            einschließlich der Lieferkosten (mit Ausnahme der zusätzlichen Kosten, die sich daraus ergeben, dass
            Sie eine andere Art der Lieferung als die von uns angebotene, günstigste Standardlieferung gewählt
            haben), unverzüglich und spätestens binnen vierzehn Tagen ab dem Tag zurückzuzahlen, an dem die
            Mitteilung über Ihren Widerruf dieses Vertrags bei uns eingegangen ist.
          </p>
          <p class="text-muted mb-3">
            Für diese Rückzahlung verwenden wir dasselbe Zahlungsmittel, das Sie bei der ursprünglichen
            Transaktion eingesetzt haben, es sei denn, mit Ihnen wurde ausdrücklich etwas anderes vereinbart;
            in keinem Fall werden Ihnen wegen dieser Rückzahlung Entgelte berechnet. Wir können die Rückzahlung
            verweigern, bis wir die Waren wieder zurückerhalten haben oder bis Sie den Nachweis erbracht haben,
            dass Sie die Waren zurückgesandt haben, je nachdem, welches der frühere Zeitpunkt ist.
          </p>
          <p class="text-muted mb-3">
            Sie haben die Waren unverzüglich und in jedem Fall spätestens binnen vierzehn Tagen ab dem Tag, an
            dem Sie uns über den Widerruf dieses Vertrags unterrichten, an uns zurückzusenden oder zu übergeben.
            Die Frist ist gewahrt, wenn Sie die Waren vor Ablauf der Frist von vierzehn Tagen absenden.
          </p>
          <p class="text-muted mb-5">
            Wir tragen die Kosten der Rücksendung der Waren. Sie müssen für einen etwaigen Wertverlust der Waren
            nur aufkommen, wenn dieser Wertverlust auf einen zur Prüfung der Beschaffenheit, Eigenschaften und
            Funktionsweise der Waren nicht notwendigen Umgang mit ihnen zurückzuführen ist.
          </p>

          <h2 class="fs-5 mb-3">Ausschluss des Widerrufsrechts</h2>
          <p class="text-muted mb-5">
            Das Widerrufsrecht besteht nicht bei Verträgen zur Lieferung von Waren, die nicht vorgefertigt sind
            und für deren Herstellung eine individuelle Auswahl oder Bestimmung durch den Verbraucher maßgeblich
            ist oder die eindeutig auf die persönlichen Bedürfnisse des Verbrauchers zugeschnitten sind.
          </p>

          <div class="card border">
            <div class="card-body p-5">
              <h2 class="fs-5 mb-3">Muster-Widerrufsformular</h2>
              <p class="text-muted small mb-4">
                (Wenn Sie den Vertrag widerrufen wollen, füllen Sie bitte dieses Formular aus und senden Sie es
                zurück.)
              </p>
              <p class="text-muted mb-2">
                An {{ config('shop.legal_name') }}, {{ config('shop.street') }},
                {{ config('shop.zip') }} {{ config('shop.city') }},
                E-Mail: {{ config('shop.email') }}
              </p>
              <p class="text-muted mb-2">
                Hiermit widerrufe(n) ich/wir (*) den von mir/uns (*) abgeschlossenen Vertrag über den Kauf der
                folgenden Waren (*):
              </p>
              <p class="text-muted mb-2">_______________________________________________</p>
              <p class="text-muted mb-2">Bestellt am (*) / erhalten am (*): ____________________</p>
              <p class="text-muted mb-2">Name des/der Verbraucher(s): ____________________</p>
              <p class="text-muted mb-2">Anschrift des/der Verbraucher(s): ____________________</p>
              <p class="text-muted mb-2">Unterschrift des/der Verbraucher(s) (nur bei Mitteilung auf Papier): ____________________</p>
              <p class="text-muted mb-3">Datum: ____________________</p>
              <p class="text-muted small mb-0">(*) Unzutreffendes streichen.</p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
</main>
@endsection
