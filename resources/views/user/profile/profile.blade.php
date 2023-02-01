@extends('layouts.app')
@section('title','My Profile | Unikoop')
@section('content')
<style>
    .mb_view{
        display:none;
        float: right;
        height: 42px;
        padding: 7px;
        font-size: 15px;
        margin-top: -13px;
    }
    .bg_view{
        float: right;
        height: 42px;
        padding: 7px;
        font-size: 15px;
        margin-top: -13px;
    }
    @media screen and (min-device-width: 320px) and (max-device-width: 500px) {
        .mb_view{
            display: block;
        }
        .bg_view{
            display: none;
        }
    }
</style>
{{--
<div class="content-page">
    <div class="content">
          <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form class="d-flex align-items-center mb-3">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control border" id="dash-daterange">
                                <span class="input-group-text bg-blue border-blue text-white">
                                    <i class="mdi mdi-calendar-range"></i>
                                </span>
                            </div>
                            <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-2">
                                <i class="mdi mdi-autorenew"></i>
                            </a>
                            <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-1">
                                <i class="mdi mdi-filter-variant"></i>
                            </a>
                        </form>
                    </div>
                    <h4 class="page-title">My Profile</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="col-md-10 bg-blue middlecontainer">
            @if (session()->has('success'))
            <div class="alert alert-dismissable alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>
                    {!! session()->get('success') !!}
                </strong>
            </div>
            @endif
            @if(Auth::user())
            <div class="panel panel-info">
                <div class="row text-center">

                        <div class="col-md-4" style="border-right: 1px solid #999;">
                            <a href="{{ route('profile.edit', Auth::user()->id) }}" style="display: block;" class="btn"><i class="fa fa-user fa-lg"></i> Edit Profile</a>
                        </div>
                        <div class="col-md-4" style="border-right: 1px solid #999;">
                            <a href="{{ route('cahnge.password')}}" style="display: block;" class="btn"><i class="fa fa-key fa-lg"></i>&nbsp; Change Password</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('business.info')}}" style="display: block;" class="btn"><i class="fa fa-edit fa-lg"></i> Edit Business Info</a>
                        </div>
                </div>
            </div>
            @php
            $data = \App\Models\Notification::where('user_id',Auth::id())->where('type','BussinessInfo-change')->first();
            $profiledata = \App\Models\Notification::where('user_id',Auth::id())->where('type','profile-change')->first();
            @endphp
            @endif
            <div class="panel panel-info">
                <div class="row">
                    <div class="col-md-12">
                        <h3 style="padding: 14px;">
                            My Profile
                            @if($profiledata)
                            <p class="alert alert-success bg_view">Your Profile Info updation is in pending with admin</p>
                            @endif
                        </h3>
                        <hr style="margin: 0px;">
                        <div class="row" style="padding: 20px;">
                            <div class="col-md-6">
                                <p>
                                    Username: <strong>{{ Auth::user()->username }}</strong>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    Email: <strong>{{ Auth::user()->email }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-info">
                <div class="row">
                    <div class="col-md-12">
                        <h3 style="padding: 14px;">
                            Business Info
                            @if($data)
                            <p class="alert alert-success bg_view">Your Bussiness Info updation is in pending with admin</p>
                            @endif
                        </h3>
                        <hr style="margin: 0px;">
                        @php
                            $info = \DB::table('bussiness_address')->where('register_id',Auth::id())->first();
                        @endphp
                        <div class="row" style="padding: 20px;">
                            <div class="col-md-6">
                                <p>
                                    Straat: <strong>{{ ($info) ? $info->street :'Null' }}</strong>
                                </p>
                                <p>
                                    Postcode: <strong>{{ ($info) ? $info->postcode :'Null' }}</strong>
                                </p>
                                <p>
                                    Provincie: <strong>{{ ($info) ? $info->county :'Null'}}</strong>
                                </p>
                                <p>
                                    Telefoonnummer: <strong>{{ ($info) ? $info->phonenumber :'Null'}}</strong>
                                </p>
                                <p>
                                    Mobile number: <strong>{{ ($info) ? $info->mobilephone :'Null'}}</strong>
                                </p>
                                <p>
                                    Email sales: <strong>{{ ($info) ? $info->email_sales :'Null'}}</strong>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    Huisnummer: <strong>{{ ($info) ? $info->h_b_number :'Null'}}</strong>
                                </p>
                                <p>
                                    Stad / plaats: <strong>{{ ($info) ? $info->city_town :'Null'}}</strong>
                                </p>
                                <p>
                                    Land: <strong>{{ ($info) ? $info->country :'Null'}}</strong>
                                </p>
                                <p>
                                    Work Phone: <strong>{{ ($info) ? $info->workphone :'Null'}}</strong>
                                </p>
                                <p>
                                    Email admin: <strong>{{ ($info) ? $info->email_admin :'Null'}}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}



