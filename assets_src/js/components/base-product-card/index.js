import Bamboo from '@dkocsis-emarsys/bamboo';

export default class KBaseProductCard extends Bamboo {
  init() {
    super.init({ className: 'c-product' });
  }

  static get eventHandlers() {
    return {
      ':click': '_clickHandler'
    };
  }

  static get observedAttributes() {
    return ['data-detail', 'data-url'];
  }

  static get stateOptions() {
    return {
      detail: { type: 'json' }
    };
  }

  static get boundProperties() {
    return [
      { name: 'dataDetail', as: 'detail' },
      { name: 'dataUrl', as: 'url' }
    ];
  }

  get template() {
    return [
      {
        name: 'card',
        useShadow: false,
        markup: html => {
          const data = this._state.get('detail');
          const variantImage = data.baseProductVariantImage;

          return html`
            <div class="c-product__product-layer">
              <div class="c-product__image" style="${'background-image: url(' + data.baseProductVariantImage + ');'}"></div>
            </div>
          `;
        },
        root: this._templater.parseHTML('<div class="c-product__container"></div>'),
        autoAppend: true
      },
      {
        name: 'info',
        useShadow: false,
        markup: html => {
          const data = this._state.get('detail');

          return html`
            <div class="c-product__info">
              <div class="c-product__name">${data.name}</div>
            </div>
          `;
        },
        root: this._templater.parseHTML('<div></div>'),
        autoAppend: true
      }
    ];
  }

  _clickHandler() {
    window.location = this._state.get('url');
  }
}
