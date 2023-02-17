@extends('layouts.app')
@section('title','Create SubAdmin')
@section('sidebar')
    @include('layouts.admin_side_bar', ['modules' => $modules])
@endsection
@section('content')
<div class="content-page">
    <div class="content">
        <div class="row page-titles">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('subadmins.index') }}">SubAdmins</a></li>
                    <li class="breadcrumb-item"><a>Create Sub Admin</a></li>
                </ol>
            </div>
        </div>

        <div class="card card-profile shadow">
            <div class="card-body">
                <h3>Create Sub Admin
                    <a href="{{route('subadmins.index')}}" class="btn btn-sm btn-primary" style="float: right;">
                        <i class="fa fa-arrow-left"></i>
                        Back
                    </a>
                </h3>
                <hr class="my-4">
                <form id="first_form" method="post" action="{{route('subadmins.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="category_name">Sub Admin Email</label>
                                <small style="color: red;"> *</small>
                                <input type="email" name="email"
                                    value="{{old('email')}}" id="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    placeholder="Enter Email" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>


                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="category_name">Sub Admin Password</label>
                                <small style="color: red;"> *</small>
                                <input type="text" id="pass" min="8" value="{{old('password')}}" name="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    placeholder="Enter Password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="category_name">Sub Admin username</label>
                                <small style="color: red;"> *</small>
                                <input type="text" id="username" value="{{old('username')}}" name="username"
                                    class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                    placeholder="Username" required>
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="category_name">Super Admin Approval</label>
                                <small style="color: red;"> *</small><br>
                                    <input type="checkbox" checked name="subadmin_activity_notify" style="height: 23px;width: 18px;">
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>

                    <label for="category_name" style="margin-left: 84px;">Assign Priviliges</label>
                    <small style="color: red;"> *</small>
                    <br>
                    <br>
                    <div class="row">
                        @php
                            $privileges = array(
                            'view_user' => 'View Users',
                            'createuser' => 'Create User',
                            'activateeuser' => 'Activate User',
                            'deactivateeuser' => 'De-Activate User',
                            'updateuser' => 'Update User',
                            'view_ssetting' => 'View Website Settings',
                            'updatsetting' => 'Update Website Setting',
                            'deletesetting_image' => 'Delete Website Setting images',
                            'view_user_request' => 'View User Requests',
                            'activate_user_request' => 'Approve User Requests',
                            'de_activate_user_request' => 'Reject User Request',
                            'view_activation' => 'View Activations',
                            'activate_mollie' => 'ON/OFF Mollie',
                            'activate_btransfer' => 'ON/OFF Bank Transfer',
                            'view_pmethod' => 'View Payment Methods',
                            'update_pmethod' => 'Update Payment Methods Data',
                            'view_sadmins' => 'View Sub Admins',
                            'activate_sadmins' => 'Activate Sub Admins',
                            'de_activate_sadmins' => 'De-Activate Sub Admins',
                            'add_sadmins' => 'Add Sub Admins',
                            'edit_sadmins' => 'Update Sub Admins',
                            'delete_sadmins' => 'Delete Sub Admins',
                            'view_labprice' => 'View Label Pricing',
                            'add_edit_labprice' => 'Add/Edit Label Pricing'
                        );
                        @endphp
                        @foreach ($privileges as $key => $value)
                            <div class="col-md-5 offset-1">
                                <div class="form-group">
                                    <input type="checkbox" name="privilege[]" value="{{ $key }}">
                                    <label for="">{{ $value }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="form-group" id="adding-form">
                                <button type="submit" class="btn btn-md btn-primary">
                                    Create SubAdmin
                                </button>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection