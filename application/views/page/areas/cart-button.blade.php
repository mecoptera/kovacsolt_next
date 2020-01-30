@if (!empty($cartItems))
  <div class="q-cart-button__container u-mb-3">
    <table class="c-table">
      <tbody class="c-table__body">
        @foreach($cartItems as $cartItem)
          <tr class="c-table__row">
            <td class="c-table__cell">
              <k-product-card class="u-w-24 u-h-24" data-detail="{{ htmlspecialchars(json_encode($cartItem['product']), ENT_QUOTES, 'UTF-8') }}" data-hide-info></k-product-card>
            </td>
            <td class="c-table__cell">{{ $cartItem['product']->name }}</td>
            <td class="c-table__cell">
              <div>
                <span class="{{ $cartItem['product']->discount ? 'u-line-through u-text-xs' : 'u-font-bold' }}"><k-format data-value="{{ $cartItem['product']->price }}" data-postfix="Ft"></k-format></span>
                {{ $cartItem['product']->discount ? '<div class="u-inline-block u-px-2 u-py-1 u-text-white u-font-bold u-bg-color-brand"><k-format data-value="' . $cartItem['product']->discount_price . '" data-postfix="Ft"></k-format></div>' : '' }}
              </div>
            </td>
            <td class="c-table__cell">{{ $cartItem['quantity'] }}db</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="u-text-center">
    <a href="{{ base_url('cart') }}" class="c-button c-button--small">Tovább a kosárhoz</a>
  </div>
@else
  <h4 class="u-text-center u-m-0">A kosár üres!</h4>
@endif
