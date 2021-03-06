import axios from 'axios';
import Bamboo from '@dkocsis-emarsys/bamboo';

export default class KCartButton extends Bamboo {
  init() {
    super.init({
      className: 'q-cart-button',
      listenChildren: true
    });

    this._outsideClick = this._outsideClick.bind(this);
  }

  static get observedAttributes() {
    return ['data-area-endpoint', 'data-count'];
  }

  static get boundProperties() {
    return [
      { name: 'dataAreaEndpoint', as: 'areaEndpoint' },
      { name: 'dataCount', as: 'count' }
    ];
  }

  static get eventHandlers() {
    return {
      ':click': '_clickHandler'
    };
  }

  get template() {
    return [
      {
        name: 'button',
        useShadow: false,
        markup: html => this._state.get('count') > 0 ? html`<div class="q-cart-button__badge">${this._state.get('count')}</div>` : html``,
        root: this._templater.parseHTML('<div></div>'),
        autoAppend: true
      },
      {
        name: 'popup',
        useShadow: false,
        markup: html => html`<div class="q-cart-button__panel"><k-area data-endpoint="${this._state.get('areaEndpoint')}"></k-area></div>`,
        root: this._templater.parseHTML('<div class="q-cart-button__popup"></div>')
      }
    ];
  }

  _clickHandler(event) {
    const container = this._templater.getRoot('popup');

    if (container === event.target || container.contains(event.target)) { return false; }

    this.appendChild(container);

    container.classList.toggle('q-cart-button__popup--visible');

    document.addEventListener('click', this._outsideClick, true);
  }

  _outsideClick(event) {
    const container = this._templater.getRoot('popup');

    if (container === event.target || container.contains(event.target)) { return false; }

    if (container.classList.contains('q-cart-button__popup--visible') && (this === event.target || this.contains(event.target))) {
      event.stopPropagation();
    }

    container.classList.remove('q-cart-button__popup--visible');

    document.removeEventListener('click', this._outsideClick);
  }
}
