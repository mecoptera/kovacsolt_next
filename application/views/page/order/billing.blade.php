@extends('page.order._steps')

@section('title', 'Rendelés leadása')

@section('order-step')
  <div class="c-panel">
    <div class="c-panel__content">
      <h1 class="c-panel__title">Számlázási adatok</h1>

      <div class="l-grid">
        <form class="l-form l-grid__col--6 l-grid__col--offset-3 u-flex u-flex-col" method="post" action="{{ current_url() }}">
          <k-input
            data-name="name"
            data-label="Név"
            data-value="{{ $billingData['name'] ? $billingData['name'] : ($this->userModel->isLoggedIn() ? $this->session->userdata('user')->fullname : '') }}"
            @error('name')data-error="{{ $errors['name'] }}"@enderror
            data-required
          ></k-input>

          <k-input
            data-name="zip"
            data-label="Irányítószám"
            data-placeholder="Példa: 1123"
            data-value="{{ $billingData['zip'] }}"
            @error('zip')data-error="{{ $errors['zip'] }}"@enderror
            data-required
          ></k-input>

          <k-input
            data-name="city"
            data-label="Város"
            data-placeholder="Példa: Budapest"
            data-value="{{ $billingData['city'] }}"
            @error('city')data-error="{{ $errors['city'] }}"@enderror
            data-required
          ></k-input>

          <k-input
            data-name="address"
            data-label="Cím"
            data-placeholder="Példa: Ferenc tér 32. 4/10"
            data-value="{{ $billingData['address'] }}"
            @error('address')data-error="{{ $errors['address'] }}"@enderror
            data-required
          ></k-input>

          <k-input
            data-type="email"
            data-name="email"
            data-label="E-mail cím"
            data-value="{{ $billingData['email'] ? $billingData['email'] : ($this->userModel->isLoggedIn() ? $this->session->userdata('user')->email : '') }}"
            @error('email')data-error="{{ $errors['email'] }}"@enderror
            data-required
          ></k-input>

          <k-input
            data-name="phone"
            data-label="Telefonszám"
            data-placeholder="Példa: 06 12 345 6789"
            data-helper="Nem kötelező megadni"
            data-value="{{ $billingData['phone'] ? $billingData['phone'] : ($this->userModel->isLoggedIn() ? $this->session->userdata('user')->phone : '') }}"
          ></k-input>

          <div class="l-form__field u-text-center">
            <input type="submit" class="c-button" value="Tovább a szállítási módokhoz">
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
