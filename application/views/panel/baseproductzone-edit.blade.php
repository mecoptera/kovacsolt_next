@extends('layouts.panel')

@section('title', 'Base Product Zone')

@section('content')
<div class="d-sm-flex align-items-center mb-4 mt-4">
  <h1 class="h3 mb-0 text-gray-800">Zóna szerkesztése</h1>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="post" action="{{ base_url('admin/base_product_zone/' . $baseProductZone->id) }}">
          <div class="form-group">
            <label for="name">Név:</label>
            <input type="text" name="name" id="name" placeholder="Név" class="form-control" value="{{ $baseProductZone ? $baseProductZone->name : '' }}">
          </div>

          <div class="form-group">
            <label for="base_product_variant_id">Változatokhoz csatolás:</label>
            <select class="custom-select" name="base_product_variant_id[]" id="base_product_variant_id" multiple>
              @foreach($baseProductVariants as $baseProductVariant)
                <option value="{{ $baseProductVariant->id }}"  {{ $baseProductVariant->base_product_zone_id === $baseProductZone->id ? 'selected' : '' }}>
                  {{ $baseProductVariant->base_product_view_name }} | {{ $baseProductVariant->base_product_color_name }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="left">Balról:</label>
            <input type="number" name="left" id="left" placeholder="Balról" class="form-control" value="{{ $baseProductZone ? $baseProductZone->left : 0 }}" max="100" min="0">
          </div>

          <div class="form-group">
            <label for="top">Fentről:</label>
            <input type="number" name="top" id="top" placeholder="Fentről" class="form-control" value="{{ $baseProductZone ? $baseProductZone->top : 0 }}" max="100" min="0">
          </div>

          <div class="form-group">
            <label for="width">Szélesség:</label>
            <input type="number" step="any" name="width" id="width" placeholder="Szélesség" class="form-control" value="{{ $baseProductZone ? $baseProductZone->width : 0 }}" max="100" min="0">
          </div>

          <div class="form-group">
            <label for="height">Magasság:</label>
            <input type="number" name="height" id="height" placeholder="Magasság" class="form-control" value="{{ $baseProductZone ? $baseProductZone->height : 0 }}" max="100" min="0">
          </div>

          <input type="submit" class="btn btn-primary float-right" value="Mentés">
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="form-group">
          <label for="zone-image-select">Zóna háttere:</label>
          <select class="custom-select" id="zone-image-select">
            @foreach($baseProductVariants as $baseProductVariant)
              <option value="{{ base_url('media/variant/' . $baseProductVariant->id) }}" {{ $baseProductVariant->base_product_zone_id === $baseProductZone->id ? 'selected' : '' }}>
                {{ $baseProductVariant->base_product_view_name }} | {{ $baseProductVariant->base_product_color_name }}
              </option>
            @endforeach
          </select>
        </div>

        <div id="zone-image" style="position: relative; width: 100%; padding-bottom: 100%; background-color: #f8f9fc; background-position: center; background-repeat: no-repeat; background-size: contain;">
          <div id="zone" style="position: absolute; outline: 2px dashed #333;"></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('footer')
<script>
  const nameInputElement = document.querySelector('#name');
  const viewIdSelectElement = document.querySelector('#view_id');
  const widthInputElement = document.querySelector('#width');
  const heightInputElement = document.querySelector('#height');
  const leftInputElement = document.querySelector('#left');
  const topInputElement = document.querySelector('#top');
  const zoneElement = document.querySelector('#zone');
  const zoneImageElement = document.querySelector('#zone-image');

  document.querySelector('#zone-image-select').addEventListener('change', event => {
    zoneImageElement.style.backgroundImage = `url(${event.target.value})`;
  });
  zoneImageElement.style.backgroundImage = `url(${document.querySelector('#zone-image-select').value})`;

  widthInputElement.addEventListener('change', event => {
    zoneElement.style.width = widthInputElement.value + '%';
  });
  heightInputElement.addEventListener('change', event => {
    zoneElement.style.height = heightInputElement.value + '%';
  });
  leftInputElement.addEventListener('change', event => {
    zoneElement.style.left = leftInputElement.value + '%';
  });
  topInputElement.addEventListener('change', event => {
    zoneElement.style.top = topInputElement.value + '%';
  });
  zoneElement.style.width = widthInputElement.value + '%';
  zoneElement.style.height = heightInputElement.value + '%';
  zoneElement.style.left = leftInputElement.value + '%';
  zoneElement.style.top = topInputElement.value + '%';

  if ({{ $baseProductZone ? 'false' : 'true' }}) {
    viewIdSelectElement.addEventListener('change', () => {
      nameInputElement.value = viewIdSelectElement.querySelector('option[value="'+viewIdSelectElement.value+'"]').dataset.alias;
    });
    nameInputElement.value = viewIdSelectElement.querySelector('option[value="'+viewIdSelectElement.value+'"]').dataset.alias;
  }
</script>
@endsection
