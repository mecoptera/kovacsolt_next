@extends('layouts.page')

@section('title', 'Bejelentkezés')

@section('content')
  <div class="l-container">
    <div class="c-panel">
      <div class="c-panel__content">
        <h1 class="c-panel__title u-mb-0">Bejelentkezés</h1>

        <div class="l-grid">
          <form class="u-mx-auto l-grid__col--6" method="post" action="{{ base_url('authentication') }}">
            <k-input
              data-name="email"
              data-label="E-mail cím"
              data-value="{{ old('email') }}"
              @error('email')data-error="{{ $errors['email'] }}"@enderror
            ></k-input>

            <k-input
              data-type="password"
              data-name="password"
              data-label="Jelszó"
              @error('password')data-error @enderror
            >
              <template data-helper><a href="{{ base_url('authentication/password') }}">Elfelejtettem a jelszavam</a></template>
            </k-input>

            <k-checkbox data-name="remember" data-label="Emlékezz rám ezen a gépen"></k-checkbox>

            <div class="u-mt-8 u-text-center">
              <input type="submit" class="c-button" value="Bejelentkezés">
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="q-login-helper">
      <div class="q-login-helper__content">
        <div class="q-login-helper__text">Még nincs felhasználói fiókod?</div>

        <div class="q-login-helper__action">
          <a class="c-button c-button--primary" href="{{ base_url('registration') }}">Regisztráció</a>
        </div>
      </div>
    </div>
  </div>
@endsection
