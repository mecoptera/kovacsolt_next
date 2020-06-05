@extends('layouts.page')

@section('title', 'Felhasználói fiók')

@section('content')
  <div class="l-container">
    <div class="c-panel u-relative">
      <div class="c-panel__content">
        <h1 class="c-panel__title">Fiók beállításai</h1>

        <div class="u-absolute" style="top: 16px; right: 16px;">
          <a class="c-button c-button--outline c-button--small" href="{{ base_url('logout') }}">Kijelentkezés</a>
        </div>

        <form class="l-form" method="post" action="{{ current_url() }}">
          <div class="l-grid">
            <div class="l-grid__col--6 l-grid__col--offset-3">
            @if($this->session->flashdata('success'))
              <k-notification data-status="success" class="u-mb-16">A változtatások sikeresen mentésre kerültek a rendszerben</k-notification>
            @endif
            @if ($this->session->flashdata('passwordSuccess'))
              <k-notification data-status="success" class="u-mb-16">Minden szükséges információt elküldtünk e-mailben a megadott címre</k-notification>
            @endif

              <div>
                <k-input
                  data-name="fullname"
                  data-label="Név"
                  data-helper="Nem kötelező megadni"
                  data-value="{{ $user->fullname }}"
                ></k-input>
              </div>

              <div>
                <k-input
                  data-label="E-mail cím"
                  data-value="{{ $user->email }}"
                  data-disabled
                ></k-input>
              </div>

              <div>
                <k-input
                  data-name="phone"
                  data-label="Telefonszám"
                  data-helper="Nem kötelező megadni"
                  data-value="{{ $user->phone }}"
                ></k-input>
              </div>

              <div class="l-form__field">
                <a href="{{ base_url('user/change_password') }}" class="c-link">Jelszó megváltoztatása</a>
                <div class="u-helper">E-mailt fogunk küldeni, melyben egy linket találsz a jelszó megváltoztatásához</div>
              </div>

              <div class="l-form__field u-text-center">
                <input type="submit" class="c-button" value="Mentés">
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
