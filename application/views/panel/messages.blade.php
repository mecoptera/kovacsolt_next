@extends('layouts.panel')

@section('title', 'Orders')

@section('head')
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="d-sm-flex align-items-center mt-4 mb-4">
  <h1 class="h3 mb-0 text-gray-800">Üzenetek</h1>
</div>

<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>E-mail cím</th>
            <th>Név</th>
            <th>Üzenet</th>
            <th>Állapot</th>
            <th>Műveletek</th>
          </tr>
        </thead>
        <tbody>
          @foreach($messages as $message)
            <tr>
              <td>{{ $message->email }}</td>
              <td>{{ $message->name }}</td>
              <td>{{ mb_strlen($message->message) > 99 ? mb_substr($message->message, 0, 96) . '...' : $message->message }}</td>
              <td>{{ $message->status }}</td>
              <td>
                <a href="{{ base_url('admin/message/edit/' . $message->id) }}"><i class="fas fa-fw fa-pen"></i> Szerkesztés</a>
                <a href="{{ base_url('admin/message/delete/' . $message->id) }}"><i class="fas fa-fw fa-trash"></i> Törlés</a>
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
