import Bamboo from '@dkocsis-emarsys/bamboo';

export default class KFormat extends Bamboo {
  static get observedAttributes() {
    return ['data-value', 'data-postfix'];
  }

  static get boundProperties() {
    return [
      { name: 'dataValue', as: 'value' },
      { name: 'dataPostfix', as: 'postfix' }
    ];
  }

  get template() {
    return [{
      name: 'input',
      useShadow: false,
      markup: html => html`${this._format(this._state.get('value'))}${this._state.get('postfix') && !isNaN(this._state.get('value')) ? ' ' + this._state.get('postfix') : ''}`,
      root: this
    }];
  }

  _format(value) {
    if (!value) { return 0; }

    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
  }
}
