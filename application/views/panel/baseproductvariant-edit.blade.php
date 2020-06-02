@extends('layouts.panel')

@section('title', 'Base Product View')

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="d-sm-flex align-items-center mb-4 mt-4">
      <h1 class="h3 mb-0 text-gray-800">Változat szerkesztése</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="post" action="{{ base_url('admin/base_product_variant/' . $baseProductVariant->id) }}" enctype="multipart/form-data">
          <div class="form-group">
            <label for="base_product_view_id">Nézet:</label>
            <select class="custom-select" id="base_product_view_id" name="base_product_view_id">
              @foreach($baseProductViews as $baseProductView)
                <option value="{{ $baseProductView->id }}" {{ $baseProductView->id === $baseProductVariant->base_product_view_id ? 'selected' : '' }}>
                  {{ $baseProductView->name }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="base_product_color_id">Szín:</label>
            <select class="custom-select" id="base_product_color_id" name="base_product_color_id">
              @foreach($baseProductColors as $baseProductColor)
                <option value="{{ $baseProductColor->id }}" {{ $baseProductColor->id === $baseProductVariant->base_product_color_id ? 'selected' : '' }}>
                  {{ $baseProductColor->name }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="base_product_zone_id">Zóna:</label>
            <select class="custom-select" id="base_product_zone_id" name="base_product_zone_id">
              <option>---</option>
              @foreach($baseProductZones as $baseProductZone)
                <option value="{{ $baseProductZone->id }}" {{ $baseProductZone->id === $baseProductVariant->base_product_zone_id ? 'selected' : '' }}>
                  {{ $baseProductZone->name }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="image">Kép:</label>
            <input type="file" name="image" class="form-control" id="image">
            <div class="mt-4">
              <img src="{{ base_url('media/variant/' . $baseProductVariant->id) }}" style="width: 100px; height: 100px;">
            </div>
          </div>

          <input type="submit" class="btn btn-primary float-right" value="Mentés">
        </form>
    </div>
  </div>
@endsection
