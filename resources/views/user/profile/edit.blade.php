@extends('layouts.app')
@section('title','update Profile | Unikoop')
@section('content')


<div class="content-page">
    <div class="content">

        <div class="container-fluid">
          <!-- start page title -->
          <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
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
                    </div>
                    {{-- <h4 class="page-title" style="color: blue">Update Profile</h4> --}}
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="col-md-12 card middlecontainer">
            <div class="card card-profile">
                <div class="card-body">
                    <div class="row page-titles">

                        <div class="col-md-12">
                    <a href="{{route('my.profile')}}" class="btn btn-secondary mb-3" style="float: right;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>

                            <ol class="breadcrumb">
                                <h4 class="page-title" style="color: blue">Update Profile</h4>

                                {{-- <li class="breadcrumb-item" ><a>update profile</a></li> --}}
                            </ol>
                        </div>
                    </div>
                    {{-- <hr class="my-4"> --}}
                    {{-- <h4 class="page-title">Update Your Profile</h4> --}}
                    <form method="post" action="{{ route('profile.update',$user->id)}}">


                        @csrf
                        <div class="row">

                        {{-- <div class="col-md-1"></div> --}}
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="username">User Name</label>
                                    <small style="color: red;"> optional</small>
                                    <input type="text" name="username" placeholder="Name"
                                        class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                        value="{{Auth::user()->username}}">
                                    @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert" style="color:red;">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        <div class="col-md-1"></div>


                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <small style="color: red;"> optional</small>
                                    <input type="email" name="email" placeholder="Email"
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        value="{{Auth::user()->email}}">
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert" style="color:red;">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-5 mt-2">
                                <div class="form-group">
                                    <label for="pobox">PO Box Numer</label>
                                    <small style="color: red;"> optional</small>
                                    <input type="text" name="pobox" placeholder="PO Box Number"
                                        class="form-control{{ $errors->has('pobox') ? ' is-invalid' : '' }}"
                                        value="{{Auth::user()->pobox}}">
                                    @if ($errors->has('pobox'))
                                    <span class="invalid-feedback" role="alert" style="color:red;">
                                            <strong>{{ $errors->first('pobox') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-5  mt-2">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <small style="color: red;"> optional</small>
                                    <input type="text" name="phone" placeholder="Phone Number"
                                        class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                        value="{{Auth::user()->phone}}">
                                    @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert" style="color:red;">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-5  mt-2">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <small style="color: red;"> optional</small>
                                    <input type="text" name="address" placeholder="Address"
                                        class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                        value="{{Auth::user()->address}}">
                                    @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert" style="color:red;">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-1"></div>

                            <div class="col-md-5  mt-2">
                                <div class="form-group">
                                    <label for="profile_pic">Profile Picture</label>
                                    <small style="color: red;"> optional</small>
                                    <input type="file" name="profile_pic"
                                        class="form-control{{ $errors->has('profile_pic') ? ' is-invalid' : '' }}"
                                        value="{{Auth::user()->profile_pic}}">
                                    @if ($errors->has('profile_pic'))
                                    <span class="invalid-feedback" role="alert" style="color:red;">
                                            <strong>{{ $errors->first('profile_pic') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="row">
                            {{-- <div class="col-md-1"></div> --}}
                            <div class="col-md-10">
                                <div class="form-group" id="adding-form">
                                    <button type="submit" class="mt-4 btn btn-md btn-primary">
                                        Update Profile
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
    </div>
</div>
@endsection
@section('js')

@endsection
