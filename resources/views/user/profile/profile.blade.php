@extends('layouts.service_dashboard')
@section('title','My Profile')
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
                        <p class="alert alert-success mb_view">pending with admin</p>
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
                        <p class="alert alert-success mb_view">pending with admin</p>
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

@endsection