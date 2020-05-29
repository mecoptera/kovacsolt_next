@extends('layouts.page')

@section('title', 'Katalógus')

@section('content')
<div class="l-container">
  <div class="l-grid">
    <div class="l-grid__col--3 u-pr-4">
      <ul class="c-accordion">
        <li class="c-accordion__category">
          <input type="checkbox" class="u-hidden c-accordion__category__toggler" id="clothes" checked>
          <label for="clothes" class="c-accordion__category__title">Ruhadarabok</label>
          <k-icon data-icon="plus" data-color="inherit" data-size="10" class="c-accordion__category__icon c-accordion__category__icon--plus"></k-icon>
          <k-icon data-icon="minus" data-color="inherit" data-size="10" class="c-accordion__category__icon c-accordion__category__icon--minus"></k-icon>
          <ul class="c-accordion__subcategory">
            <li class="c-accordion__item c-accordion__item--active"><label class="c-accordion__item__label"><k-icon data-icon="triangle-right" data-color="inherit" data-size="8" class="c-accordion__item__marker"></k-icon>Összes ruhadarab</label></li>
            <li class="c-accordion__item"><a href="{{ base_url('products/1') }}" class="c-accordion__item__label js-accordion-label" data-category="2">Pólók</a></li>
            <li class="c-accordion__item"><a href="{{ base_url('products/2') }}" class="c-accordion__item__label js-accordion-label" data-category="3">Pulóverek</a></li>
          </ul>
        </li>
        <li class="c-accordion__category">
          <input type="checkbox" class="u-hidden c-accordion__category__toggler" id="extensions">
          <label for="extensions" class="c-accordion__category__title">Kiegészítők</label>
          <k-icon data-icon="plus" data-color="inherit" data-size="10" class="c-accordion__category__icon c-accordion__category__icon--plus"></k-icon>
          <k-icon data-icon="minus" data-color="inherit" data-size="10" class="c-accordion__category__icon c-accordion__category__icon--minus"></k-icon>
          <ul class="c-accordion__subcategory">
            <li class="c-accordion__item"><a href="{{ base_url('products/3') }}" class="c-accordion__item__label js-accordion-label" data-category="4">Összes kiegészítő</a></li>
            <li class="c-accordion__item"><a href="{{ base_url('products/4') }}" class="c-accordion__item__label js-accordion-label" data-category="5">Táskák</a></li>
          </ul>
        </li>
        <li class="c-accordion__category">
          <input type="checkbox" class="u-hidden c-accordion__category__toggler" id="decor">
          <label for="decor" class="c-accordion__category__title">Dísztárgyak</label>
          <k-icon data-icon="plus" data-color="inherit" data-size="10" class="c-accordion__category__icon c-accordion__category__icon--plus"></k-icon>
          <k-icon data-icon="minus" data-color="inherit" data-size="10" class="c-accordion__category__icon c-accordion__category__icon--minus"></k-icon>
          <ul class="c-accordion__subcategory">
            <li class="c-accordion__item"><a href="{{ base_url('products/5') }}" class="c-accordion__item__label js-accordion-label" data-category="6">Összes dísztárgy</a></li>
            <li class="c-accordion__item"><a href="{{ base_url('products/6') }}" class="c-accordion__item__label js-accordion-label" data-category="7">Bögrék</a></li>
              <li class="c-accordion__item"><a href="{{ base_url('products/7') }}" class="c-accordion__item__label js-accordion-label" data-category="8">Párnák</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="l-grid__col--9 u-pl-4">
      <div class="q-products">
        <div class="q-products__filter">
          <div>Összesen <b>2</b> termék</div>
          <div>
            Rendezés:
            <k-select class="u-inline-block u-p-0 u-w-auto" data-name="view_id" data-value="1" data-inline>
              <k-select-option data-value="1">Név szerint növekvő</k-select-option>
              <k-select-option data-value="2">Név szerint csökkenő</k-select-option>
              <k-select-option data-value="3">Ár szerint növekvő</k-select-option>
              <k-select-option data-value="4">Ár szerint csökkenő</k-select-option>
            </k-select>
          </div>
        </div>

        <div class="q-products__container l-grid">
          @foreach($products as $product)
            <div class="l-grid__col--4 u-flex u-flex-col">
              <k-product-card class="u-m-4 u-flex-auto" data-detail="{{ htmlspecialchars(json_encode($product), ENT_QUOTES, 'UTF-8') }}" data-url="{{ base_url('product/' . $product->id) }}">
                <k-product-card-action data-label="Tovább a termékhez" data-url="{{ base_url('product/' . $product->id) }}" data-icon="eye"></k-product-card-action>
              </k-product-card>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
