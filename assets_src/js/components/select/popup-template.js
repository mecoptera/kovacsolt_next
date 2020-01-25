const optionTemplate = function(html, option) {
  const optionClassName = `c-select__option ${option.state.value === this._state.get('value') ? 'c-select__option--selected' : ''}`;

  return html`
    <div class="${optionClassName}" data-handler="option" onclick="${this}" data-value="${option.state.value}">
      <div class="u-pointer-events-none">${option.state.markup()}</div>
    </div>
  `;
};

export default function(html) {
  const width = `min-width: ${this.querySelector('.c-select__opener') ? this.querySelector('.c-select__opener').offsetWidth : 0}px`;

  return html`
    <div class="c-select__popup" style="${width}">
      ${this._state.get('options').map(option => optionTemplate.call(this, html, option))}
    </div>
  `;
};
