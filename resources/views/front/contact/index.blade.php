@extends('front.layouts.app')

@section('title', 'Kontakt')
@section('meta_description', 'Kontaktieren Sie ' . config('shop.name') . ' – telefonisch, per E-Mail oder über unser Kontaktformular. Wir antworten in der Regel innerhalb eines Werktages.')

@section('content')
<main>
  @include('front.partials.page-header', [
    'title' => 'Kontakt',
    'subtitle' => 'Wir beraten Sie gerne persönlich',
  ])

  <section class="py-lg-10 py-8">
    <div class="container">
      <div class="row g-5">

        <!-- Formular -->
        <div class="col-lg-7">
          <h2 class="fs-5 mb-4">Schreiben Sie uns</h2>

          @if(session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
          @endif

          @if($errors->any())
            <div class="alert alert-danger" role="alert">
              <p class="mb-2 fw-bold">Bitte prüfen Sie Ihre Eingaben:</p>
              <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('contact.send') }}" method="POST" class="row g-3">
            @csrf

            <div class="col-md-6">
              <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
              <input type="text" id="name" name="name" value="{{ old('name') }}"
                     class="form-control @error('name') is-invalid @enderror"
                     placeholder="Ihr Vor- und Nachname" required maxlength="120">
              @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
              <label class="form-label" for="email">E-Mail <span class="text-danger">*</span></label>
              <input type="email" id="email" name="email" value="{{ old('email') }}"
                     class="form-control @error('email') is-invalid @enderror"
                     placeholder="ihre@email.de" required maxlength="180">
              @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
              <label class="form-label" for="phone">Telefon <span class="text-muted small">(optional)</span></label>
              <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                     class="form-control @error('phone') is-invalid @enderror"
                     placeholder="Für Rückfragen" maxlength="40">
              @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
              <label class="form-label" for="subject">Betreff <span class="text-danger">*</span></label>
              <select id="subject" name="subject" class="form-select @error('subject') is-invalid @enderror" required>
                <option value="">Bitte wählen …</option>
                @foreach($subjects as $key => $label)
                  <option value="{{ $key }}" {{ old('subject') === $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
              @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
              <label class="form-label" for="message">Ihre Nachricht <span class="text-danger">*</span></label>
              <textarea id="message" name="message" rows="6"
                        class="form-control @error('message') is-invalid @enderror"
                        placeholder="Wie können wir Ihnen helfen?" required maxlength="5000">{{ old('message') }}</textarea>
              @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
              <div class="form-check">
                <input class="form-check-input @error('privacy') is-invalid @enderror" type="checkbox"
                       name="privacy" value="1" id="privacy" {{ old('privacy') ? 'checked' : '' }} required>
                <label class="form-check-label small text-muted" for="privacy">
                  Ich habe die <a href="{{ route('privacy') }}">Datenschutzerklärung</a> gelesen und bin damit
                  einverstanden, dass meine Angaben zur Bearbeitung meiner Anfrage verarbeitet werden.
                  <span class="text-danger">*</span>
                </label>
                @error('privacy')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
              </div>
            </div>

            <div class="col-12">
              <button type="submit" class="btn btn-primary">Nachricht senden</button>
              <p class="text-muted small mt-3 mb-0">Mit <span class="text-danger">*</span> gekennzeichnete Felder sind Pflichtfelder.</p>
            </div>
          </form>
        </div>

        <!-- Kontaktdaten -->
        <div class="col-lg-5">
          <div class="card border mb-4">
            <div class="card-body p-5">
              <h2 class="fs-5 mb-4">Direkter Kontakt</h2>
              <p class="mb-3">
                <i class="feather-icon icon-phone me-2 text-primary"></i>
                <a href="tel:{{ preg_replace('/\s+/', '', config('shop.phone')) }}" class="text-reset text-decoration-none">{{ config('shop.phone') }}</a>
              </p>
              <p class="mb-3">
                <i class="feather-icon icon-mail me-2 text-primary"></i>
                <a href="mailto:{{ config('shop.email') }}" class="text-reset text-decoration-none">{{ config('shop.email') }}</a>
              </p>
              <p class="mb-0 text-muted">
                <i class="feather-icon icon-map-pin me-2 text-primary"></i>
                {{ config('shop.street') }}<br>
                <span class="ms-4">{{ config('shop.zip') }} {{ config('shop.city') }}</span>
              </p>
            </div>
          </div>

          <div class="card border mb-4">
            <div class="card-body p-5">
              <h2 class="fs-5 mb-3">Erreichbarkeit</h2>
              <table class="table table-borderless table-sm mb-0">
                <tbody class="text-muted">
                  <tr><td class="ps-0">Montag – Freitag</td><td class="text-end">9:00 – 18:00 Uhr</td></tr>
                  <tr><td class="ps-0">Samstag</td><td class="text-end">10:00 – 16:00 Uhr</td></tr>
                  <tr><td class="ps-0">Sonntag</td><td class="text-end">geschlossen</td></tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="card border">
            <div class="card-body p-5">
              <h2 class="fs-5 mb-3">Schnelle Antwort gesucht?</h2>
              <p class="text-muted small mb-3">
                Viele Fragen zu Führerschein, Versicherung, Reichweite und Versand beantworten wir bereits in
                unseren häufigen Fragen.
              </p>
              <a href="{{ route('faq') }}" class="btn btn-outline-dark btn-sm">Zu den häufigen Fragen</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
</main>
@endsection