<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        {{-- <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Extra Pages</a></li>
                                <li class="breadcrumb-item active">Invoice</li>
                            </ol>
                        </div> --}}
                        <h4 class="page-title" style="color: blue;">My Profile</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Logo & title -->
                            {{-- <div class="clearfix">
                                <div class="float-start">
                                    <div class="auth-logo">
                                        <div class="logo logo-dark">
                                            <span class="logo-lg">
                                                <img src="assets/images/logo-dark.png" alt="" height="22">
                                            </span>
                                        </div>

                                        <div class="logo logo-light">
                                            <span class="logo-lg">
                                                <img src="assets/images/logo-light.png" alt="" height="22">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="float-end">
                                    <h4 class="m-0 d-print-none">Invoice</h4>
                                </div>
                            </div> --}}

                            {{-- <div class="row">
                                <div class="col-md-6">
                                    <div class="mt-3">
                                        <p><b>Hello, Stanley Jones</b></p>
                                        <p class="text-muted">Thanks a lot because you keep purchasing our products. Our company
                                            promises to provide high quality products for you as well as outstanding
                                            customer service for every transaction. </p>
                                    </div>

                                </div><!-- end col -->
                                <div class="col-md-4 offset-md-2">
                                    <div class="mt-3 float-end">
                                        <p><strong>Order Date : </strong> <span class="float-end"> &nbsp;&nbsp;&nbsp;&nbsp; Jan 17, 2016</span></p>
                                        <p><strong>Order Status : </strong> <span class="float-end"><span class="badge bg-danger">Unpaid</span></span></p>
                                        <p><strong>Order No. : </strong> <span class="float-end">000028 </span></p>
                                    </div>
                                </div><!-- end col -->
                            </div> --}}
                            <!-- end row -->
                            <div class="panel panel-info">
                                <div class="row text-center">
                                    @if (session()->has('success'))
                                    <div class="alert alert-dismissable alert-success">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>
                                            {!! session()->get('success') !!}
                                        </strong>
                                    </div>
                                    @endif
                                    @if(Auth::user())

                                        <div class="col-md-4" style="border-right: 1px solid #999;">
                                            <a href="{{ route('profile.edit', Auth::user()->id) }}" style="display: block;" class="btn btn-outline-primary"><i class="fa fa-user fa-lg"></i> Edit Profile</a>
                                        </div>
                                        <div class="col-md-4" style="border-right: 1px solid #999;">
                                            <a href="{{ route('cahnge.password')}}" style="display: block;" class="btn btn-outline-danger"><i class="fa fa-key fa-lg"></i>&nbsp; Change Password</a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{ route('business.info')}}" style="display: block;" class="btn btn-outline-warning"><i class="fa fa-edit fa-lg"></i> Edit Business Info</a>
                                        </div>
                                </div>
                            </div>
                            @php
                            $data = \App\Models\Notification::where('user_id',Auth::id())->where('type','BussinessInfo-change')->first();
                            $profiledata = \App\Models\Notification::where('user_id',Auth::id())->where('type','profile-change')->first();
                            @endphp
                            @endif
                            <div class="row mt-3">
                                <h3 style="padding: 14px;">
                                    My Info
                                    @if($profiledata)
                                    <p class="alert alert-success bg_view">Your Profile Info updation is in pending with admin</p>
                                    @endif

                                </h3>
                                <div class="col-sm-6">

                                    <h4  class="text-primary">User Name : <span  class="text-dark">{{ Auth::user()->username }}</span></h4>                                   </h4>

                                </div>

                                <div class="col-sm-6">
                                    <h4  class="text-primary">Email: <span  class="text-dark">{{ Auth::user()->email }}</span></h4>                                   </h4>

                                    {{-- <h4>Email :{{ Auth::user()->email }}</h4>                                    </h4> --}}

                                </div>
                                <div class="row">
                                    <h3 style="padding: 14px;" class="mt-3">
                                    Business Info
                                    @if($data)
                                    <p class="alert alert-success bg_view">Your Bussiness Info updation is in pending with admin</p>
                                    @endif
                                </h3>
                                @php
                                $info = \DB::table('bussiness_address')->where('register_id',Auth::id())->first();
                                @endphp
                                </div>

                            </div>
                            <div class="row" style="padding: 20px;">
                                <div class="col-md-6">
                                    <p>
                                        Straat: <strong>{{ ($info) ? $info->street :'Null' }}</strong>
                                    </p>
                                    <p>
                                        Postcode: <strong>{{ ($info) ? $info->postcode :'Null' }}</strong>
                                    </p>
                                    <p>
                                        Provincie: <strong>{{ ($info) ? $info->county :'Null'}}</strong>
                                    </p>
                                    <p>
                                        Telefoonnummer: <strong>{{ ($info) ? $info->phonenumber :'Null'}}</strong>
                                    </p>
                                    <p>
                                        Mobile number: <strong>{{ ($info) ? $info->mobilephone :'Null'}}</strong>
                                    </p>
                                    <p>
                                        Email sales: <strong>{{ ($info) ? $info->email_sales :'Null'}}</strong>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        Huisnummer: <strong>{{ ($info) ? $info->h_b_number :'Null'}}</strong>
                                    </p>
                                    <p>
                                        Stad / plaats: <strong>{{ ($info) ? $info->city_town :'Null'}}</strong>
                                    </p>
                                    <p>
                                        Land: <strong>{{ ($info) ? $info->country :'Null'}}</strong>
                                    </p>
                                    <p>
                                        Work Phone: <strong>{{ ($info) ? $info->workphone :'Null'}}</strong>
                                    </p>
                                    <p>
                                        Email admin: <strong>{{ ($info) ? $info->email_admin :'Null'}}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection