import axios from 'axios';
import Bamboo from '@dkocsis-emarsys/bamboo';

export default class KProfileButton extends Bamboo {
  init() {
    super.init({
      className: 'q-profile-button',
      listenChildren: true
    });

    this._outsideClick = this._outsideClick.bind(this);
  }

  static get eventHandlers() {
    return {
      ':click': '_clickHandler'
    };
  }

  get template() {
    return [
      {
        name: 'popup',
        useShadow: false,
        markup: html => html`
          <div class="q-profile-button__panel">
            <a class="q-profile-button__link" href="${window.kovacsolt.baseUrl + 'user/profile'}">Profil beállításai</a>
            <a class="q-profile-button__link" href="${window.kovacsolt.baseUrl + 'logout'}">Kijelentkezés</a>
          </div>
        `,
        root: this._templater.parseHTML('<div class="q-profile-button__popup"></div>')
      }
    ];
  }

  _clickHandler(event) {
    const container = this._templater.getRoot('popup');

    if (container === event.target || container.contains(event.target)) { return false; }

    this.appendChild(container);

    container.classList.toggle('q-profile-button__popup--visible');

    document.addEventListener('click', this._outsideClick, true);
  }

  _outsideClick(event) {
    const container = this._templater.getRoot('popup');

    if (container === event.target || container.contains(event.target)) { return false; }

    if (container.classList.contains('q-profile-button__popup--visible') && (this === event.target || this.contains(event.target))) {
      event.stopPropagation();
    }

    container.classList.remove('q-profile-button__popup--visible');

    document.removeEventListener('click', this._outsideClick);
  }
}
