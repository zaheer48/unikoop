@extends('layouts.service_dashboard')
@section('title','My Profile')
@section('content')

<div class="col-md-10 bg-blue middlecontainer">
<div class="card card-profile shadow">
    <div class="card-body">
        <div class="row page-titles">
            <div class="col-md-12">
                <ol class="breadcrumb">

                    <li class="breadcrumb-item" style="color:white;"><a>update profile</a></li>
                </ol>
            </div>
        </div>
        <hr class="my-4">
        <form method="post" action="{{ route('profile.update',$user->id)}}">
            @csrf
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="username">UserName</label>
                        <small style="color: red;"> optional</small>
                        <input type="text" name="username"
                               class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                               value="{{Auth::user()->username}}">
                        @if ($errors->has('username'))
                        <span class="invalid-feedback" role="alert" style="color:red;">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label for="name">Email</label>
                        <small style="color: red;"> optional</small>
                        <input type="email" name="email"
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
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="form-group" id="adding-form">
                        <button type="submit" class="btn btn-md btn-primary">
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
@endsection
@section('js')

@endsection
