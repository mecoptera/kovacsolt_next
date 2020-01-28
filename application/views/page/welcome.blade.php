@extends('layouts.page')

@section('title', 'Kezdőlap')

@section('content')
<div class="l-container l-container--stretch q-welcome">
  <div class="l-container q-welcome__container">
    <div class="q-welcome__headline">
      <div class="q-welcome__plan u-my-8"></div>
      <div class="q-welcome__sub">Készítsd el egyedi pólód nálunk</div>
    </div>

    <div class="q-welcome__footer">
      <div class="q-welcome__description">
        <div class="q-welcome__about">
          <?php echo $this->markdown->parse_file(APPPATH . 'views_md/welcome-header.md'); ?>

          <a href="{{ base_url('page.planner.step1') }}" class="c-button c-button--link">Tudj meg többet</a>
        </div>
        <div class="q-welcome__planner">
          <a href="{{ base_url('page.planner.step1') }}" class="c-button c-button--arrow">Tervező megnyitása</a>
        </div>
      </div>

      <div class="q-welcome__contact">
        <div class="q-welcome__copyright">© {{ date('Y') }} Kovácsolt Póló</div>

        <div class="q-welcome__social">
          <a href="{{ base_url('page.planner.step1') }}"><k-icon data-icon="twitter" data-color="white" data-size="8"></k-icon></a>
          <a href="{{ base_url('page.planner.step1') }}"><k-icon data-icon="facebook" data-color="white" data-size="8"></k-icon></a>
          <a href="{{ base_url('page.planner.step1') }}"><k-icon data-icon="instagram" data-color="white" data-size="8"></k-icon></a>
        </div>

        <div class="q-welcome__phone">Tel.: +36 12 345 6789</div>
      </div>
    </div>
  </div>
</div>

<div class="l-container">
  <h2>Kiemelt termékek</h2>

  <div class="q-products l-grid">
    @foreach($products as $product)
      <div class="l-grid__col--3">
        <k-product-card class="u-m-4" data-detail="{{ htmlspecialchars(json_encode($product), ENT_QUOTES, 'UTF-8') }}" data-url="{{ base_url('product/' . $product->id) }}">
          <k-product-card-action data-label="Tovább a termékhez" data-url="{{ base_url('page/product/' . $product->id) }}" data-icon="eye"></k-product-card-action>
        </k-product-card>
      </div>
    @endforeach
  </div>

  <div class="u-m-16 u-text-center">
    <a href="{{ base_url('page.products') }}" class="c-button">Többi termék megtekintése</a>
  </div>
</div>

<div class="q-contact c-panel">
  <div class="l-container l-container--smaller l-container--padding c-panel__content u-mb-0">
    <h2 class="c-panel__title u-text-white">Feliratkozás hírlevélre</h2>
    <p>Amennyiben a későbbiekben szeretnél értesülni a legújabb akciókról, ne habozz, add meg a címed lent.</p>

    <form class="q-contact__form l-form l-grid__col--6">
      <div class="q-contact__email">
        <k-input data-label="E-mail cím" data-light></k-input>
      </div>

      <a href="javascript:void(0)" class="c-button c-button--outline c-button--light">Feliratkozás</a>
    </form>
  </div>
</div>

@endsection
