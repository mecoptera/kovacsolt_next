import PopperJs from 'popper.js';
import Bamboo from '@dkocsis-emarsys/bamboo';
import popupTemplate from './popup-template';

export default class KSelect extends Bamboo {
  init() {
    super.init({
      className: 'c-select',
      listenChildren: true
    });

    this._state.subscribe('isOpen', this._isOpenSubscription.bind(this));
    this._state.subscribe('value', this._valueChangeHandler.bind(this));

    this._outsideClickHandler = this._outsideClickHandler.bind(this);
  }

  static get initialState() {
    return {
      name: '',
      value: null,
      markup: '',
      options: [],
      isOpen: false
    };
  }

  static get stateOptions() {
    return {
      inline: { type: 'boolean' },
      disabled: { type: 'boolean' }
    };
  }

  static get observedAttributes() {
    return ['data-name', 'data-value', 'data-placeholder', 'data-label', 'data-helper', 'data-inline', 'data-disabled', 'data-error'];
  }

  static get boundProperties() {
    return [
      { name: 'dataName', as: 'name' },
      { name: 'dataValue', as: 'value' },
      { name: 'dataPlaceholder', as: 'placeholder' },
      { name: 'dataLabel', as: 'label' },
      { name: 'dataHelper', as: 'helper' },
      { name: 'dataInline', as: 'inline' },
      { name: 'dataDisabled', as: 'disabled' },
      { name: 'dataError', as: 'error' }
    ];
  }

  static get eventHandlers() {
    return {
      'opener:mouseenter': '_openerMouseEnterHandler',
      'opener:mouseleave': '_openerMouseLeaveHandler',
      'opener:focus': '_openerFocusHandler',
      'opener:blur': '_openerBlurHandler',
      'opener:click': '_openerClickHandler',
      'opener:keypress': '_openerKeyPressHandler',
      'opener:keydown': '_openerKeyDownHandler',
      'option:click': '_optionClickHandler',
      'label:click': '_labelClickHandler'
    };
  }

  get template() {
    return [
      {
        name: 'select',
        useShadow: false,
        markup: html => {
          this.classList.toggle('c-select--hover', !this._state.get('disabled') && !this._state.get('isFocused') && this._state.get('isHovered') || false);
          this.classList.toggle('c-select--focus', !this._state.get('disabled') && (this._state.get('isOpen') || this._state.get('isFocused')) || false);
          this.classList.toggle('c-select--disabled', this._state.get('disabled') || false);
          this.classList.toggle('c-select--filled', this._state.get('value') !== null || false);
          this.classList.toggle('c-select--error', this._state.get('error') || false);

          const openerClass = this._state.get('inline') ? 'c-select__opener c-select__opener--inline' : 'c-select__opener';
          const indicatorIcon = this._state.get('isOpen') ? 'triangle-up' : 'triangle-down';

          return html`
            <input type="hidden" name="${this._state.get('name')}" value="${this._state.get('value')}">
            ${this._state.get('label') ? html`<label class="c-select__label" data-handler="label" onclick="${this}">${this._state.get('label')}</label>` : ''}
            <div class="${openerClass}" tabindex="0" data-handler="opener" onmouseenter="${this}" onmouseleave="${this}" onfocus="${this}" onblur="${this}" onclick="${this}" onkeypress="${this}" onkeydown="${this}">
              <div class="u-pointer-events-none">${(this._state.get('markup') ? this._state.get('markup')() : false) || this._state.get('placeholder')}</div>
              <k-icon data-icon="${indicatorIcon}" data-color="inherit" data-size="8" class="c-select__indicator"></k-icon>
            </div>

            ${!this._state.get('error') && this._state.get('helper') ? html`<div class="c-input__helper">${this._state.get('helper')}</div>` : ''}
            ${!this._state.get('error') && this._templater.hasMarkup('helper') ? html`<div class="c-input__helper">${this._templater.render('helper')()}</div>` : ''}
            ${this._state.get('error') ? html`<div class="c-select__error">${this._state.get('error')}</div>` : ''}
          `;
        },
        root: document.createElement('div'),
        autoAppend: true
      },
      {
        name: 'popup',
        useShadow: false,
        markup: popupTemplate,
        root: document.createElement('div')
      },
      {
        name: 'helper',
        useShadow: false,
        markup: this.querySelector('[data-helper]')
      }
    ];
  }

  childrenChangedCallback(collection) {
    const childrenList = collection.get();
    this._state.set('options', childrenList);

    childrenList.forEach(child => {
      if (this._state.get('value') !== null && child.state.value === this._state.get('value')) {
        this._state.set('markup', child.state.markup, { storeFunction: true });
      }
    });
  }

  get value() {
    return this._state.get('value');
  }

  get form() {
    return this.querySelector('input[type="hidden"]').form;
  }

  _openerMouseEnterHandler() {
    this._state.set('isHovered', true);
  }

  _openerMouseLeaveHandler() {
    this._state.set('isHovered', false);
  }

  _openerFocusHandler() {
    this._state.set('isFocused', true);
    this._state.set('error', false);
  }

  _openerBlurHandler() {
    this._state.set('isFocused', false);
  }

  _openerClickHandler() {
    this._state.set('isOpen', value => !value);
  }

  _openerKeyPressHandler(event) {
    switch (event.key) {
      case 'Enter': this._state.set('isOpen', value => !value); break;
    }
  }

  _openerKeyDownHandler(event) {
    if (event.key === 'Tab' && this._state.get('isOpen')) {
      event.preventDefault();
      this._state.set('isOpen', false);
    }
  }

  _optionClickHandler(event) {
    this._state.set('value', event.target.dataset.value);
  }

  _valueChangeHandler(value) {
    const option = this._state.get('options').find(option => option.state.value === value);

    if (!option) { return; }

    this._state.set('markup', option.state.markup, { storeFunction: true });
    this._state.set('isOpen', false);

    const event = new CustomEvent('change');
    this.dispatchEvent(event);
  }

  _labelClickHandler() {
    this.querySelector('[data-handler="opener"]').focus();
    this._state.set('isOpen', value => !value);
  }

  _isOpenSubscription(value) {
    if (this._state.get('disabled')) { return; }

    if (value) {
      document.addEventListener('click', this._outsideClickHandler);

      document.body.appendChild(this._templater.getRoot('popup'));
      new PopperJs(this._templater.getRoot('select'), this._templater.getRoot('popup'));
    } else {
      document.removeEventListener('click', this._outsideClickHandler);

      document.body.removeChild(this._templater.getRoot('popup'));
    }
  }

  _outsideClickHandler(event) {
    if (this.contains(event.target)) { return; }

    this._state.set('isOpen', false);
  }
}
