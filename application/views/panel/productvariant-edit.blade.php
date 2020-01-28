@extends('layouts.panel')

@section('title', 'Designed Product Edit')

@section('content')
<div class="d-sm-flex align-items-center mb-4 mt-4">
  <h1 class="h3 mb-0 text-gray-800">Edit product variant</h1>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="post" action="{{ base_url('panel/product_variant/' . $productVariant->id) }}">
          <div class="form-group">
            <label for="design_width">Width:</label>
            <input type="number" step="any" name="design_width" id="design_width" placeholder="Design width" class="form-control" value="{{ $productVariant->design_width }}" max="100" min="0">
          </div>

          <div class="form-group">
            <label for="design_left">Left:</label>
            <input type="number" name="design_left" id="design_left" placeholder="Design left" class="form-control" value="{{ $productVariant->design_left }}" max="100" min="0">
          </div>

          <div class="form-group">
            <label for="design_top">Top:</label>
            <input type="number" name="design_top" id="design_top" placeholder="Design top" class="form-control" value="{{ $productVariant->design_top }}" max="100" min="0">
          </div>

          <input type="submit" class="btn btn-primary float-right" value="Save">
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div style="position: relative; padding-bottom: 100%; width: 100%; background-position: center; background-repeat: no-repeat; background-size: contain; background-image: url('{{ base_url('media/variant/' . $productVariant->base_product_variant_id) }}')">
          <div style="position: absolute; width: {{ $productVariant->base_product_zone_width }}%; height: {{ $productVariant->base_product_zone_height }}%; left: {{ $productVariant->base_product_zone_left }}%; top: {{ $productVariant->base_product_zone_top }}%;">
            <img id="design" src="{{ base_url('media/design/' . $productVariant->design_id) }}" style="position: absolute; width: {{ $productVariant->design_width }}%; left: {{ $productVariant->design_left }}%; top: {{ $productVariant->design_top }}%;">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('footer')
<script>
  const designElement = document.querySelector('#design');
  const widthInputElement = document.querySelector('#design_width');
  const leftInputElement = document.querySelector('#design_left');
  const topInputElement = document.querySelector('#design_top');

  widthInputElement.addEventListener('change', event => {
    designElement.style.width = widthInputElement.value + '%';
  });
  leftInputElement.addEventListener('change', event => {
    designElement.style.left = leftInputElement.value + '%';
  });
  topInputElement.addEventListener('change', event => {
    designElement.style.top = topInputElement.value + '%';
  });

  designElement.style.width = widthInputElement.value + '%';
  designElement.style.left = leftInputElement.value + '%';
  designElement.style.top = topInputElement.value + '%';
</script>
@endsection
