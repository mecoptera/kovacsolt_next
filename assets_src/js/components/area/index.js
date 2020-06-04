import axios from 'axios';
import Bamboo from '@dkocsis-emarsys/bamboo';

export default class KArea extends Bamboo {
  init() {
    super.init({ className: 'c-area' });
  }

  static get observedAttributes() {
    return ['data-endpoint'];
  }

  static get boundProperties() {
    return [
      { name: 'dataEndpoint', as: 'endpoint' }
    ];
  }

  get template() {
    return [{
      name: 'area',
      useShadow: false,
      markup: html => html`<div class="c-loader"></div>`,
      root: this._templater.parseHTML('<div class="c-area__container"></div>'),
      autoAppend: true
    }];
  }

  connectedCallback() {
    super.connectedCallback();

    this._startAreaLoading();
  }

  _startAreaLoading() {
    const endpoint = this._state.get('endpoint');

    axios({
      method: 'get',
      url: endpoint,
      baseURL: window.kovacsolt.baseUrl
    }).then(response => this._templater.getRoot('area').innerHTML = response.data.content);
  }
}
