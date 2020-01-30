@extends('layouts.panel')

@section('title', 'Base Products')

@section('head')
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="d-sm-flex align-items-center mb-4 mt-4">
      <h1 class="h3 mb-0 text-gray-800">Edit product</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="post" action="{{ base_url('panel/base_product/edit/' . $baseProduct->id) }}">
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{ $baseProduct->name }}">
          </div>

          <input type="submit" class="btn btn-primary float-right" value="Save">
        </form>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="d-sm-flex align-items-center mb-4 mt-4">
      <h1 class="h3 mb-0 text-gray-800">Add view</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="post" action="{{ base_url('panel/base_product_view/create/' . $baseProduct->id) }}">
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="Name" class="form-control">
          </div>

          <input type="submit" class="btn btn-primary float-right" value="Add">
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="d-sm-flex align-items-center mb-4 mt-4">
      <h1 class="h3 mb-0 text-gray-800">Views</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTableViews" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($baseProductViews as $baseProductView)
                <tr>
                  <td>{{ $baseProductView->name }}</td>
                  <td>
                    <a href="{{ base_url('panel/base_product_view/' . $baseProductView->id) }}"><i class="fas fa-fw fa-pen"></i> Edit</a>
                    <a href="{{ base_url('panel/base_product_view/delete' . $baseProductView->id) }}"><i class="fas fa-fw fa-trash"></i> Delete</a>
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

<div class="row">
  <div class="col-lg-6">
    <div class="d-sm-flex align-items-center mb-4 mt-4">
      <h1 class="h3 mb-0 text-gray-800">Add color</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="post" action="{{ base_url('panel/base_product_color/create/' . $baseProduct->id) }}">
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="Name" class="form-control">
          </div>
          <div class="form-group">
            <label for="value">Value:</label>
            <input type="color" name="value" id="value" placeholder="Value" class="form-control" style="width: 128px;">
          </div>

          <input type="submit" class="btn btn-primary float-right" value="Add">
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="d-sm-flex align-items-center mb-4 mt-4">
      <h1 class="h3 mb-0 text-gray-800">Colors</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTableColors" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Color</th>
                <th>Name</th>
                <th>Value</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($baseProductColors as $baseProductColor)
                <tr>
                  <td><div style="display: inline-block; width: 32px; height: 32px; background-color: {{ $baseProductColor->value }}; border: 2px solid #e3e6f0;"></div></td>
                  <td>{{ $baseProductColor->name }}</td>
                  <td>{{ $baseProductColor->value }}</td>
                  <td>
                    <a href="{{ base_url('panel/base_product_color/' . $baseProductColor->id) }}"><i class="fas fa-fw fa-pen"></i> Edit</a>
                    <a href="{{ base_url('panel/base_product_color/delete/' . $baseProductColor->id) }}"><i class="fas fa-fw fa-trash"></i> Delete</a>
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

<div class="row">
  <div class="col-lg-6">
    <div class="d-sm-flex align-items-center mb-4 mt-4">
      <h1 class="h3 mb-0 text-gray-800">Add variant</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="post" action="{{ base_url('panel/base_product_variant/create/' . $baseProduct->id) }}" enctype="multipart/form-data">
          <div class="form-group">
            <label for="base_product_view_id">View:</label>
            <select class="custom-select" id="base_product_view_id" name="base_product_view_id">
              @foreach($baseProductViews as $baseProductView)
                <option value="{{ $baseProductView->id }}">{{ $baseProductView->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="base_product_color_id">Color:</label>
            <select class="custom-select" id="base_product_color_id" name="base_product_color_id">
              @foreach($baseProductColors as $baseProductColor)
                <option value="{{ $baseProductColor->id }}">{{ $baseProductColor->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" class="form-control" id="image">
          </div>

          <input type="submit" class="btn btn-primary float-right" value="Add">
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="d-sm-flex align-items-center mb-4 mt-4">
      <h1 class="h3 mb-0 text-gray-800">Variants</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTableVariants" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Image</th>
                <th>Variant</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($baseProductVariants as $baseProductVariant)
                <tr>
                  <td>
                    <img src="{{ base_url('media/variant/' . $baseProductVariant->id) }}" style="width: 100px; height: 100px;">
                  </td>
                  <td>
                    @if($baseProductVariant->default)
                      <div><b>Default</b></div>
                    @endif

                    <div>View: <b>{{ $baseProductVariant->base_product_view_name }}</b></div>
                    <div>Color: <b>{{ $baseProductVariant->base_product_color_name }}</b></div>
                    <div>Zone: <b>{{ $baseProductVariant->base_product_zone_id ? $baseProductVariant->base_product_zone_name : '---' }}</b></div>
                  </td>
                  <td>
                    <a href="{{ base_url('panel/base_product_variant/' . $baseProductVariant->id) }}"><i class="fas fa-fw fa-pen"></i> Edit</a>
                    <a href="{{ base_url('panel/base_product_variant/delete/' . $baseProductVariant->id) }}"><i class="fas fa-fw fa-trash"></i> Delete</a>
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


<div class="row">
  <div class="col-lg-6">
    <div class="d-sm-flex align-items-center mb-4 mt-4">
      <h1 class="h3 mb-0 text-gray-800">Add zone</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="post" action="{{ base_url('panel/base_product_zone/create/' . $baseProduct->id) }}">
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="Name" class="form-control">
          </div>

          <input type="submit" class="btn btn-primary float-right" value="Add">
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="d-sm-flex align-items-center mb-4 mt-4">
      <h1 class="h3 mb-0 text-gray-800">Zones</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTableZones" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($baseProductZones as $baseProductZone)
                <tr>
                  <td>{{ $baseProductZone->name }}</td>
                  <td>
                    <a href="{{ base_url('panel/base_product_zone/' . $baseProductZone->id) }}"><i class="fas fa-fw fa-pen"></i> Edit</a>
                    <a href="{{ base_url('panel/base_product_zone/delete/' . $baseProductZone->id) }}"><i class="fas fa-fw fa-trash"></i> Delete</a>
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
<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
$(document).ready(function() {
  $('#dataTableColors').DataTable({
    order: [],
    columnDefs: [
      {
        targets: 3,
        className: 'dt-body-right'
      }
    ]
  });

  $('#dataTableViews').DataTable({
    order: [],
    columnDefs: [
      {
        targets: 1,
        className: 'dt-body-right'
      }
    ]
  });

  $('#dataTableVariants').DataTable({
    order: [],
    columnDefs: [
      {
        targets: 2,
        className: 'dt-body-right'
      }
    ]
  });

  $('#dataTableZones').DataTable({
    order: [],
    columnDefs: [
      {
        targets: 1,
        className: 'dt-body-right'
      }
    ]
  });
});
</script>
@endsection
