@extends('layouts.panel')

@section('title', 'Order Details')

@section('head')
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="d-sm-flex align-items-center mb-4 mt-4">
  <h1 class="h3 mb-0 text-gray-800">Termékek</h1>
</div>

<div class="row">
  @foreach($orderProducts as $orderProduct)
    <div class="col-lg-3">
      <div class="card shadow mb-4">
        <div class="card-body">
          <div><b>{{ $orderProduct->product->name }}</b></div>

          <div style="position: relative; padding-bottom: calc(100% - 32px); margin: 16px auto; width: calc(100% - 32px); background-position: center; background-repeat: no-repeat; background-size: contain; background-image: url('{{ $orderProduct->product->base_product_variant_image }}')">
            <div style="position: absolute; width: {{ $orderProduct->product->base_product_zone_width }}%; height: {{ $orderProduct->product->base_product_zone_height }}%; left: {{ $orderProduct->product->base_product_zone_left }}%; top: {{ $orderProduct->product->base_product_zone_top }}%;">
              <img src="{{ $orderProduct->product->product_variant_design_image }}" style="position: absolute; width: {{ $orderProduct->product->product_variant_design_width }}%; left: {{ $orderProduct->product->product_variant_design_left }}%; top: {{ $orderProduct->product->product_variant_design_top }}%;">
            </div>
          </div>

          <div>Termék: <b>{{ $orderProduct->product->base_product_name }}</b></div>
          <div>Szín: <b>{{ $orderProduct->product->base_product_color_name }}</b></div>
          <div>Darab: <b>{{ $orderProduct->quantity }}</b></div>
          <div><a href="{{ $orderProduct->product->product_variant_design_image }}?original=true">Minta letöltése</a></div>
        </div>
      </div>
    </div>
  @endforeach
</div>

<div class="d-sm-flex align-items-center mb-4 mt-4">
  <h1 class="h3 mb-0 text-gray-800">Adatok</h1>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="card shadow mb-4">
      <div class="card-body">
        <h3>Ár</h3>

        <table class="table table-hover">
          <tbody>
            <tr>
              <td>Termékek</td>
              <td>{{ number_format($cartPrice, 0, ',', ' ') }} Ft</td>
            </tr>
            <tr>
              <td>Szállítás</td>
              <td>{{ number_format($shippingPrice, 0, ',', ' ') }} Ft</td>
            </tr>
            <tr>
              <td><b>Összesen</b></td>
              <td><b>{{ number_format($totalPrice, 0, ',', ' ') }} Ft</b></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="card shadow mb-4">
      <div class="card-body">
        <h3>Szállítás</h3>

        <table class="table table-hover">
          <tbody>
            <tr>
              <td><b>Átvételi mód</b></td>
              <td>{{ $shippingMethodText }}</td>
            </tr>
            <tr>
              <td><b>Fizetési mód</b></td>
              <td>{{ $paymentMethodText }}</td>
            </tr>
            <tr>
              <td><b>Név</b></td>
              <td>{{ $shippingData['name'] }}</td>
            </tr>
            <tr>
              <td><b>Irányítószám</b></td>
              <td>{{ $shippingData['zip'] }}</td>
            </tr>
            <tr>
              <td><b>Város</b></td>
              <td>{{ $shippingData['city'] }}</td>
            </tr>
            <tr>
              <td><b>Cím</b></td>
              <td>{{ $shippingData['address'] }} <a target="_blank" href="https://www.google.com/maps/search/{{ $shippingData['zip'] }}, {{ $shippingData['city'] }} {{ $shippingData['address'] }}">[Térkép]</a></td>
            </tr>
            <tr>
              <td><b>E-mail cím</b></td>
              <td>{{ $shippingData['email'] }}</td>
            </tr>
            <tr>
              <td><b>Telefonszám</b></td>
              <td>{{ $shippingData['phone'] ? $shippingData['phone'] : '---' }}</td>
            </tr>
            <tr>
              <td><b>Megjegyzés a szállítással kapcsolatban</b></td>
              <td>{{ $shippingData['comment'] ? $shippingData['comment'] : '---' }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card shadow mb-4">
      <div class="card-body">
        <h3>Számlázás</h3>

        <table class="table table-hover">
          <tbody>
            <tr>
              <td><b>Név</b></td>
              <td>{{ $billingData['name'] }}</td>
            </tr>
            <tr>
              <td><b>Irányítószám</b></td>
              <td>{{ $billingData['zip'] }}</td>
            </tr>
            <tr>
              <td><b>Város</b></td>
              <td>{{ $billingData['city'] }}</td>
            </tr>
            <tr>
              <td><b>Cím</b></td>
              <td>{{ $billingData['address'] }}</td>
            </tr>
            <tr>
              <td><b>E-mail cím</b></td>
              <td>{{ $billingData['email'] }}</td>
            </tr>
            <tr>
              <td><b>Telefonszám</b></td>
              <td>{{ $billingData['phone'] ? $billingData['phone'] : '---' }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('footer')
<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
$(document).ready(function() {
  $('#dataTable').DataTable({
    order: [],
    columnDefs: [
      {
        targets: 3,
        className: 'dt-body-right'
      }
    ]
  });
});
</script>
@endsection
