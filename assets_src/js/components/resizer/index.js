import Bamboo from '@dkocsis-emarsys/bamboo';

const between = (value, min, max) => {
  return Math.max(min, Math.min(value, max));
};

export default class KResizer extends Bamboo {
  init() {
    super.init({
      className: 'q-resizer',
      notifyParent: true
    });

    this._mouseMoveHandler = this._mouseMoveHandler.bind(this);
    this._mouseUpHandler = this._mouseUpHandler.bind(this);
  }

  static get defaultState() {
    return {
      elementWidth: 100,
      elementLeft: 0,
      elementTop: 0
    };
  }

  static get observedAttributes() {
    return ['data-design'];
  }

  static get boundProperties() {
    return [
      { name: 'dataDesign', as: 'design' }
    ];
  }

  static get eventHandlers() {
    return {
      'control:mousedown': '_controlMousedownHandler',
    }
  }

  get template() {
    return [{
      name: 'resizer',
      markup: html => {
        const state = this._state.get();
        const width = state.elementWidth;
        const left = state.elementLeft;
        const top = state.elementTop;
        const height = width * state.elementRatio * state.resizerRatio;

        const elementStyle = `width: ${width}%; height: ${height}%; left: ${left}%; top: ${top}%;`;
        const backgroundStyle = `background-image: url('${state.design}')`;

        return html`
          <div class="q-resizer__element" style="${elementStyle}">
            <div data-handler="control" data-id="move" onmousedown="${this}" class="q-resizer__background" style="${backgroundStyle}"></div>
            <div data-handler="control" data-id="topLeft" onmousedown="${this}" class="q-resizer__control q-resizer__control--top-left"></div>
            <div data-handler="control" data-id="topRight" onmousedown="${this}" class="q-resizer__control q-resizer__control--top-right"></div>
            <div data-handler="control" data-id="bottomRight" onmousedown="${this}" class="q-resizer__control q-resizer__control--bottom-right"></div>
            <div data-handler="control" data-id="bottomLeft" onmousedown="${this}" class="q-resizer__control q-resizer__control--bottom-left"></div>
          </div>
        `;
      },
      container: this._templater.parseHTML('<div class="q-resizer__container"></div>'),
      autoAppend: true
    }];
  }

  connectedCallback() {
    super.connectedCallback();

    if (this.offsetHeight > this.offsetWidth) {
      this._state.set('resizerRatio', this.offsetWidth / this.offsetHeight);
    } else {
      this._state.set('resizerRatio', this.offsetHeight / this.offsetWidth);
    }

    this._state.set('resizerWidth', this.offsetWidth);
    this._state.set('resizerHeight', this.offsetHeight);

    this._handleImage();
  }

  _handleImage() {
    const image = document.createElement('img');

    image.addEventListener('load', event => {
      this._state.set('elementRatio', image.naturalHeight / image.naturalWidth);
    });

    image.src = this._state.get('design');

    this.appendChild(image);
    this.removeChild(image);
  }

  _controlMousedownHandler(event) {
    window.addEventListener('mousemove', this._mouseMoveHandler);
    window.addEventListener('mouseup', this._mouseUpHandler);

    this.classList.add('q-resizer--active');
    event.target.setAttribute('active', '');

    this._state.set('activeControl', event.target.dataset.id);
    this._state.set('activeControlElement', event.target);
    this._state.set('controlStartPosition', { x: event.clientX, y: event.clientY });
    this._state.set('elementStartWidth', this.querySelector('.q-resizer__element').offsetWidth);
    this._state.set('elementStartWidthPercent', this._state.get('elementWidth'));
    this._state.set('elementStartLeftPercent', this._state.get('elementLeft'));
    this._state.set('elementStartTopPercent', this._state.get('elementTop'));
  }

