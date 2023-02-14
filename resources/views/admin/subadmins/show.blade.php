@extends('layouts.app')
@section('title','SubAdmin Details')
@section('sidebar')
    @include('layouts.admin_side_bar')
@endsection
@section('content')
    <style>
        .strong {
            background: lightgoldenrodyellow;
        }
    </style>
    <div class="row page-titles">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('subadmins.index') }}">SubAdmins</a></li>
                <li class="breadcrumb-item"><a>Sub Admin Details</a></li>
            </ol>
        </div>
    </div>

    <div class="card card-profile shadow">
        <div class="card-body">
            <h3>Sub Admin Details
                <a href="{{route('subadmins.index')}}" class="btn btn-sm btn-primary" style="float: right;">
                    <i class="fa fa-arrow-left"></i>
                    Back
                </a>
            </h3>
            <hr class="my-4">
            <div class="row">
                <div class="col-md-6">
                    <p class="mt-2">
                        Sub Admin Email: <strong class="strong">{{$subadmin->email}}</strong>
                    </p>
                    <p class="mt-4">
                        Sub Admin Password: <strong class="strong">{{ $subadmin->password_hint }}</strong>
                    </p>

                    <p class="mt-4">
                        Super Admin Approval: <strong class="strong">{{ ($subadmin->subadmin_activity_notify_status == 1) ? 'ON' : 'OFF' }}</strong>
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="mt-2">
                        Sub Admin username: <strong class="strong">{{ $subadmin->username }}</strong>
                    </p>
                    <p class="mt-4">
                        Date: <strong class="strong">{{ $subadmin->created_at->format('d/m/y') }}</strong>
                    </p>

                </div>
            </div>

            <h4>Assigned Priviliges:</h4>
            <br>
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

            <div class="row">
                @if($subadmin->privilages)
                <?php $arr = explode(",",$subadmin->privilages);
                ?>
                @foreach ($privileges as $key => $value)
                    @if(in_array($key,$arr))
                        <div class="col-md-6">
                            <div class="form-group">
                                <i class="fa fa-arrow-right strong"></i>
                                <label>{{ $value }}</label>
                            </div>
                        </div>
                    @endif
                @endforeach
                @endif
            </div>
        </div>
    </div>

@endsection