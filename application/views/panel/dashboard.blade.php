@extends('layouts.panel')

@section('title', 'Dashboard')

@section('content')
<div class="d-sm-flex align-items-center mb-4 mt-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <p>You are logged in as <b>{{ $this->session->userdata('user')->email }}</b></p>
        <a href="{{ base_url('logout') }}" class="btn btn-primary">Logout</a>
      </div>
    </div>
  </div>
</div>
@endsection
