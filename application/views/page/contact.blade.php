@extends('layouts.page')

@section('title', 'Kapcsolat')

@section('content')
  <div class="l-container">
    <div class="c-panel">
      <div class="c-panel__content">
        <h1 class="c-panel__title">Hagyj üzenetet!</h1>

        <div class="l-grid">
          <form class="l-form l-grid__col--6 l-grid__col--offset-" method="post" action="{{ current_url() }}">
            <p class="u-text-center">Amennyiben kérdésed van, ajánlatot kérnél, vagy visszajelzést szeretnél adni, írj a <a href="mailto: hello@kovacsoltpolo.hu">hello@kovacsoltpolo.hu</a> címre, vagy hagyj üzenetet az űrlap kitöltésével.</p>

            <k-input
              data-name="name"
              data-label="Név"
              data-value="{{ old('name') }}"
              @error('name')data-error @enderror
            ></k-input>

            <k-input
              data-name="email"
              data-label="E-mail cím"
              data-value="{{ old('email') }}"
              @error('email')data-error @enderror
            ></k-input>

            <k-textarea
              data-name="message"
              data-label="Üzenet"
              data-value="{{ old('message') }}"
              @error('message')data-error @enderror
            ></k-textarea>

            <k-checkbox
              data-name="remember"
            >
              <template data-label><div>Megértettem és elfogadom az <a href="{{ base_url('privacy') }}" target="_blank">Adatkezelési tájékoztató</a>ban leírtakat</div></template>
            </k-checkbox>

            <div class="l-form__field u-align-center">
              <a href="javascript:void(0)" class="c-button">Küldés</a>
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection
