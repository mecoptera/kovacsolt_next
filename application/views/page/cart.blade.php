@extends('layouts.page')

@section('title', 'Kosár')

@section('content')
  <div class="l-container" _namespace="cart-index">
    <div class="c-panel">
      <div class="c-panel__content">
        <form action="{{ current_url() }}" method="post">
          <h1 class="c-panel__title">Kosár tartalma</h1>

          <div class="l-grid">
            <div class="l-grid__col--8 l-grid__col--offset-2">
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
                      <td class="c-table__cell">
                        <k-number-input data-name="quantity[{{ $cartItem['uniqueId'] }}]" data-value="{{ $cartItem['quantity'] }}" class="js-quantity"></k-number-input>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

              <div class="l-form__field u-text-right">
                <div class="u-p-4 u-bg-color-background-primary">
                  Összesen: <b><k-format  id="js-price"></k-format> Ft</b>
                </div>
              </div>
            </div>
          </div>

          <div class="l-form__field u-text-center">
            <a href="{{ base_url('products/0') }}" class="c-button c-button--outline u-mr-8">Vásárlás folytatása</a>
            <button class="c-button">Tovább a pénztárhoz</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
