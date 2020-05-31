@extends('page.order._steps')

@section('title', 'Rendelés leadása')

@section('order-step')
  <div class="c-panel">
    <div class="c-panel__content">
      <h1 class="c-panel__title">Fizetési mód</h1>

      <div class="l-grid">
        <form class="l-form l-grid__col--6 l-grid__col--offset-3 u-flex u-flex-col" method="post" action="{{ base_url('order/payment') }}">
          <k-select
            data-name="payment_method"
            data-label="Fizetési mód"
            data-placeholder="Válassz fizetési módot"
            @if (isset($paymentData['payment_method']))data-value="{{ $paymentData['payment_method'] }}"@endif
          >
            @foreach ($availablePaymentMethods as $paymentMethod)
              <k-select-option data-value="{{ $paymentMethod['key'] }}">{{ $paymentMethod['value'] }}</k-select-option>
            @endforeach
          </k-select>

          <div class="l-form__field u-text-center">
            <input type="submit" class="c-button" value="Tovább a rendelés összesítéséhez">
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
