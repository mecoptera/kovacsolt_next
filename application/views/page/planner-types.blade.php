@extends('layouts.page')

@section('title', 'Tervező')

@section('content')
  <div class="l-container">
    <h3 class="u-text-center">Válassz terméket az alábbiak közül:</h3>

    <div class="q-products l-grid">
      @foreach($baseProducts as $baseProduct)
        <div class="l-grid__col--3">
          <k-base-product-card class="u-m-4" data-detail="{{ htmlspecialchars(json_encode($baseProduct), ENT_QUOTES, 'UTF-8') }}" data-url="{{ base_url('planner/editor/' . $baseProduct->id) }}"></k-base-product-card>
        </div>
      @endforeach
    </div>
  </div>
@endsection
