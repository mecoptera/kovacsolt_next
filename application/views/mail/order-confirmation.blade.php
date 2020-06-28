@extends('mail.email-skeleton')

@section('title', 'Sikeres rendelés')

@section('body')
<p><b>Kedves felhasználó!</b></p>

<p>
  Rendelésed fogadtuk és a lehető leggyorsabban igyekszünk feldolgozni azt.<br/>
</p>

<p>
  Amennyiben változtatni szeretnél a rendeléseden <a href="{{ base_url('contact') }}" style="text-decoration: none; color: #941f2a;">vedd fel velünk a kapcsolatot</a> és hivatkozz a rendelési azonosítódra.
</p>

<p>
  Rendelésed azonosítója: <b style="font-size: 24px">{{ $orderId }}</b>
</p>

<table style="border-spacing: 0; table-layout: fixed; width: 100%; margin-top: 64px; margin-bottom: 64px;">
  <thead>
    <tr>
      <th style="width: 25%; border-bottom: 1px solid #e2e4e8;">Minta</th>
      <th style="width: 25%; border-bottom: 1px solid #e2e4e8;">Termék</th>
      <th style="width: 25%; border-bottom: 1px solid #e2e4e8;">Ár</th>
      <th style="width: 25%; border-bottom: 1px solid #e2e4e8;">Mennyiség</th>
    </tr>
  </thead>
  <tbody>
    @foreach($cartItems as $cartItem)
      <tr>
        <td style="width: 25%; text-align: center;">
          <img src="{{ $cartItem['product']->product_variant_design_image }}" alt="" style="width: 100px;">
        </td>
        <td style="width: 25%;">
          <b>{{ $cartItem['product']->name }}</b>
          <div>
            @if (isset($cartItem['extraData']['size']))
              <div>Méret: {{ strtoupper($cartItem['extraData']['size']) }}</div>
            @endif
          </div>
        </td>
        <td style="width: 25%; text-align: right;">
          {{ $cartItem['product']->discount ? $cartItem['product']->discount_price : $cartItem['product']->price }} Ft
        </td>
        <td style="width: 25%; text-align: right;">{{ $cartItem['quantity'] }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

<p><b>Végösszeg</b></p>
<table style="border-spacing: 0; table-layout: fixed; width: 100%; margin-top: 32px; margin-bottom: 64px;">
  <tr>
    <td style="padding-left: 16px;">Termékek:</td>
    <td style="text-align: right; padding-right: 16px;"><b>{{ $price }} Ft</b></td>
  </tr>
  <tr>
    <td style="padding-left: 16px;">Szállítás:</td>
    <td style="text-align: right; padding-right: 16px;"><b>{{ $shippingPrice }} Ft</b></td>
  </tr>
  <tr>
    <td style="background-color: #f4f4f4; padding-left: 16px;">Összesen:</td>
    <td style="background-color: #f4f4f4; text-align: right; padding-right: 16px;"><b>{{ $priceTotal }} Ft</b></td>
  </tr>
</table>

<p><b>Számlázási adatok</b></p>
<table style="border-spacing: 0; table-layout: fixed; width: 100%; margin-top: 32px; margin-bottom: 64px;">
  <tr>
    <td style="text-align: right; padding-right: 16px;">Név</td>
    <td style="text-align: left; padding-left: 16px;"><b>{{ $billingData['name'] }}</b></td>
  </tr>
  <tr>
    <td style="text-align: right; padding-right: 16px;">Irányítószám</td>
    <td style="text-align: left; padding-left: 16px;"><b>{{ $billingData['zip'] }}</b></td>
  </tr>
  <tr>
    <td style="text-align: right; padding-right: 16px;">Város</td>
    <td style="text-align: left; padding-left: 16px;"><b>{{ $billingData['city'] }}</b></td>
  </tr>
  <tr>
    <td style="text-align: right; padding-right: 16px;">Cím</td>
    <td style="text-align: left; padding-left: 16px;"><b>{{ $billingData['address'] }}</b></td>
  </tr>
  <tr>
    <td style="text-align: right; padding-right: 16px;">E-mail cím</td>
    <td style="text-align: left; padding-left: 16px;"><b>{{ $billingData['email'] }}</b></td>
  </tr>
  <tr>
    <td style="text-align: right; padding-right: 16px;">Telefonszám</td>
    <td style="text-align: left; padding-left: 16px;"><b>{{ $billingData['phone'] ? $billingData['phone'] : '---' }}</b></td>
  </tr>
</table>

<p><b>Szállítási adatok</b></p>
<table style="border-spacing: 0; table-layout: fixed; width: 100%; margin-top: 32px; margin-bottom: 64px;">
  <tr>
    <td style="text-align: right; padding-right: 16px;">Átvételi mód</td>
    <td style="text-align: left; padding-left: 16px;"><b>{{ $shippingMethodText }}</b></td>
  </tr>
  <tr>
    <td style="text-align: right; padding-right: 16px;">Fizetési mód</td>
    <td style="text-align: left; padding-left: 16px;"><b>{{ $paymentMethodText }}</b></td>
  </tr>
  <tr>
    <td style="text-align: right; padding-right: 16px;">Név</td>
    <td style="text-align: left; padding-left: 16px;"><b>{{ $shippingData['name'] }}</b></td>
  </tr>
  <tr>
    <td style="text-align: right; padding-right: 16px;">Irányítószám</td>
    <td style="text-align: left; padding-left: 16px;"><b>{{ $shippingData['zip'] }}</b></td>
  </tr>
  <tr>
    <td style="text-align: right; padding-right: 16px;">Város</td>
    <td style="text-align: left; padding-left: 16px;"><b>{{ $shippingData['city'] }}</b></td>
  </tr>
  <tr>
    <td style="text-align: right; padding-right: 16px;">Cím</td>
    <td style="text-align: left; padding-left: 16px;"><b>{{ $shippingData['address'] }}</b></td>
  </tr>
  <tr>
    <td style="text-align: right; padding-right: 16px;">E-mail cím</td>
    <td style="text-align: left; padding-left: 16px;"><b>{{ $shippingData['email'] }}</b></td>
  </tr>
  <tr>
    <td style="text-align: right; padding-right: 16px;">Telefonszám</td>
    <td style="text-align: left; padding-left: 16px;"><b>{{ $shippingData['phone'] ? $shippingData['phone'] : '---' }}</b></td>
  </tr>
</table>

@if (isset($finalizeData['comment']) && $finalizeData['comment'] !== '')
  <p><b>Megjegyzés</b></p>
  <i>{{ $finalizeData['comment'] }}</i>
@endif

@endsection