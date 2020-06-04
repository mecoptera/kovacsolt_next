@extends('layouts.page')

@section('title', 'Új jelszó')

@section('content')
  <div class="l-container">
    <div class="c-panel">
      <div class="c-panel__content">
        <h1 class="c-panel__title">Új jelszó</h1>

        <div class="l-grid">
          <form class="u-mx-auto l-grid__col--6" method="post" action="{{ current_url() }}">
            <k-input
              data-type="password"
              data-name="password"
              data-label="Jelszó"
              @error('password')data-error="{{ $errors['password'] }}" @enderror
            >
            </k-input>

            <k-input
              data-type="password"
              data-name="password_confirmation"
              data-label="Jelszó újra"
              @error('password_confirmation')data-error="{{ $errors['password_confirmation'] }}" @enderror
            >
            </k-input>

            <div class="u-mt-8 u-text-center">
              <input type="submit" class="c-button" value="Mentés">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
