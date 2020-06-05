@extends('layouts.page')

@section('title', 'Katalógus')

@section('content')
<div class="l-container">
  <div class="l-grid">
    <div class="l-grid__col--3 u-pr-4">
      <ul class="c-accordion">
      @foreach($categories as $category)
        <li class="c-accordion__category">
          <input type="checkbox" class="u-hidden c-accordion__category__toggler" id="category-{{ $category->id }}" {{ count(array_filter($category->children, function($child) { return isset($child->active) && $child->active; })) > 0 || $category->id === $activeCategoryId ? 'checked' : '' }}>
          <label for="category-{{ $category->id }}" class="c-accordion__category__title">{{ $category->name }}</label>
          <k-icon data-icon="plus" data-color="inherit" data-size="10" class="c-accordion__category__icon c-accordion__category__icon--plus"></k-icon>
          <k-icon data-icon="minus" data-color="inherit" data-size="10" class="c-accordion__category__icon c-accordion__category__icon--minus"></k-icon>

          <ul class="c-accordion__subcategory">
            @if (isset($category->active) && $category->active)
              <li class="c-accordion__item c-accordion__item--active">
                <label class="c-accordion__item__label">
                  <k-icon data-icon="triangle-right" data-color="inherit" data-size="8" class="c-accordion__item__marker"></k-icon>
                  Összes
                </label>
              </li>
            @else
              <li class="c-accordion__item">
                <a href="{{ base_url('products/' . $category->id) }}" class="c-accordion__item__label">Összes</a>
              </li>
            @endif

            @foreach($category->children as $subCategory)
              @if (isset($subCategory->active) && $subCategory->active)
                <li class="c-accordion__item c-accordion__item--active">
                  <label class="c-accordion__item__label">
                    <k-icon data-icon="triangle-right" data-color="inherit" data-size="8" class="c-accordion__item__marker"></k-icon>
                    {{ $subCategory->name }}
                  </label>
                </li>
              @else
                <li class="c-accordion__item">
                  <a href="{{ base_url('products/' . $subCategory->id) }}" class="c-accordion__item__label">{{ $subCategory->name }}</a>
                </li>
              @endif
            @endforeach
          </ul>
        </li>
      @endforeach
      </ul>
    </div>
    <div class="l-grid__col--9 u-pl-4">
      <div class="q-products">
        <div class="q-products__filter">
          <div>Összesen <b>{{ count($products) }}</b> termék</div>
          <form method="get" action="{{ current_url() }}">
            Rendezés:
            <k-select id="js-select-product-sort_by" class="u-inline-block u-p-0 u-w-auto" data-name="sort_by" data-value="{{ $sortBy }}" data-inline>
              <k-select-option data-value="new">Újak elöl</k-select-option>
              <k-select-option data-value="old">Régiek elöl</k-select-option>
              <k-select-option data-value="name_asc">Név szerint növekvő</k-select-option>
              <k-select-option data-value="name_desc">Név szerint csökkenő</k-select-option>
              <k-select-option data-value="price_asc">Ár szerint növekvő</k-select-option>
              <k-select-option data-value="price_desc">Ár szerint csökkenő</k-select-option>
            </k-select>
          </form>
        </div>

        <div class="q-products__container l-grid">
        @foreach($products as $product)
          <div class="l-grid__col--4 u-flex u-flex-col">
            <k-product-card class="u-m-4 u-flex-auto" data-detail="{{ htmlspecialchars(json_encode($product), ENT_QUOTES, 'UTF-8') }}" data-url="{{ base_url('product/' . $product->id) }}">
              <k-product-card-action data-label="Termék megtekintése" data-url="{{ base_url('product/' . $product->id) }}"></k-product-card-action>
            </k-product-card>
          </div>
        @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
