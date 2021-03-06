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
        <svg xmlns="http://www.w3.org/2000/svg" width="185" height="50" viewBox="0 0 185 50" fill="none"><path fill="#fff" d="M29 39.26a31.93 31.93 0 01-18.12-28.78c0-.83.06-1.63.12-2.44.72-.5 1.47-.95 2.23-1.38A20.63 20.63 0 0029 13.98v25.28zM29 37v2.26a31.94 31.94 0 0018.12-28.78c0-.79-.05-1.56-.11-2.33v-.1c-.73-.5-1.48-.96-2.24-1.39A20.63 20.63 0 0129 13.98v2a22.4 22.4 0 0016.08-6.7A29.6 29.6 0 0129 37z"/><path fill="#fff" fill-rule="evenodd" d="M19.28 4A11.47 11.47 0 0029 9.38v2.3c-5.27 0-9.94-2.55-12.87-6.47A31.8 31.8 0 0119.28 4zM29 11.68v-2.3c4.1 0 7.69-2.15 9.72-5.38 1.08.35 2.13.76 3.15 1.21A16.05 16.05 0 0129 11.68z" clip-rule="evenodd"/><path fill="#fff" d="M31.6 44.67L29 45.92l-2.6-1.25A38.2 38.2 0 015 13.37c.9-1.03 1.86-2 2.88-2.9v.02A35.15 35.15 0 0027.7 41.97l1.3.62 1.3-.62a35.16 35.16 0 0019.82-31.48v-.01A32.3 32.3 0 0153 13.36a38.2 38.2 0 01-21.4 31.3zM71.92 21h-3.59l-3.67-5.48c-.07-.1-.18-.33-.34-.69h-.04V21h-2.84V8.4h2.84v5.96h.04c.07-.17.2-.4.36-.7l3.48-5.26h3.38l-4.4 6 4.78 6.6zm7.45.22c-1.8 0-3.28-.59-4.41-1.76a6.34 6.34 0 01-1.7-4.6c0-1.99.57-3.6 1.72-4.83a6 6 0 014.6-1.84c1.8 0 3.24.58 4.35 1.76a6.5 6.5 0 011.67 4.66c0 1.98-.58 3.58-1.73 4.79a5.91 5.91 0 01-4.5 1.82zm.12-10.6c-1 0-1.78.38-2.37 1.13a4.65 4.65 0 00-.88 2.97c0 1.24.3 2.23.88 2.96a2.82 2.82 0 002.3 1.09c.98 0 1.76-.35 2.33-1.06.58-.7.86-1.69.86-2.94 0-1.3-.28-2.32-.83-3.05a2.72 2.72 0 00-2.29-1.1zM99.64 8.4L95.29 21h-3.21l-4.3-12.6h3.07l2.62 8.77c.15.47.23.9.26 1.25h.05c.04-.39.13-.82.27-1.29l2.62-8.73h2.97zm13.1 12.6h-3.1l-.9-2.8h-4.47l-.9 2.8h-3.07l4.59-12.6h3.37l4.48 12.6zm-4.64-4.98l-1.35-4.24a5.5 5.5 0 01-.22-1.13h-.07c-.03.37-.1.73-.22 1.1l-1.37 4.27h3.23zm1.22-11.63l-2.75 2.84h-2l2.28-2.84h2.47zm15.47 16.16c-.92.45-2.12.67-3.6.67-1.94 0-3.46-.57-4.57-1.7a6.23 6.23 0 01-1.66-4.55c0-2.01.62-3.65 1.86-4.9a6.55 6.55 0 014.86-1.88c1.23 0 2.26.15 3.1.46v2.73a5.5 5.5 0 00-2.88-.75c-1.18 0-2.13.37-2.86 1.12a4.14 4.14 0 00-1.1 3.02c0 1.22.35 2.19 1.04 2.92.68.72 1.6 1.08 2.77 1.08a5.9 5.9 0 003.04-.81v2.6zm3.05-.03V17.7a5.46 5.46 0 003.48 1.29c.35 0 .66-.03.93-.1.27-.06.49-.15.67-.26.18-.12.31-.25.4-.4.09-.17.13-.34.13-.52 0-.24-.07-.46-.2-.66-.15-.19-.34-.37-.59-.53a5.77 5.77 0 00-.86-.48l-1.08-.46a5.56 5.56 0 01-2.2-1.5 3.3 3.3 0 01-.73-2.15c0-.66.13-1.22.4-1.69.26-.47.62-.86 1.07-1.17.46-.3.98-.52 1.58-.66.6-.15 1.23-.22 1.9-.22.66 0 1.24.04 1.74.12.51.07.98.2 1.4.36v2.63a4.95 4.95 0 00-2.25-.83c-.25-.03-.5-.05-.73-.05-.32 0-.62.03-.88.1-.26.05-.49.14-.67.25-.18.11-.32.25-.42.4a1.02 1.02 0 00.02 1.09c.1.17.27.33.47.48.2.14.46.3.75.44l1 .44c.5.2.95.43 1.34.67.41.24.75.5 1.04.8.29.3.5.65.66 1.03.15.38.23.83.23 1.34a3.26 3.26 0 01-1.48 2.94c-.46.29-1 .5-1.6.63a10.75 10.75 0 01-3.9.02 5.95 5.95 0 01-1.62-.53zm17.44.7c-1.8 0-3.28-.59-4.41-1.76a6.34 6.34 0 01-1.7-4.6c0-1.99.57-3.6 1.73-4.83a6 6 0 014.58-1.84c1.8 0 3.26.58 4.36 1.76a6.5 6.5 0 011.67 4.66c0 1.98-.57 3.58-1.73 4.79a5.92 5.92 0 01-4.5 1.82zm.12-10.6c-1 0-1.78.38-2.37 1.13a4.65 4.65 0 00-.88 2.97c0 1.24.3 2.23.88 2.96a2.82 2.82 0 002.3 1.09c.98 0 1.76-.35 2.33-1.06.58-.7.86-1.69.86-2.94 0-1.3-.28-2.32-.83-3.05a2.72 2.72 0 00-2.29-1.1zM162.56 21h-7.5V8.4h2.83v10.3h4.67V21zm10.8-10.3h-3.6V21h-2.84V10.7h-3.58V8.4h10.02v2.3zM64.28 36.67V41h-2.84V28.4h4.45c3.17 0 4.76 1.34 4.76 4.01 0 1.27-.45 2.3-1.37 3.08a5.41 5.41 0 01-3.65 1.17h-1.35zm0-6.08v3.92h1.12c1.5 0 2.26-.66 2.26-1.98 0-1.3-.75-1.94-2.26-1.94h-1.12zm14.98 10.64c-1.8 0-3.27-.59-4.4-1.76a6.34 6.34 0 01-1.71-4.6c0-1.99.57-3.6 1.73-4.83a6 6 0 014.59-1.84c1.8 0 3.25.58 4.36 1.76a6.5 6.5 0 011.67 4.66c0 1.98-.58 3.58-1.74 4.79a5.91 5.91 0 01-4.5 1.82zm.13-10.6c-1 0-1.79.38-2.38 1.13a4.65 4.65 0 00-.87 2.97c0 1.24.29 2.23.87 2.96a2.82 2.82 0 002.3 1.09c.99 0 1.76-.35 2.34-1.06.57-.7.86-1.69.86-2.94 0-1.3-.28-2.32-.84-3.05a2.72 2.72 0 00-2.28-1.1zm2.86-6.23l-2.75 2.84h-2l2.28-2.84h2.47zM96.52 41h-7.5V28.4h2.84v10.3h4.66V41zm8.02.22c-1.8 0-3.28-.59-4.41-1.76a6.34 6.34 0 01-1.7-4.6c0-1.99.57-3.6 1.72-4.83a6 6 0 014.6-1.84c1.79 0 3.24.58 4.35 1.76a6.5 6.5 0 011.67 4.66c0 1.98-.58 3.58-1.73 4.79a5.92 5.92 0 01-4.5 1.82zm.12-10.6c-1 0-1.78.38-2.37 1.13a4.65 4.65 0 00-.88 2.97c0 1.24.3 2.23.88 2.96a2.82 2.82 0 002.3 1.09c.98 0 1.76-.35 2.33-1.06.58-.7.86-1.69.86-2.94 0-1.3-.28-2.32-.83-3.05a2.72 2.72 0 00-2.29-1.1zm2.87-6.23l-2.75 2.84h-2l2.28-2.84h2.47z"/></svg>
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
