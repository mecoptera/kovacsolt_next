@extends('layouts.panel')

@section('title', 'Base Product View')

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="d-sm-flex align-items-center mb-4 mt-4">
      <h1 class="h3 mb-0 text-gray-800">Nézet szerlkesztése</h1>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="post" action="{{ base_url('admin/base_product_view/' . $baseProductView->id) }}">
          <div class="form-group">
            <label for="name">Név:</label>
            <input type="text" name="name" id="name" placeholder="Név" class="form-control" value="{{ $baseProductView->name }}">
          </div>

          <input type="submit" class="btn btn-primary float-right" value="Mentés">
        </form>
      </div>
    </div>
  </div>
@endsection
