import Bamboo from '@dkocsis-emarsys/bamboo';

const uuidv4 = () => ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c => (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16));

export default class KCheckbox extends Bamboo {
  init() {
    super.init({ className: 'c-checkbox' });

    this._state.set('uuid', uuidv4());
  }

  static get eventHandlers() {
    return {
      'input:mouseenter': '_inputMouseEnterHandler',
      'input:mouseleave': '_inputMouseLeaveHandler',
      'input:focus': '_inputFocusHandler',
      'input:blur': '_inputBlurHandler'
    };
  }

  static get stateOptions() {
    return {
      disabled: { type: 'boolean' },
      checked: { type: 'boolean' },
      required: { type: 'boolean' }
    };
  }

  static get observedAttributes() {
    return ['data-name', 'data-value', 'data-placeholder', 'data-label', 'data-helper', 'data-disabled', 'data-checked', 'data-error', 'data-required'];
  }

  static get boundProperties() {
    return [
      { name: 'dataName', as: 'name' },
      { name: 'dataValue', as: 'value' },
      { name: 'dataPlaceholder', as: 'placeholder' },
      { name: 'dataLabel', as: 'label' },
      { name: 'dataHelper', as: 'helper' },
      { name: 'dataDisabled', as: 'disabled' },
      { name: 'dataChecked', as: 'checked' },
      { name: 'dataError', as: 'error' },
      { name: 'dataRequired', as: 'required' }
    ];
  }

  get template() {
    return [
      {
        name: 'checkbox',
        useShadow: false,
        markup: html => {
          this.classList.toggle('c-checkbox--hover', !this._state.get('disabled') && !this._state.get('isFocused') && this._state.get('isHovered') || false);
          this.classList.toggle('c-checkbox--focus', !this._state.get('disabled') && this._state.get('isFocused') || false);
          this.classList.toggle('c-checkbox--disabled', this._state.get('disabled') || false);
          this.classList.toggle('c-checkbox--error', this._state.get('error') || false);

          return html`
            <div class="c-checkbox__field" data-handler="input" onmouseenter="${this}" onmouseleave="${this}">
              <input
                type="checkbox"
                data-handler="input"
                onfocus="${this}"
                onblur="${this}"
                name="${this._state.get('name')}"
                id="${this._state.get('uuid')}"
                value="${this._state.get('value')}"
                disabled="${this._state.get('disabled') ? 'disabled' : null}"
                checked="${this._state.get('checked') ? 'checked' : null}"
                placeholder="${this._state.get('placeholder') || ' '}"
                class="c-checkbox__checkbox"
              >
              ${this._state.get('label') ? html`
                <label class="c-checkbox__label" for="${this._state.get('uuid')}">
                  <div>${this._state.get('label')}</div>
                  ${this._state.get('required') ? html`<div class="u-font-bold u-text-color-brand u-ml-1">*</div>` : ''}
                </label>
              ` : ''}
              ${this._templater.hasMarkup('label') ? html`
                <label class="c-checkbox__label" for="${this._state.get('uuid')}">
                  <div>${this._templater.render('label')()}</div>
                  ${this._state.get('required') ? html`<div class="u-font-bold u-text-color-brand u-ml-1">*</div>` : ''}
                </label>
              ` : ''}
            </div>
            ${!this._state.get('error') && this._state.get('helper') ? html`<div class="c-checkbox__helper">${this._state.get('helper')}</div>` : ''}
            ${this._state.get('error') ? html`<div class="c-checkbox__error">${this._state.get('error')}</div>` : ''}
          `;
        },
        root: document.createElement('div'),
        autoAppend: true
      },
      {
        name: 'label',
        markup: this.querySelector('[data-label]')
      }
    ];
  }

  get value() {
    return this.querySelector('input').checked;
  }

  contentChangedCallback() {
    this._templater.renderAll();
  }

  _inputMouseEnterHandler() {
    this._state.set('isHovered', true);
  }

  _inputMouseLeaveHandler() {
    this._state.set('isHovered', false);
  }

  _inputFocusHandler() {
    this._state.set('isFocused', true);
    this._state.set('error', false);
  }

  _inputBlurHandler() {
    this._state.set('isFocused', false);
  }
}
