@extends('layouts.page')

@section('title', $product->name)

@section('content')
<div class="l-container">
  <div class="l-grid">
    <div class="l-grid__col--5 l-grid__col--offset-1">
      <k-product-card data-detail="{{ htmlspecialchars(json_encode($product), ENT_QUOTES, 'UTF-8') }}" data-hide-info data-hi-res></k-product-card>
    </div>
    <div class="l-grid__col--5">
      <div class="c-panel" style="min-height: 100%;">
        <div class="c-panel__content">
          <div class="u-mb-2 u-uppercase u-text-xs u-text-color-form">{{ $product->base_product_name }}</div>
          <div class="u-mb-4 u-uppercase u-text-4xl u-font-bold">{{ $product->name }}</div>

          <div class="u-mb-12">
          @if ($product->discount)
            <div class="u-inline-block u-mr-4 u-text-xl u-font-bold u-line-through"><k-format data-value="{{ $product->price }}"></k-format> Ft</div>
            <div class="u-inline-block u-px-2 u-py-1 u-text-white u-text-2xl u-font-bold u-bg-color-brand"><k-format data-value="{{ $product->discount_price }}"></k-format> Ft</div>
          @else
            <div class="u-text-2xl u-font-bold"><k-format data-value="{{ $product->price }}" data-postfix="Ft"></k-format></div>
          @endif
          </div>
          
          @if ($product->description)
            <div class="u-mb-2 u-uppercase u-font-bold">Termék leírása</div>
            <div class="u-mb-12">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A esse, tempore, cum voluptate laboriosam odio id ab quasi voluptas velit eius possimus nesciunt. Corporis commodi natus nam velit delectus harum.</div>
          @endif

          <form method="post" action="{{ base_url('cart/add/' . $product->id) }}">
            <div class="u-mb-2 u-uppercase u-font-bold">Méret</div>

            <k-radiobox data-name="extra_data[size]" data-value="xs" data-label="XS"></k-radiobox>
            <k-radiobox data-name="extra_data[size]" data-value="s" data-label="S"></k-radiobox>
            <k-radiobox data-name="extra_data[size]" data-value="m" data-label="M" data-checked></k-radiobox>
            <k-radiobox data-name="extra_data[size]" data-value="l" data-label="L"></k-radiobox>
            <k-radiobox data-name="extra_data[size]" data-value="xl" data-label="XL"></k-radiobox>
            <k-radiobox data-name="extra_data[size]" data-value="2xl" data-label="2XL"></k-radiobox>
            <k-radiobox data-name="extra_data[size]" data-value="3xl" data-label="3XL"></k-radiobox>

            <div class="u-mt-12 u-text-left">
              <input type="submit" class="c-button c-button--primary" value="Hozzáadás kosárhoz">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
