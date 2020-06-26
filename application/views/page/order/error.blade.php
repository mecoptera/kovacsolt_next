@extends('layouts.page')

@section('title', 'Rendelés leadása')

@section('content')
  <div class="l-container">
    <div class="c-panel">
      <div class="c-panel__content u-text-center">
        <h1 class="c-panel__title">Rendelés sikertelen!</h1>

        <p>Sajnos hiba történt a fizetés során, melynek oka valamilyen hibásan megadott bankkártya adat is lehet. Kérjük próbáld meg újra a fizetést.</p>
        <p>Amennyiben úgy érzed a hiba nem nálad történt, úgy elnézésed kérjük és <a class="c-link" href="{{ base_url('contact') }}">vedd fel velünk a kapcsolatot</a>, hogy kiderítsük mi történt.</p>

        <div class="u-mt-12">
          <a class="c-button" href="{{ base_url('order/finalize') }}">Vissza a rendeléshez</a>
        </div>
      </div>
    </div>
  </div>
@endsection
