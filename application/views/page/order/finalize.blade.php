@extends('page.order._steps')

@section('title', 'Rendelés leadása')

@section('order-step')
  <div class="c-panel">
    <div class="c-panel__content">
      <h1 class="c-panel__title">Rendelés összesítése</h1>

      <div class="l-grid u-mb-16">
        <div class="q-cart-summary l-grid__col--8 l-grid__col--offset-2">
          <h3>Termékek</h3>

          <table class="c-table">
            <thead class="c-table__head">
              <tr>
                <th class="c-table__cell c-table__cell--head"></th>
                <th class="c-table__cell c-table__cell--head">Termék</th>
                <th class="c-table__cell c-table__cell--head">Ár</th>
                <th class="c-table__cell c-table__cell--head">Mennyiség</th>
              </tr>
            </thead>
            <tbody class="c-table__body">
              @foreach($cartItems as $cartItem)
                <tr class="c-table__row js-product" data-price="{{ $cartItem['product']->discount ? $cartItem['product']->discount_price : $cartItem['product']->price }}">
                  <td class="c-table__cell">
                    <k-product-card class="u-w-48 u-h-48" data-detail="{{ htmlspecialchars(json_encode($cartItem['product']), ENT_QUOTES, 'UTF-8') }}" data-hide-info></k-product-card>
                  </td>
                  <td class="c-table__cell c-table__cell--large">
                    <span class="u-font-bold u-uppercase">{{ $cartItem['product']->name }}</span>

                    <div class="u-mt-2 u-pt-2 u-border-t u-border-color-form u-text-sm">
                      @if (isset($cartItem['extraData']['size']))
                        <div>Méret: <b>{{ strtoupper($cartItem['extraData']['size']) }}</b></div>
                      @endif
                    </div>
                  </td>
                  <td class="c-table__cell c-table__cell--medium">
                    <div class="u-flex u-items-center">
                      <span class="{{ $cartItem['product']->discount ? 'u-line-through u-text-xs' : 'u-font-bold' }}">
                        <k-format data-value="{{ $cartItem['product']->price }}"></k-format> Ft
                      </span>
                      {{ $cartItem['product']->discount ? '<div class="u-inline-block u-ml-2 u-px-2 u-py-1 u-text-white u-font-bold u-bg-color-brand"><k-format data-value="' . $cartItem['product']->discount_price . '"></k-format> Ft</div>' : '' }}
                    </div>
                  </td>
                  <td class="c-table__cell u-text-right">{{ $cartItem['quantity'] }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <div class="l-form__field u-text-right">
            <div class="l-grid">
              <div class="l-grid__col--2 l-grid__col--offset-8 u-px-4 u-mb-4">Termékek:</div>
              <div class="l-grid__col--2 u-px-4 u-mb-4"><b><k-format data-value="{{ $price }}"></k-format> Ft</b></div>

              <div class="l-grid__col--2 l-grid__col--offset-8 u-px-4 u-mb-4">Szállítás:</div>
              <div class="l-grid__col--2 u-px-4 u-mb-4"><b><k-format data-value="{{ $shippingPrice }}"></k-format> Ft</b></div>
            </div>
            <div class="l-grid u-p-4 u-bg-color-background-primary">
              <div class="l-grid__col--2 l-grid__col--offset-8">Összesen:</div>
              <div class="l-grid__col--2"><b><k-format data-value="{{ $priceTotal }}"></k-format> Ft</b></div>
            </div>
          </div>
        </div>
      </div>

      <div class="l-grid u-mb-16">
        <div class="l-grid__col--8 l-grid__col--offset-2">
          <h3>Számlázási adatok</h3>

          <div class="l-grid">
            <div class="l-grid__col--6 u-p-3 u-text-right"><b>Név:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $billingData['name'] }}</div>

            <div class="l-grid__col--6 u-p-3 u-text-right"><b>Irányítószám:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $billingData['zip'] }}</div>

            <div class="l-grid__col--6 u-p-3 u-text-right"><b>Város:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $billingData['city'] }}</div>

            <div class="l-grid__col--6 u-p-3 u-text-right"><b>Cím:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $billingData['address'] }}</div>

            <div class="l-grid__col--6 u-p-3 u-text-right"><b>E-mail cím:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $billingData['email'] }}</div>

            <div class="l-grid__col--6 u-p-3 u-text-right"><b>Telefonszám:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $billingData['phone'] ? $billingData['phone'] : '---' }}</div>
          </div>
        </div>
      </div>

      <div class="l-grid">
        <div class="l-grid__col--8 l-grid__col--offset-2">
          <h3>Szállítási adatok</h3>

          <div class="l-grid">
            <div class="l-grid__col--6 u-p-3 u-text-right"><b>Átvételi mód:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $shippingMethodText }}</div>

            <div class="l-grid__col--6 u-p-3 u-text-right"><b>Fizetési mód:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $paymentMethodText }}</div>

            <div class="l-grid__col--6 u-p-3 u-text-right"><b>Név:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $shippingData['name'] }}</div>

            <div class="l-grid__col--6 u-p-3 u-text-right"><b>Irányítószám:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $shippingData['zip'] }}</div>

            <div class="l-grid__col--6 u-p-3 u-text-right"><b>Város:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $shippingData['city'] }}</div>

            <div class="l-grid__col--6 u-p-3 u-text-right"><b>Cím:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $shippingData['address'] }}</div>

            <div class="l-grid__col--6 u-p-3 u-text-right"><b>E-mail cím:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $shippingData['email'] }}</div>

            <div class="l-grid__col--6 u-p-3 u-text-right"><b>Telefonszám:</b></div>
            <div class="l-grid__col--6 u-p-3">{{ $shippingData['phone'] ? $shippingData['phone'] : '---' }}</div>
          </div>
        </div>
      </div>

      <div class="l-grid">
        <div class="l-grid__col--6 l-grid__col--offset-3">
          <form class="l-form" method="post" action="{{ base_url('order/finalize') }}">
            <k-textarea
              data-name="comment"
              data-label="Megjegyzés"
              data-helper="Nem kötelező kitölteni"
              @if (isset($finalizeData['comment']))data-value="{{ $finalizeData['comment'] }}"@endif
            ></k-textarea>

            <div class="l-form__field u-text-center">
              <input type="submit" class="c-button" value="Rendelés leadása">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
