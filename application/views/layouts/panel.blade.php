<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title')</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('admin/vendor/fontawesome-free/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('admin/sb-admin-2.min.css') }}" rel="stylesheet">
  @yield('head')
</head>
<body id="page-top">
  <div id="wrapper">
  @if ($this->userModel->isLoggedIn())
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <div class="sidebar-brand d-flex align-items-center justify-content-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="186" height="50" fill="none"><path fill="#fff" d="M29 39.26a31.93 31.93 0 0 1-18.12-28.78c0-.83.06-1.63.12-2.44.72-.5 1.47-.95 2.23-1.38A20.63 20.63 0 0 0 29 13.98v25.28zM29 37v2.26a31.94 31.94 0 0 0 18.12-28.78c0-.79-.05-1.56-.11-2.33v-.1c-.73-.5-1.48-.96-2.24-1.39A20.63 20.63 0 0 1 29 13.98v2a22.4 22.4 0 0 0 16.08-6.7A29.6 29.6 0 0 1 29 37z"/><path fill="#fff" fill-rule="evenodd" d="M19.28 4A11.47 11.47 0 0 0 29 9.38v2.3c-5.27 0-9.94-2.55-12.87-6.47A31.8 31.8 0 0 1 19.28 4zM29 11.68v-2.3c4.1 0 7.69-2.15 9.72-5.38 1.08.35 2.13.76 3.15 1.21A16.05 16.05 0 0 1 29 11.68z" clip-rule="evenodd"/><path fill="#fff" d="M31.6 44.67L29 45.92l-2.6-1.25A38.2 38.2 0 0 1 5 13.37c.9-1.03 1.86-2 2.88-2.9v.02A35.15 35.15 0 0 0 27.7 41.97l1.3.62 1.3-.62a35.16 35.16 0 0 0 19.82-31.48v-.01A32.3 32.3 0 0 1 53 13.36a38.2 38.2 0 0 1-21.4 31.3zM62.69 19V6.04h2.14V19H62.7zm4.27-6.3l4.5 6.3h-2.44l-3.47-5.1v-2.56l3.15-5.3h2.4l-4.14 6.67zm8.63-.24c0-1.04.12-1.96.37-2.76.26-.8.6-1.49 1.05-2.04.46-.56 1-.99 1.6-1.28.62-.3 1.3-.48 2.02-.53v1.76a2.71 2.71 0 0 0-2.04 1.25c-.25.38-.46.88-.61 1.47a9.23 9.23 0 0 0 0 4.28c.15.58.36 1.07.61 1.47.27.4.58.7.94.92.35.2.72.31 1.1.35v1.74a4.87 4.87 0 0 1-3.62-1.8 6.42 6.42 0 0 1-1.05-2.05 9.55 9.55 0 0 1-.37-2.78zm5.75-6.6a4.93 4.93 0 0 1 3.58 1.8c.46.55.82 1.23 1.07 2.04.26.8.4 1.72.4 2.76 0 1.04-.14 1.97-.4 2.78-.25.8-.61 1.5-1.07 2.05a4.75 4.75 0 0 1-3.58 1.8v-1.74c.4-.05.77-.17 1.12-.37.35-.21.66-.51.92-.9.25-.4.46-.89.61-1.47a9.3 9.3 0 0 0 0-4.28 4.52 4.52 0 0 0-.63-1.47 2.66 2.66 0 0 0-2.02-1.27V5.85zm8.89.18h2.4l2.73 10.17v2.86h-1.1L90.23 6.04zm8.6 0h2.39L97 19.07h-.92v-3.43l2.75-9.6zM115.9 19h-2.18l-3.36-9.7-3.39 9.7h-2.2l4.54-12.94h2.09l4.5 12.94zm-4.38-4.11l.51 1.42h-3.36l.5-1.42h2.35zm.48-12.59l-1.92 2.5h-1.4l1.17-2.5h2.15zm15.38 6.24a2.56 2.56 0 0 0-1.85-.95V5.85c1.31.06 2.42.52 3.3 1.39l-1.45 1.3zm-1.85 8.8a2.8 2.8 0 0 0 1.85-.94l1.46 1.28a4.85 4.85 0 0 1-3.3 1.4v-1.73zm-5.7-4.88c0-1.04.13-1.96.38-2.76.25-.8.6-1.47 1.05-2.02a4.81 4.81 0 0 1 3.55-1.83v1.76a2.86 2.86 0 0 0-1.99 1.28c-.25.39-.46.88-.61 1.48a9.66 9.66 0 0 0 0 4.2c.15.59.36 1.08.61 1.48a2.78 2.78 0 0 0 1.99 1.3v1.72a4.81 4.81 0 0 1-3.55-1.81 6.24 6.24 0 0 1-1.05-2.02 9.55 9.55 0 0 1-.37-2.78zm19.43-4.41a1.05 1.05 0 0 1-.21-.12 2.8 2.8 0 0 0-.93-.3 4.34 4.34 0 0 0-.9-.02V5.83a9 9 0 0 1 1.56.18c.54.1.98.25 1.3.46a23.5 23.5 0 0 1-.82 1.58zm-6.07 1.4a3.49 3.49 0 0 1 .97-2.46c.3-.31.66-.56 1.06-.73.4-.2.83-.31 1.28-.37v1.84c-.38.13-.69.36-.93.69a1.62 1.62 0 0 0 0 2.07c.24.28.55.53.93.74v2a26.6 26.6 0 0 1-1.16-.6 5.8 5.8 0 0 1-1.06-.77 3 3 0 0 1-1.09-2.4zm.29 7.18c.16.1.36.18.61.28l.8.24c.26.07.53.13.8.18.27.05.52.07.76.07h.05v1.67h-.04a7.67 7.67 0 0 1-2.65-.47c-.27-.13-.5-.29-.7-.46l.37-1.51zm3.74-5.05l1.18.56c.4.2.78.45 1.1.74.33.28.6.63.81 1.04.21.41.32.92.32 1.53a3.52 3.52 0 0 1-1.97 3.13c-.42.22-.9.37-1.44.44v-1.69c.96-.23 1.44-.87 1.44-1.92 0-.4-.13-.75-.4-1.02a4.68 4.68 0 0 0-1.04-.75v-2.06zm6.78.88c0-1.04.13-1.96.37-2.76.26-.8.61-1.49 1.06-2.04.45-.56.99-.99 1.6-1.28.62-.3 1.3-.48 2.02-.53v1.76a2.72 2.72 0 0 0-2.04 1.25c-.26.38-.46.88-.62 1.47a9.26 9.26 0 0 0 0 4.28c.16.58.36 1.07.62 1.47.27.4.58.7.93.92.35.2.72.31 1.1.35v1.74a4.87 4.87 0 0 1-3.62-1.8 6.43 6.43 0 0 1-1.05-2.05 9.55 9.55 0 0 1-.37-2.78zm5.75-6.6c.72.03 1.38.2 1.99.5.62.3 1.15.74 1.6 1.3.45.55.81 1.23 1.07 2.04a9 9 0 0 1 .39 2.76c0 1.04-.13 1.97-.39 2.78-.26.8-.62 1.5-1.07 2.05a4.74 4.74 0 0 1-3.59 1.8v-1.74c.4-.05.78-.17 1.13-.37.35-.21.65-.51.91-.9.26-.4.46-.89.62-1.47a9.35 9.35 0 0 0 0-4.28 4.55 4.55 0 0 0-.64-1.47 2.67 2.67 0 0 0-2.02-1.27V5.85zm11.62.18V17.4h5.96V19h-8.1V6.04h2.14zm18.68 0V7.5h-3.86V19h-2.13V7.49h-3.87V6.04h9.86zm-117.4 23h2.1V42h-2.1V29.04zm3.72 0c.55 0 1.1.1 1.63.27a4.32 4.32 0 0 1 2.48 2.07c.27.5.4 1.05.4 1.67 0 .66-.1 1.26-.33 1.8a3.76 3.76 0 0 1-2.37 2.18c-.56.2-1.18.3-1.86.3h-.85v-1.55h1.22a2.03 2.03 0 0 0 1.46-.56c.2-.2.38-.48.5-.83a4.02 4.02 0 0 0 .11-2.06 1.95 1.95 0 0 0-.37-.79 1.94 1.94 0 0 0-.76-.63 2.76 2.76 0 0 0-1.3-.27h-.86v-1.6h.9zm8.1 6.42c0-1.04.12-1.96.37-2.76.26-.8.61-1.49 1.06-2.04.45-.56.99-.99 1.6-1.28.62-.3 1.29-.48 2.02-.53v1.76a2.71 2.71 0 0 0-2.04 1.25c-.26.38-.47.88-.62 1.47a9.22 9.22 0 0 0 0 4.28c.15.58.36 1.07.62 1.47.27.4.58.7.93.92.35.2.72.31 1.1.35v1.74a4.87 4.87 0 0 1-3.62-1.8 6.42 6.42 0 0 1-1.05-2.05 9.55 9.55 0 0 1-.37-2.78zm5.75-6.6a4.93 4.93 0 0 1 3.59 1.8c.45.55.81 1.23 1.07 2.04.26.8.38 1.72.38 2.76 0 1.04-.12 1.97-.38 2.78-.26.8-.62 1.5-1.07 2.05a4.75 4.75 0 0 1-3.6 1.8v-1.74c.4-.05.78-.17 1.13-.37.36-.21.66-.51.92-.9.26-.4.46-.89.61-1.47a9.31 9.31 0 0 0 0-4.28 4.52 4.52 0 0 0-.63-1.47 2.66 2.66 0 0 0-2.02-1.27v-1.74zm1.3-3.56l-1.92 2.5h-1.4l1.18-2.5h2.14zm10.32 3.74V40.4h5.96V42h-8.1V29.04h2.14zm9.28 6.42c0-1.04.12-1.96.37-2.76.25-.8.6-1.49 1.05-2.04.46-.56 1-.99 1.6-1.28.62-.3 1.3-.48 2.02-.53v1.76a2.71 2.71 0 0 0-2.04 1.25c-.25.38-.46.88-.61 1.47a9.2 9.2 0 0 0 0 4.28c.15.58.36 1.07.61 1.47.27.4.58.7.93.92.36.2.72.31 1.11.35v1.74a4.87 4.87 0 0 1-3.62-1.8 6.41 6.41 0 0 1-1.05-2.05 9.55 9.55 0 0 1-.37-2.78zm5.75-6.6a4.93 4.93 0 0 1 3.58 1.8c.46.55.82 1.23 1.07 2.04.26.8.39 1.72.39 2.76 0 1.04-.13 1.97-.39 2.78-.25.8-.61 1.5-1.07 2.05a4.75 4.75 0 0 1-3.58 1.8v-1.74c.4-.05.77-.17 1.12-.37.35-.21.66-.51.91-.9.26-.4.47-.89.62-1.47a9.24 9.24 0 0 0 0-4.28 4.5 4.5 0 0 0-.63-1.47 2.65 2.65 0 0 0-2.03-1.27v-1.74zm1.3-3.56l-1.92 2.5h-1.4l1.17-2.5h2.15z"/></svg>
      </div>

      <hr class="sidebar-divider my-0">

      <li class="nav-item">
        <a class="nav-link" href="{{ base_url('admin/dashboard') }}">
          <i class="fas fa-fw fa-home"></i>
          <span>Kezdőooldal</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ base_url('admin/design') }}">
          <i class="fas fa-fw fa-icons"></i>
          <span>Minták</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ base_url('admin/base_product') }}">
          <i class="fas fa-fw fa-tshirt"></i>
          <span>Termékek</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ base_url('admin/product') }}">
          <i class="fas fa-fw fa-paint-brush"></i>
          <span>Dizájnolt termékek</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ base_url('admin/order') }}">
          <i class="fas fa-fw fa-shopping-bag"></i>
          <span>Rendelések</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ base_url('admin/message') }}">
          <i class="fas fa-fw fa-envelope"></i>
          <span>Üzenetek</span></a>
      </li>
    </ul>
  @endif

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <div class="container-fluid">
          @yield('content')
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('admin/sb-admin-2.min.js') }}"></script>
  <script>
    const dataTableTranslations = {
      'sEmptyTable': 'Nincs rendelkezésre álló adat',
      'sInfo': 'Találatok: _START_ - _END_ Összesen: _TOTAL_',
      'sInfoEmpty': '0 találat',
      'sInfoFiltered': '(_MAX_ összes rekord közül szűrve)',
      'sInfoPostFix': '',
      'sInfoThousands': ' ',
      'sLengthMenu': '_MENU_ találat oldalanként',
      'sLoadingRecords': 'Betöltés...',
      'sProcessing': 'Feldolgozás...',
      'sSearch': 'Keresés:',
      'sZeroRecords': 'Nincs a keresésnek megfelelő találat',
      'oPaginate': {
        'sFirst': 'Első',
        'sPrevious': 'Előző',
        'sNext': 'Következő',
        'sLast': 'Utolsó'
      },
      'oAria': {
        'sSortAscending': ': aktiválja a növekvő rendezéshez',
        'sSortDescending': ': aktiválja a csökkenő rendezéshez'
      },
      'select': {
       'rows': {
          '_': '%d sor kiválasztva',
          '0': '',
          '1': '1 sor kiválasztva'
        }
      },
      'buttons': {
        'print': 'Nyomtatás',
        'colvis': 'Oszlopok',
        'copy': 'Másolás',
        'copyTitle': 'Vágólapra másolás',
        'copySuccess': {
          '_': '%d sor másolva',
          '1': '1 sor másolva'
        }
      }
    };
  </script>
  @yield('footer')
</body>
</html>
