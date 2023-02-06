@extends('layouts.app')
@section('title','Change Password | Unikoop')
@section('content')


{{-- <div class="content-page">
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
                    <h4 class="page-title">Change Password</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        {{-- <div class="col-md-10 bg-blue middlecontainer">
                        <div class="panel">
                            <br>
                            <div class="panel-body">
                                <form method="post" action="{{ route('cahnge.password.update') }}">
                                    @csrf
                                    @foreach ($errors->all() as $error)
                                    <p class="text-danger">{{ $error }}</p>
                                    @endforeach

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

                                        <div class="col-md-6">
                                            <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>

                                        <div class="col-md-6">
                                            <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary" style="background-color: #3266CC;">
                                                Update Password
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
            </div>

        </div> --}}


    </div>
{{-- </div> --}} --}}
<div class="content-page">
    <div class="content">
          <!-- start page title -->
          <div class="row">
            <div class="col-12">
                {{-- <div class="page-title-box"> --}}
                    {{-- <div class="page-title-right"> --}}
                        {{-- <form class="d-flex align-items-center mb-3">
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
                        </form> --}}
                    {{-- </div> --}}
                    {{-- <h4 class="page-title" style="color:blue;">Change Password</h4> --}}
                {{-- </div> --}}
            </div>
        </div>
        <!-- end page title -->
        <div class="col-md-12 card middlecontainer">
            <div class="card card-profile shadow">
                <div class="card-body">
                    <div class="row page-titles">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between">
                                <h4 class="page-title" style="color:blue;">Change Password</h4>

                                    <a href="{{route('my.profile')}}" class="btn btn-primary mb-3" style="float: right;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
                        </div>
                            <ol class="breadcrumb">

                                {{-- <li class="breadcrumb-item" ><a>Change password</a></li> --}}
                            </ol>
                        </div>
                    </div>
                    {{-- <hr class="my-4"> --}}

                    {{-- <h4 class="page-title">Update Your Profile</h4> --}}
                    <form method="post" action="{{ route('cahnge.password.update') }}">
                        @csrf
                        <div class="">

                        <div class="col-md-1"></div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" placeholder="Current Password" name="current_password" autocomplete="current-password">
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" placeholder="New Password" name="new_password" autocomplete="current-password">
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Confirm New Password</label>

                            <div class="col-md-6">
                                <input id="new_confirm_password" type="password" class="form-control" placeholder="Confirm New Password" name="new_confirm_password" autocomplete="current-password">
                            </div>
                        </div>


                        </div>
                        <div class="form-group row mb-0 mt-3">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Password
                                </button>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="form-group" id="adding-form">
                                    <button type="submit" class="mt-4 btn btn-md btn-primary">
                                        Update Profile
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection
