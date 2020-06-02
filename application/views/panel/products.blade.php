@extends('layouts.panel')

@section('title', 'Designed Products')

@section('head')
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="d-sm-flex align-items-center mb-4 mt-4">
  <h1 class="h3 mb-0 text-gray-800">Dizájnolt termék készítése</h1>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="post" action="{{ base_url('admin/product/create') }}">
          <div class="form-group">
            <label for="name">Név:</label>
            <input type="text" name="name" placeholder="Név" class="form-control">
          </div>

          <div class="form-group">
            <label for="base_product_id">Termék:</label>
            <select class="custom-select" id="base_product_id" name="base_product_id">
              @foreach($baseProducts as $baseProduct)
                <option value="{{ $baseProduct->id }}">{{ $baseProduct->name }}</option>
              @endforeach
            </select>
          </div>

          <input type="submit" class="btn btn-primary" value="Létrehozás">
        </form>
      </div>
    </div>
  </div>
</div>

<div class="d-sm-flex align-items-center mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dizájnolt termékek listája</h1>
</div>

<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Név</th>
            <th>Utoljára módosítva</th>
            <th>Műveletek</th>
          </tr>
        </thead>
        <tbody>
          @foreach($products as $product)
            <tr>
              <td>{{ $product->name }}</td>
              <td>{{ $product->updated_at }}</td>
              <td>
                <a href="{{ base_url('admin/product/edit/' . $product->id) }}"><i class="fas fa-fw fa-pen"></i> Szerkesztés</a>
                <a href="{{ base_url('admin/product/delete/' . $product->id) }}"><i class="fas fa-fw fa-trash"></i> Törlés</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@section('footer')
<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
$(document).ready(function() {
  $('#dataTable').DataTable({
    language: dataTableTranslations,
    order: [],
    columnDefs: [
      {
        targets: 2,
        className: 'dt-body-right'
      }
    ]
  });
});
</script>
@endsection
