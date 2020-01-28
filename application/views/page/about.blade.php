@extends('layouts.page')

@section('title', 'Adatkezelési tájékoztató')

@section('content')
  <div class="l-container">
    <div class="c-panel">
      <div class="c-panel__content">
        <h1 class="c-panel__title">Rólunk</h1>

        <?php echo $this->markdown->parse_file(APPPATH . 'views_md/about.md'); ?>
      </div>
    </div>
  </div>
@endsection
