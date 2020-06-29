@extends('layouts.page')

@section('title', 'Regisztráció')

@section('content')
  <div class="l-container">
    <div class="c-panel">
      <div class="c-panel__content">
        <h1 class="c-panel__title">Regisztráció</h1>

        <div class="l-grid">
          <form class="u-mx-auto l-grid__col--6" method="post" action="{{ base_url('registration') }}">
            <k-input
              data-fluid
              data-name="fullname"
              data-label="Név"
              data-value="{{ old('fullname') }}"
              @error('name')data-error="{{ $errors['fullname'] }}"@enderror
              data-required
            ></k-input>

            <k-input
              data-fluid
              data-name="email"
              data-label="E-mail cím"
              data-value="{{ old('email') }}"
              @error('email')data-error="{{ $errors['email'] }}"@enderror
              data-required
            ></k-input>

            <k-input
              data-fluid
              data-type="password"
              data-name="password"
              data-label="Jelszó"
              @error('password')data-error="{{ $errors['password'] }}"@enderror
              data-required
            >
            </k-input>

            <k-input
              data-fluid
              data-type="password"
              data-name="password_confirmation"
              data-label="Jelszó újra"
              @error('password')data-error @enderror
              data-required
            >
            </k-input>

            <k-checkbox data-name="accept" @error('accept')data-error="{{ $errors['accept'] }}"@enderror data-required>
              <template data-label>Megértettem és elfogadom az&nbsp;<a href="{{ base_url('privacy') }}" target="_blank" class="c-link">Adatkezelési tájékoztatóban</a>&nbsp;leírtakat</template>
            </k-checkbox>

            <div class="u-mt-8 u-text-center">
              <input type="submit" class="c-button" value="Regisztráció">
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="l-grid__row l-grid__row--center">
      <div class="l-grid__col-sm-6 q-login-helper">
        <div class="q-login-helper__content">
          <div class="q-login-helper__text">Rendelkezel már felhasználói fiókkal?</div>

          <div class="q-login-helper__action">
            <a class="c-button c-button--primary" href="{{ base_url('login') }}">Bejelentkezés</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
