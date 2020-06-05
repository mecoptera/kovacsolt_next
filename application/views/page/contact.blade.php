@extends('layouts.page')

@section('title', 'Kapcsolat')

@section('content')
  <div class="l-container">
    <div class="c-panel">
      <div class="c-panel__content">
        <h1 class="c-panel__title">Hagyj üzenetet!</h1>

        <div class="l-grid">
          <form class="l-form l-grid__col--6 l-grid__col--offset-" method="post" action="{{ current_url() }}">
            <p class="u-text-center">Amennyiben kérdésed van, ajánlatot kérnél, vagy visszajelzést szeretnél adni, írj a <a href="mailto: hello@kovacsoltpolo.hu" class="c-link">hello@kovacsoltpolo.hu</a> címre, vagy hagyj üzenetet az űrlap kitöltésével.</p>

            <k-input
              data-name="name"
              data-label="Neved"
              data-value="{{ old('name') }}"
              @error('name')data-error="{{ $errors['name'] }}"@enderror
            ></k-input>

            <k-input
              data-name="email"
              data-label="E-mail címed"
              data-value="{{ old('email') }}"
              @error('email')data-error="{{ $errors['email'] }}"@enderror
            ></k-input>

            <k-textarea
              data-name="message"
              data-label="Miben segíthetünk?"
              data-value="{{ old('message') }}"
              @error('message')data-error="{{ $errors['message'] }}"@enderror
              class="u-mt-16"
            ></k-textarea>

            <k-checkbox data-name="accept" @error('accept')data-error="{{ $errors['accept'] }}"@enderror>
              <template data-label><div>Megértettem és elfogadom az <a class="c-link" href="{{ base_url('privacy') }}" target="_blank">Adatkezelési tájékoztató</a>ban leírtakat</div></template>
            </k-checkbox>

            <div class="l-form__field u-align-center">
              <input type="submit" class="c-button" value="Küldés">
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection
