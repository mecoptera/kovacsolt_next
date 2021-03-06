@extends('layouts.panel')

@section('title', 'Designed Product Edit')

@section('head')

@endsection

@section('content')
<div class="d-sm-flex align-items-center mb-4 mt-4">
  <h1 class="h3 mb-0 text-gray-800">Dizájnolt termék szerkesztése</h1>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="post" action="{{ current_url() }}">
          <div class="form-group">
            <label for="name">Név:</label>
            <input type="text" name="name" id="name" placeholder="Név" class="form-control" value="{{ $product->name }}">
          </div>

          <div class="form-group">
            <label for="name">Leírás:</label>
            <textarea type="text" name="description" id="description" placeholder="Leírás" class="form-control">{{ $product->description }}</textarea>
          </div>

          <div class="form-group">
            <label for="base_product">Termék:</label>
            <select class="custom-select" id="base_product" name="base_product">
              @foreach($baseProducts as $baseProduct)
                <option value="{{ $baseProduct->id }}" {{ $product->base_product_id === $baseProduct->id ? 'selected' : ''}}>{{ $baseProduct->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="price">Ár:</label>
            <input type="number" name="price" id="price" placeholder="Ár" class="form-control" value="{{ $product->price }}">
          </div>

          <div class="form-group">
            <label for="price">Kedvezmény:</label>
            <input type="number" name="discount" id="price" placeholder="Kedvezmény" class="form-control" value="{{ $product->discount }}" max="100" min="0">
          </div>

          <div class="form-group">
            <input type="checkbox" name="show_on_welcome" id="show_on_welcome" {{ $product->show_on_welcome ? 'checked' : '' }}>
            <label for="show_on_welcome">Megjelenítés a kezdőoldalon</label>
          </div>

          <div class="form-group">
            <input type="checkbox" name="is_public" id="is_public" {{ $product->is_public ? 'checked' : '' }}>
            <label for="is_public">Publikált</label>
          </div>

          <input type="submit" class="btn btn-primary float-right" value="Mentés">
        </form>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="d-sm-flex align-items-center mb-4 mt-4">
      <h1 class="h3 mb-0 text-gray-800">Változat hozzáadása</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="post" action="{{ base_url('admin/product_variant/create/' . $product->id) }}" enctype="multipart/form-data">
          <div class="form-group">
            <label for="base_product_variant_id">Változat:</label>
            <div class="row" style="max-height: 350px; overflow: auto;">
              @foreach($baseProductVariants as $baseProductVariant)
                <div class="col-lg-3 mb-4">
                  <label class="card p-4" style="cursor: pointer;">
                    <input type="radio" name="base_product_variant_id" value="{{ $baseProductVariant->id }}" url="{{ $baseProductVariant->image }}">
                    <div style="background-image: url({{ $baseProductVariant->image }}); background-size: contain; background-position: center; background-repeat: no-repeat; width: 100%; padding-bottom: 100%;"></div>
                    <span class="u-uppercase u-font-bold">{{ $baseProductVariant->base_product_view_name }} | {{ $baseProductVariant->base_product_color_name }}</span>
                  </label>
                </div>
              @endforeach
            </div>
          </div>

          <div class="form-group">
            <label for="design_id">Minta:</label>
            <div class="row" style="max-height: 350px; overflow: auto;">
              @foreach($designs as $design)
                <div class="col-lg-3 mb-4">
                  <label class="card p-4" style="cursor: pointer;">
                    <input type="radio" name="design_id" value="{{ $design->id }}" url="{{ $design->image }}">
                    <div style="background-image: url({{ $design->image }}); background-size: contain; background-position: center; background-repeat: no-repeat; width: 100%; padding-bottom: 100%;"></div>
                    <span class="u-uppercase u-font-bold">{{ $design->name }}</span>
                  </label>
                </div>
              @endforeach
            </div>
          </div>

          <input type="submit" class="btn btn-primary float-right" value="Hozzáadás">
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="d-sm-flex align-items-center mb-4 mt-4">
      <h1 class="h3 mb-0 text-gray-800">Változatok</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTableVariants" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th></th>
                <th>Végleges</th>
                <th>Termék</th>
                <th>Minta</th>
                <th>Műveletek</th>
              </tr>
            </thead>
            <tbody>
              @foreach($productVariants as $productVariant)
                <tr>
                  <td>
                    @if($productVariant->default)
                      <i class="fas fa-fw fa-star"></i>
                    @endif
                  </td>
                  <td>
                    <div style="position: relative; width: 128px; height: 128px; background-position: center; background-repeat: no-repeat; background-size: contain; background-image: url('{{ $productVariant->base_product_variant_image }}')">
                      <div style="position: absolute; width: {{ $productVariant->base_product_zone_width }}%; height: {{ $productVariant->base_product_zone_height }}%; left: {{ $productVariant->base_product_zone_left }}%; top: {{ $productVariant->base_product_zone_top }}%;">
                        <img id="design" src="{{ $productVariant->design_image }}" style="position: absolute; width: {{ $productVariant->design_width }}%; left: {{ $productVariant->design_left }}%; top: {{ $productVariant->design_top }}%;">
                      </div>
                    </div>
                  </td>
                  <td>
                    <div style="position: relative; width: 128px; height: 128px; background-position: center; background-repeat: no-repeat; background-size: contain; background-image: url('{{ $productVariant->base_product_variant_image }}')">
                    </div>
                  </td>
                  <td>
                    <div style="position: relative; width: 128px; height: 128px; background-position: center; background-repeat: no-repeat; background-size: contain; background-image: url('{{ $productVariant->design_image }}')">
                    </div>
                  </td>
                  <td>
                    <a class="mr-2" href="{{ base_url('admin/product_variant/default/' . $productVariant->id) }}"><i class="fas fa-fw fa-star"></i> Alapértelmezett</a>
                    <a class="mr-2" href="{{ base_url('admin/product_variant/' . $productVariant->id) }}"><i class="fas fa-fw fa-pen"></i> Szerkesztés</a>
                    <a href="{{ base_url('admin/product_variant/delete/' . $productVariant->id) }}"><i class="fas fa-fw fa-trash"></i> Törlés</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('footer')

@endsection
