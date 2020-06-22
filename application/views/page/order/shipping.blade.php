@extends('page.order._steps')

@section('title', 'Rendelés leadása')

@section('order-step')
  <div class="c-panel">
    <div class="c-panel__content">
      <h1 class="c-panel__title">Szállítási adatok</h1>

      <div class="l-grid">
        <form class="l-form l-grid__col--6 l-grid__col--offset-3 u-flex u-flex-col" method="post" action="{{ base_url('order/shipping') }}">
          <template id="js-select-option-shipping">
              ${content} (<k-format data-value="${extra}" data-postfix="Ft"></k-format>)
            </div>
          </template>
          
          <input type="hidden" name="shipping_method" value="delivery">
          
        @if(false)
          <k-select
            id="js-order-shipping-data-select"
            data-name="shipping_method"
            data-label="Átvétel módja"
            data-placeholder="Válassz átvételi módot"
            data-value="{{ isset($shippingData['shipping_method']) ? $shippingData['shipping_method'] : $shippingMethods[0]['key'] }}"
          >
          @foreach($shippingMethods as $shippingMethod)
            <k-select-option data-value="{{ $shippingMethod['key'] }}" data-template="#js-select-option-shipping" data-extra="{{ $shippingMethod['price'] !== 0 ? $shippingMethod['price'] : 'Ingyenes' }}">{{ $shippingMethod['value'] }}</k-select-option>
          @endforeach
          </k-select>
        @endif

          <k-checkbox id="js-order-shipping-data-same" data-name="same_as_billing" data-label="A szállítási adatok megegyeznek a számlázási adatokkal"></k-checkbox>
          
          <div id="js-order-shipping-data-wrapper">
            <div id="js-order-shipping-data-section">
              <k-input
                data-name="name"
                data-label="Név"
                data-value="{{ $shippingData['name'] }}"
                @error('name')data-error="{{ $errors['name'] }}"@enderror
                data-required
              ></k-input>

              <k-input
                data-name="zip"
                data-label="Irányítószám"
                data-placeholder="Példa: 1123"
                data-value="{{ $shippingData['zip'] }}"
                @error('zip')data-error="{{ $errors['zip'] }}"@enderror
                data-required
              ></k-input>

              <k-input
                data-name="city"
                data-label="Város"
                data-placeholder="Példa: Budapest"
                data-value="{{ $shippingData['city'] }}"
                @error('city')data-error="{{ $errors['city'] }}"@enderror
                data-required
              ></k-input>

              <k-input
                data-name="address"
                data-label="Cím"
                data-placeholder="Példa: Ferenc tér 32. 4/10"
                data-value="{{ $shippingData['address'] }}"
                @error('address')data-error="{{ $errors['address'] }}"@enderror
                data-required
              ></k-input>

              <k-input
                data-type="email"
                data-name="email"
                data-label="E-mail cím"
                data-value="{{ $shippingData['email'] }}"
                @error('email')data-error="{{ $errors['email'] }}"@enderror
                data-required
              ></k-input>

              <k-input
                data-name="phone"
                data-label="Telefonszám"
                data-placeholder="Példa: 06 12 345 6789"
                data-helper="Nem kötelező megadni"
                data-value="{{ $shippingData['phone'] }}"
              ></k-input>
            </div>
          </div>

          <div class="l-form__field u-text-center">
            <input type="submit" class="c-button" value="Tovább a fizetési módokhoz">
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

