<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title') - Kovácsolt Póló</title>

  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('site.webmanifest') }}">
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">

  <script>
    window.kovacsolt = {
      baseUrl: '{{ base_url('') }}',
      iconUrl: '{{ base_url('assets/images/icons') }}/'
    };
  </script>
</head>
<body>
  <div class="l-layout">
    <header class="q-menu {{ isIndexPage() ? 'q-menu--alternative' : '' }}">
      <nav class="l-container q-menu__container">
        <div class="q-menu__left">
          <a class="q-logo {{ isIndexPage() ? 'q-logo--white' : '' }}" href="{{ base_url('/') }}"></a>
        </div>
        <div class="q-menu__center">
          <k-menu class="q-menu__bar">
            <k-menu-item class="q-menu__link"><a class="q-menu__text" href="{{ base_url('') }}">Kezdőlap</a></k-menu-item>
            <k-menu-item class="q-menu__link"><a class="q-menu__text" href="{{ base_url('products/1') }}">Termékek</a></k-menu-item>
            <k-menu-item class="q-menu__link"><a class="q-menu__text" href="{{ base_url('planner/types') }}">Tervező</a></k-menu-item>
            <k-menu-item class="q-menu__link"><a class="q-menu__text" href="{{ base_url('contact') }}">Kapcsolat</a></k-menu-item>
            <k-menu-item class="q-menu__link"><a class="q-menu__text" href="{{ base_url('about') }}">Rólunk</a></k-menu-item>
          </k-menu>
        </div>
        <div class="q-menu__right">
        @if ($this->userModel->isLoggedIn())
          <k-profile-button class="q-menu__link-button">
            <k-icon data-icon="person" data-color="{{ isIndexPage() ? 'white' : 'text' }}" data-size="8"></k-icon>
            <span class="u-inline-block u-mx-2 u-text-xs u-uppercase u-font-bold {{ isIndexPage() ? 'u-text-white' : '' }}">
              {{ mb_substr($this->session->userdata('user')->fullname, 0, 24) }}
            </span>
          </k-profile-button>
          <!--<a href="{{ base_url('user/profile') }}" class="q-menu__link-button u-flex u-items-center"></a>-->
        @else
          <a href="{{ base_url('login') }}" class="q-menu__link-button">
            <k-icon data-icon="person" data-color="{{ isIndexPage() ? 'white' : 'text' }}" data-size="8"></k-icon>
            
            @if ($this->userModel->isLoggedIn() && mb_strlen($this->session->userdata('user')->fullname) !== 0)
              <span class="u-inline-block u-mx-2 u-text-xs u-uppercase u-font-bold {{ isIndexPage() ? 'u-text-white' : '' }}">
                {{ mb_substr($this->session->userdata('user')->fullname, 0, 24) }}
              </span>
            @endif
          </a>
        @endif

          <k-cart-button data-count="{{ cartItemsCount() }}" data-cart-url="{{ base_url('cart') }}" data-area-endpoint="cart/menu_button" class="q-menu__link-button ">
            <k-icon data-icon="cart" data-color="{{ isIndexPage() ? 'white' : 'text' }}" data-size="8"></k-icon>
          </k-cart-button>
        </div>
      </nav>
    </header>

    <main class="l-layout__content">
      @yield('content')
    </main>

    <nav class="q-footer">
      <div class="l-container l-container--padding u-mb-0">
        <div class="q-footer__content">
          <div class="q-footer__category">
            <b class="q-footer__title">OLDALTÉRKÉP</b>
            <ul class="q-footer__list">
              <li><a class="c-link q-footer__link" href="{{ base_url('/') }}">Kezdőlap</a></li>
              <li><a class="c-link q-footer__link" href="{{ base_url('/products/1') }}">Termékek</a></li>
              <li><a class="c-link q-footer__link" href="{{ base_url('/planner/types') }}">Tervező</a></li>
              <li><a class="c-link q-footer__link" href="{{ base_url('/about') }}">Rólunk</a></li>
              <li><a class="c-link q-footer__link" href="{{ base_url('/contact') }}">Kapcsolat</a></li>
            </ul>
          </div>
          <div class="q-footer__category">
            <b class="q-footer__title">ADATVÉDELEM</b>
            <ul class="q-footer__list">
              <li><a class="c-link q-footer__link" href="{{ base_url('/privacy') }}">Adatvédelmi Nyilatkozat</a></li>
            </ul>
          </div>
          <div class="q-footer__category">
            <b class="q-footer__title">ELÉRHETŐSÉGEK</b>
            <ul class="q-footer__list">
              <li><a class="c-link q-footer__link" href="mailto:hello@kovacsoltpolo.hu">hello@kovacsoltpolo.hu</a></li>
              <li><a class="c-link q-footer__link" href="tel:+36 12 345 6789">+36 12 345 6789</a></li>
            </ul>
          </div>
        </div>

        <div class="q-footer__copyright">© {{ date('Y') }} Kovácsolt Póló</div>
      </div>
    </nav>
  </div>

  <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:200,400,700&display=swap&subset=latin-ext" rel="stylesheet">
  <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
