<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Kovácsolt Póló - @yield('title')</title>

  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('site.webmanifest') }}">

  <link href="https://fonts.googleapis.com/css?family=Montserrat:200,400,700&display=swap&subset=latin-ext" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">

  <script>
    window.kovacsolt = {
      baseUrl: '{{ base_url('') }}/',
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
            <k-menu-item class="q-menu__link"><a class="q-menu__text" href="{{ base_url('products') }}">Termékek</a></k-menu-item>
            <k-menu-item class="q-menu__link"><a class="q-menu__text" href="{{ base_url('page.planner.step1') }}">Tervező</a></k-menu-item>
            <k-menu-item class="q-menu__link"><a class="q-menu__text" href="{{ base_url('contact') }}">Kapcsolat</a></k-menu-item>
            <k-menu-item class="q-menu__link"><a class="q-menu__text" href="{{ base_url('about') }}">Rólunk</a></k-menu-item>
          </k-menu>
        </div>
        <div class="q-menu__right">
          <a href="{{ base_url('user.profile') }}" class="u-mr-4">
            <k-icon data-icon="person" data-color="{{ isIndexPage() ? 'white' : 'text' }}" data-size="8"></k-icon>
          </a>
          @if ($this->userModel->isLoggedIn())
            <div class="u-inline-block u-mr-8 {{ isIndexPage() ? 'u-text-white' : '' }}">
              {$user->name}
            </div>
          @endif
          <k-cart-button data-count="{Webacked\Cart\Helpers::itemsCount()}" data-cart-url="{{ base_url('cart') }}" data-area-endpoint="{{ base_url('cart.area') }}">
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
              <li><a class="q-footer__link" href="{{ base_url('/') }}">Kezdőlap</a></li>
              <li><a class="q-footer__link" href="{{ base_url('/references') }}">Referenciák</a></li>
              <li><a class="q-footer__link" href="{{ base_url('/about') }}">Rólunk</a></li>
              <li><a class="q-footer__link" href="{{ base_url('/contact') }}">Kapcsolat</a></li>
            </ul>
          </div>
          <div class="q-footer__category">
            <b class="q-footer__title">ADATVÉDELEM</b>
            <ul class="q-footer__list">
              <li><a class="q-footer__link" href="{{ base_url('/privacy') }}">Adatvédelmi Nyilatkozat</a></li>
            </ul>
          </div>
          <div class="q-footer__category">
            <b class="q-footer__title">ELÉRHETŐSÉGEK</b>
            <ul class="q-footer__list">
              <li><a class="q-footer__link" href="mailto:hello@kovacsoltpolo.hu">hello@kovacsoltpolo.hu</a></li>
              <li><a class="q-footer__link" href="tel:+36 12 345 6789">+36 12 345 6789</a></li>
            </ul>
          </div>
        </div>

        <div class="q-footer__copyright">© {{ date('Y') }} Kovácsolt Póló</div>
      </div>
    </nav>
  </div>

  <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
