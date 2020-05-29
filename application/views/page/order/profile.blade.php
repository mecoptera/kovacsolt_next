@extends('page.order._steps')

@section('title', 'Rendelés leadása')

@section('order-step')
  <div class="c-panel">
    <div class="c-panel__content">
      <h1 class="c-panel__title u-mb-0">Bejelentkezés</h1>

      <div class="l-grid">
        <form class="l-form l-grid__col--6 l-grid__col--offset-3 u-flex u-flex-col" method="post" action="{{ base_url('login') }}">
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
            <template data-helper><a href="{{ base_url('user.password.email') }}" class="c-link">Elfelejtettem a jelszavam</a></template>
          </k-input>

          <k-checkbox data-label="Emlékezz rám ezen a gépen" data-name="remember" data-checked="{{ old('remember') ? 'checked' : '' }}"></k-checkbox>

          <div class="l-form__field u-text-center">
            <button type="submit" class="c-button">Bejelentkezek</button>
          </div>
          <div class="u-text-center">
            <a href="{{ base_url('registration') }}" class="c-button c-button--link">Még nincs fiókom</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="q-login-helper">
    <div class="q-login-helper__content">
      <div class="q-login-helper__text">Ha nem szeretnél regisztrálni</div>

      <div class="q-login-helper__action">
        <a class="c-button c-button--primary" href="{{ base_url('order/billing') }}">Folytatás vendégként</a>
      </div>
    </div>
  </div>
@endsection
