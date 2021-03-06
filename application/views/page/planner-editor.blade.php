@extends('layouts.page')

@section('title', 'Tervező')

@section('content')
  <section class="l-container l-container--stretch u-px-0">
    <form id="js-plan-form" method="post" action="{{ base_url('planner/save') }}" class="l-grid">
      <input type="hidden" name="base_product_variant_id" value="{{ $baseProduct->base_product_variant_id }}">

      <div class="l-grid__col--8 u-relative">
        <k-planner-design
          id="js-planner-design"
          data-name="design"
          data-zone-width="{{ $baseProduct->base_product_zone_width }}"
          data-zone-height="{{ $baseProduct->base_product_zone_height }}"
          data-zone-left="{{ $baseProduct->base_product_zone_left }}"
          data-zone-top="{{ $baseProduct->base_product_zone_top }}"
          data-base-product-id="{{ $baseProduct->id }}"
          data-base-product-view-id="{{ $baseProduct->base_product_variant_view_id }}"
          data-base-product-color-id="{{ $baseProduct->base_product_variant_color_id }}"
          data-endpoint="{{ base_url('planner/variant') }}"
        ></k-planner-design>
      </div>

      <div class="l-grid__col--4 u-relative">
        <div class="q-planner-settings">
          @if(count($userProducts))
          <k-tabs>
            <k-tab-content data-label="Tervezés">
          @endif
              <div class="u-p-8 u-hidden" id="js-planner-notification">
                <k-notification data-status="error" data-name="design"></k-notification>
              </div>

              <div class="u-p-8">
                <button class="c-button"><k-icon data-icon="cart" data-color="inherit" class="u-mr-2"></k-icon>Hozzáadás kosárhoz</button>
              </div>

              <div class="q-planner-settings__title">Beállítások</div>
              <div class="q-planner-settings__content u-p-8">
                <div class="u-ml-4 u-mb-4 u-uppercase u-font-bold">Nézet</div>

                <div class="u-mb-12">
                  <k-select class="u-py-0" id="js-select-view" data-name="view_id" data-value="{{ $baseProduct->base_product_variant_view_id }}">
                    @foreach ($baseProductViews as $baseProductView)
                      <k-select-option data-value="{{ $baseProductView->id }}">{{ $baseProductView->name }}</k-select-option>
                    @endforeach
                  </k-select>
                </div>

                <div class="u-ml-4 u-mb-4 u-uppercase u-font-bold">Szín</div>

                <div class="u-mb-12">
                  <template id="js-select-option-color">
                    <div class="u-flex u-items-center">
                      <div class="u-mr-2 u-w-8 u-h-8 u-border-2 u-border-solid u-border-form" style="background-color: ${extra}"></div>
                      <div>${content}</div>
                    </div>
                  </template>
                  <k-select class="u-py-0" id="js-select-color" data-name="color_id" data-value="{{ $baseProduct->base_product_variant_color_id }}">
                    @foreach ($baseProductColors as $baseProductColor)
                      <k-select-option data-value="{{ $baseProductColor->id }}" data-extra="{{ $baseProductColor->value }}" data-template="#js-select-option-color">{{ $baseProductColor->name }}</k-select-option>
                    @endforeach
                  </k-select>
                </div>

                <div class="u-ml-4 u-mb-4 u-uppercase u-font-bold">Kép kiválasztása</div>

                <div class="u-mb-12" id="js-planner-design-selector">
                  <div class="u-hidden">
                    <input type="file" id="js-upload-input" name="fileInput" data-url="{{ base_url('page.planner.upload') }}">
                  </div>

                  <div class="u-flex u-justify-center">
                    <button type="button" class="u-m-0 u-mr-8 c-button c-button--small js-design-modal-open" data-area="{{ base_url('planner/designs') }}">Katalógus megnyitása</button>

                    @if ($this->userModel->isLoggedIn())
                      <button type="button" class="u-m-0 c-button c-button--small c-button--outline js-upload-design" data-area="{{ base_url('planner/designs') }}">Saját kép feltöltése</button>
                    @else
                      <button type="button" disabled class="u-m-0 c-button c-button--small c-button--outline">Saját kép feltöltése</button>
                    @endif
                  </div>

                  @if (!$this->userModel->isLoggedIn())
                    <p class="u-mx-4 u-mt-4 u-italic">Saját képet csak bejelentkezett felhasználó tud feltölteni</p>
                  @endif
                </div>

                <div class="u-ml-4 u-mb-4 u-uppercase u-font-bold">Méret</div>

                <div class="u-mx-4">
                  <k-radiobox data-name="extra_data[size]" data-value="xs" data-label="XS"></k-radiobox>
                  <k-radiobox data-name="extra_data[size]" data-value="s" data-label="S"></k-radiobox>
                  <k-radiobox data-name="extra_data[size]" data-value="m" data-label="M" data-checked></k-radiobox>
                  <k-radiobox data-name="extra_data[size]" data-value="l" data-label="L"></k-radiobox>
                  <k-radiobox data-name="extra_data[size]" data-value="xl" data-label="XL"></k-radiobox>
                  <k-radiobox data-name="extra_data[size]" data-value="2xl" data-label="2XL"></k-radiobox>
                  <k-radiobox data-name="extra_data[size]" data-value="3xl" data-label="3XL"></k-radiobox>
                </div>
              </div>
          @if(count($userProducts))
            </k-tab-content>

            <k-tab-content data-label="Elmentett tervek" data-disabled="{{ $userProducts ? 'true' : 'false' }}">
              <div class="l-grid u-p-8 u-overflow-auto" style="max-height: 732px;">
                @foreach($userProducts as $product)
                  <div class="l-grid__col--6">
                    <k-product-card class="u-m-4" data-detail="{{ $product }}" data-hide-info></k-product-card>
                  </div>
                @endforeach
              </div>
            </k-tab-content>
          </k-tabs>
          @endif

          <div class="u-mt-16 u-p-8 u-text-center">
            <p class="u-mb-0">Nem adtunk elég teret a kreativitásodnak? <a href="{{ base_url('contact') }}" class="c-link">Vedd fel velünk a kapcsolatot</a> és segítünk megvalósítani!</p>
          </div>
        </div>
      </div>
    </form>
  </section>
@endsection
