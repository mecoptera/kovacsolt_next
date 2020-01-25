import Bamboo from '@dkocsis-emarsys/bamboo';

export default class KSelectOption extends Bamboo {
  init() {
    super.init({
      className: 'c-select-option',
      notifyParent: true
    });

    this._state.subscribe('template', this._setTemplate.bind(this));
  }

  static get observedAttributes() {
    return ['data-value', 'data-extra', 'data-template'];
  }

  static get boundProperties() {
    return [
      { name: 'dataValue', as: 'value' },
      { name: 'dataExtra', as: 'extra' },
      { name: 'dataTemplate', as: 'template' }
    ];
  }

  get template() {
    return [{ name: 'inside', markup: this }];
  }

  connectedCallback() {
    super.connectedCallback();

    this._state.set('markup', this._templater.render('inside'), { storeFunction: true });
    this._state.set('content', this.textContent);
  }

  contentChangedCallback() {
    this._state.set('markup', this._templater.render('inside'), { storeFunction: true });
    this._state.set('content', this.textContent);
  }

  _setTemplate(value) {
    this._templater.setMarkup('inside', value);
  }
}
