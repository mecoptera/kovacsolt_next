@extends('layouts.page')

@section('content')
  <div class="l-container">
    <div class="q-order-steps">
      <a
        class="q-order-steps__step {{ $step === 0 ? 'q-order-steps__step--current' : 'q-order-steps__step--done' }}"
        @if($step > 0)
          href="{{ base_url('order') }}"
        @endif
      >
        <span class="q-order-steps__text">Felhasználói fiók</span>
      </a>

      <a
        class="q-order-steps__step {{ $step > 0 ? ($step === 1 ? 'q-order-steps__step--current' : 'q-order-steps__step--done') : '' }}"
        @if($step > 1)
          href="{{ base_url('order/billing') }}"
        @endif
      >
        <span class="q-order-steps__text">Számlázási adatok</span>
      </a>

      <a
        class="q-order-steps__step {{ $step > 1 ? ($step === 2 ? 'q-order-steps__step--current' : 'q-order-steps__step--done') : '' }}"
        @if($step > 2)
          href="{{ base_url('order/shipping') }}"
        @endif
      >
        <span class="q-order-steps__text">Szállítási adatok</span>
      </a>

      <a class="q-order-steps__step {{ $step > 3 ? ($step === 4 ? 'q-order-steps__step--current' : 'q-order-steps__step--done') : '' }}">
        <span class="q-order-steps__text">Rendelés összesítése</span>
      </a>
    </div>

    @yield('order-step')
  </div>
@endsection
