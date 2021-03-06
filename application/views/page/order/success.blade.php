@extends('layouts.page')

@section('title', 'Rendelés leadása')

@section('content')
  <div class="l-container">
    <div class="c-panel">
      <div class="c-panel__content u-text-center">
        <h1 class="c-panel__title">Rendelés sikeres!</h1>

        <p>A rendelésed sikeresen leadtuk és az általad megadott elérhetőségek egyikén értesítünk, amennyiben elkészült.<br>Rendelésed azonosítója:</p>
        <div class="u-text-5xl u-font-bold">{{ $orderId }}</div>

        <div class="u-mt-12">
          <a class="c-button" href="{{ base_url('') }}">Vissza a főoldalra</a>
        </div>
      </div>
    </div>
  </div>
@endsection
