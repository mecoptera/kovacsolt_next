@extends('layouts.panel')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">PANEL Dashboard</div>

                <div class="panel-body">
                    @if ($this->userModel->isLoggedIn())
                        <p class="text-success">You are logged in as <b>User</b></p>
                        <p><a href="{{ base_url('user.profile') }}">HOME</a></p>
                        <p><a href="{{ base_url('user.logout') }}">Logout as USER</a></p>
                    @else
                        <p class="text-danger">You are logged out as <b>User</b></p>
                        <p><a href="{{ base_url('login') }}">Login as USER</a></p>
                        <p><a href="{{ base_url('register') }}">Register as USER</a></p>
                    @endif

                    @if ($this->userModel->isLoggedIn())
                        <p class="text-success">You are logged in as <b>Admin</b></p>
                        <p><a href="{{ base_url('panel.dashboard') }}">PANEL</a></p>
                        <p><a href="{{ base_url('panel.logout') }}">Logout as ADMIN</a></p>
                    @else
                        <p class="text-danger">You are logged out as <b>Admin</b></p>
                        <p><a href="{{ base_url('panel/login') }}">Login as ADMIN</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