  _mouseMoveHandler(event) {
    const resizerRatio = this._state.get('resizerRatio');

    const elementRatio = this._state.get('elementRatio');
    const elementStartLeftPercent = this._state.get('elementStartLeftPercent');
    const elementStartTopPercent = this._state.get('elementStartTopPercent');
    const elementStartWidthPercent = this._state.get('elementStartWidthPercent');
    const elementStartWidth = this._state.get('elementStartWidth');
    const elementStartHeight = elementStartWidth * elementRatio;
    const elementStartHeightPercent = elementStartWidthPercent * elementRatio * resizerRatio;

    const activeControl = this._state.get('activeControl');
    const controlStartPosition = this._state.get('controlStartPosition');
    const controlCurrentPosition = { x: event.clientX, y: event.clientY };

    if (activeControl === 'bottomRight') {
      const scaleByX = Math.min((controlStartPosition.x - controlCurrentPosition.x) / elementStartWidth / 2, 0.5);
      const scaleByY = Math.min((controlStartPosition.y - controlCurrentPosition.y) / elementStartHeight / 2, 0.5);

      const width = elementStartWidthPercent * (1 - (scaleByX + scaleByY));
      const finalWidth = between(width, 0, 100 - elementStartLeftPercent);

      this._state.set('elementWidth', finalWidth);
    } else if (activeControl === 'topRight') {
      const scaleByX = Math.min((controlStartPosition.x - controlCurrentPosition.x) / elementStartWidth / 2, 0.5);
      const scaleByY = Math.min((controlCurrentPosition.y - controlStartPosition.y) / elementStartHeight / 2, 0.5);

      const width = elementStartWidthPercent * (1 - (scaleByX + scaleByY));
      const finalWidth = between(width, 0, 100 - elementStartLeftPercent);

      const top = elementStartTopPercent + (scaleByX + scaleByY) * elementStartHeightPercent;
      const minTop = Math.max(0, elementStartTopPercent - (100 - (elementStartLeftPercent + elementStartWidthPercent)) * elementRatio * resizerRatio);
      const finalTop = between(top, minTop, 100);

      this._state.set('elementWidth', finalWidth);
      this._state.set('elementTop', finalTop);
    } else if (activeControl === 'bottomLeft') {
      const scaleByX = Math.min((controlCurrentPosition.x - controlStartPosition.x) / elementStartWidth / 2, 0.5);
      const scaleByY = Math.min((controlStartPosition.y - controlCurrentPosition.y) / elementStartHeight / 2, 0.5);

      const left = elementStartLeftPercent + ((scaleByX + scaleByY) * 100) * (elementStartWidthPercent / 100);
      const finalLeft = between(left, 0, 100);

      const width = elementStartWidthPercent * (1 - (scaleByX + scaleByY));
      const finalWidth = between(width, 0, elementStartLeftPercent + elementStartWidthPercent);

      this._state.set('elementWidth', finalWidth);
      this._state.set('elementLeft', finalLeft);
    } else if (activeControl === 'topLeft') {
      const scaleByX = Math.min((controlCurrentPosition.x - controlStartPosition.x) / elementStartWidth / 2, 0.5);
      const scaleByY = Math.min((controlCurrentPosition.y - controlStartPosition.y) / elementStartHeight / 2, 0.5);

      const width = elementStartWidthPercent * (1 - (scaleByX + scaleByY));
      const finalWidth = between(width, 0, elementStartLeftPercent + elementStartWidthPercent);

      const left = elementStartLeftPercent + ((scaleByX + scaleByY) * 100) * (elementStartWidthPercent / 100);
      const finalLeft = between(left, 0, 100);

      const top = elementStartTopPercent + (scaleByX + scaleByY) * elementStartHeightPercent;
      const minTop = Math.max(0, elementStartTopPercent - elementStartLeftPercent * elementRatio * resizerRatio);
      const finalTop = between(top, minTop, 100);

      this._state.set('elementWidth', finalWidth);
      this._state.set('elementLeft', finalLeft);
      this._state.set('elementTop', finalTop);
    } else if (activeControl === 'move') {
      const resizerWidth = this._state.get('resizerWidth');
      const resizerHeight = this._state.get('resizerHeight');

      const moveX = Math.min((controlCurrentPosition.x - controlStartPosition.x) / resizerWidth * 100);
      const moveY = Math.min((controlCurrentPosition.y - controlStartPosition.y) / resizerHeight * 100);

      const left = elementStartLeftPercent + moveX;
      const finalLeft = between(left, 0, 100 - elementStartWidthPercent);

      const top = elementStartTopPercent + moveY;
      const finalTop = between(top, 0, 100 - elementStartHeightPercent);

      this._state.set('elementLeft', finalLeft);
      this._state.set('elementTop', finalTop);
    }
  }

  _mouseUpHandler(event) {
    window.removeEventListener('mousemove', this._mouseMoveHandler);
    window.removeEventListener('mouseup', this._mouseUpHandler);

    this.classList.remove('q-resizer--active');
    this._state.get('activeControlElement').removeAttribute('active');
  }
}
