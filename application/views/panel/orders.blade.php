@extends('layouts.panel')

@section('title', 'Orders')

@section('head')
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="d-sm-flex align-items-center mt-4 mb-4">
  <h1 class="h3 mb-0 text-gray-800">Rendelések</h1>
</div>

<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Állapot</th>
            <th>Utoljára módosítva</th>
            <th>Műveletek</th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $order)
            <tr>
              <td>{{ $order->status }}</td>
              <td>{{ $order->updated_at }}</td>
              <td>
                <a href="{{ base_url('admin/order/edit/' . $order->id) }}"><i class="fas fa-fw fa-pen"></i> Szerkesztés</a>
                <a href="{{ base_url('admin/order/delete/' . $order->id) }}"><i class="fas fa-fw fa-trash"></i> Törlés</a>
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
