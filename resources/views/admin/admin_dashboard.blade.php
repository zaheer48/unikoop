@extends('layouts.app')
@section('title','Dashboard')
@section('sidebar')
    @include('layouts.admin_side_bar')
@endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="widget-small primary coloured-icon">
                <i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h4>All Users</h4>
                    <p><b>{{$users}}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="widget-small primary coloured-icon">
                <i class="icon fa fa-user-o fa-3x"></i>
                <div class="info">
                    <h4>Sub Admins</h4>
                    <p><b>{{$subadmins}}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="widget-small primary coloured-icon">
                <i class="icon fa fa-user-o fa-3x"></i>
                <div class="info">
                    <h4>Users Requests</h4>
                    <p><b>{{$user_requests}}</b></p>
                </div>
            </div>
        </div>
    </div>

@endsection