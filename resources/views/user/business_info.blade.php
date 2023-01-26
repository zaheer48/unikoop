@extends('layouts.service_dashboard')
@section('title','Bussiness Info')
@section('content')

<div class="col-md-10 bg-blue middlecontainer">
    <div class="card card-profile shadow">
        <div class="card-body">
            <div class="row page-titles">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" style="color:white;"><a>update Bussiness Info</a></li>
                    </ol>
                </div>
            </div>
            <hr class="my-4">
            <?php  $user = \Auth::user();
            $user_address = \DB::table('bussiness_address')->where('register_id', $user->id)->first();
            ?>
            <form method="post" action="{{ route('business.info.update',$user->id) }}">
                @csrf
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="username">Straat</label>
                            <small style="color: red;"> *</small>
                            <input type="text" name="streets"
                                   class="form-control{{ $errors->has('streets') ? ' is-invalid' : '' }}"
                                   value="{{($user_address) ? $user_address->street : ''}}">
                            @if ($errors->has('streets'))
                            <span class="invalid-feedback" role="alert" style="color:red;">
                                <strong>{{ $errors->first('streets') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="name">Huisnummer</label>
                            <small style="color: red;"> *</small>
                            <input type="text" name="housebuildname"
                                   class="form-control{{ $errors->has('housebuildname') ? ' is-invalid' : '' }}"
                                   value="{{($user_address) ? $user_address->h_b_number : ''}}">
                            @if ($errors->has('housebuildname'))
                            <span class="invalid-feedback" role="alert" style="color:red;">
                                <strong>{{ $errors->first('housebuildname') }}</strong>
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
                            <label for="Postcode">Postcode</label>
                            <small style="color: red;"> *</small>
                            <input type="text" name="postcode"
                                   class="form-control{{ $errors->has('postcode') ? ' is-invalid' : '' }}"
                                   value="{{($user_address) ? $user_address->postcode : ''}}">
                            @if ($errors->has('postcode'))
                            <span class="invalid-feedback" role="alert" style="color:red;">
                                <strong>{{ $errors->first('postcode') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="name">Stad / plaats:</label>
                            <small style="color: red;"> *</small>
                            <input type="text" name="citytown"
                                   class="form-control{{ $errors->has('citytown') ? ' is-invalid' : '' }}"
                                   value="{{($user_address) ? $user_address->city_town : ''}}">
                            @if ($errors->has('citytown'))
                            <span class="invalid-feedback" role="alert" style="color:red;">
                                <strong>{{ $errors->first('citytown') }}</strong>
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
                            <label for="county">Provincie </label>
                            <small style="color: red;"> *</small>
                            <input type="text" name="county"
                                   class="form-control{{ $errors->has('county') ? ' is-invalid' : '' }}"
                                   value="{{($user_address) ? $user_address->county : ''}}">
                            @if ($errors->has('county'))
                            <span class="invalid-feedback" role="alert" style="color:red;">
                                <strong>{{ $errors->first('county') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="name">land </label>
                            <small style="color: red;"> *</small>
                            <select class="form-control" id="kycBusinessInfo_Country" name="kycBusinessInfo_Country" required>
                                <option value="NL" @if($user_address->country ?? '') {{ ($user_address->country == 'NL') ? 'selected' : '' }} @endif>Netherlands</option>
                                <option value="BE" @if($user_address->country ?? '') {{ ($user_address->country == 'BE') ? 'selected' : '' }} @endif>Belgium</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>

                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="pnumber">Telefoonnummer </label>
                            <small style="color: red;"> *</small>
                            <input type="text" name="pnumber"
                                   class="form-control{{ $errors->has('pnumber') ? ' is-invalid' : '' }}"
                                   value="{{($user_address) ? $user_address->phonenumber : ''}}">
                            @if ($errors->has('pnumber'))
                            <span class="invalid-feedback" role="alert" style="color:red;">
                                <strong>{{ $errors->first('pnumber') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="wnumber">Work Phone:</label>
                            <small style="color: red;"> *</small>
                            <input type="text" name="wnumber"
                                   class="form-control{{ $errors->has('wnumber') ? ' is-invalid' : '' }}"
                                   value="{{($user_address) ? $user_address->workphone : ''}}">
                            @if ($errors->has('wnumber'))
                            <span class="invalid-feedback" role="alert" style="color:red;">
                                <strong>{{ $errors->first('wnumber') }}</strong>
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
                            <label for="mnumber">Mobile number:</label>
                            <small style="color: red;"> *</small>
                            <input type="text" name="mnumber"
                                   class="form-control{{ $errors->has('mnumber') ? ' is-invalid' : '' }}"
                                   value="{{($user_address) ? $user_address->mobilephone : ''}}">
                            @if ($errors->has('mnumber'))
                            <span class="invalid-feedback" role="alert" style="color:red;">
                                <strong>{{ $errors->first('mnumber') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="emailadmin">Email admin:</label>
                            <small style="color: red;"> *</small>
                            <input type="email" name="emailadmin"
                                   class="form-control{{ $errors->has('emailadmin') ? ' is-invalid' : '' }}"
                                   value="{{($user_address) ? $user_address->email_admin : ''}}">
                            @if ($errors->has('emailadmin'))
                            <span class="invalid-feedback" role="alert" style="color:red;">
                                <strong>{{ $errors->first('emailadmin') }}</strong>
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
                            <label for="email_sale">Email sales:</label>
                            <small style="color: red;"> *</small>
                            <input type="email" name="email_sale"
                                   class="form-control{{ $errors->has('email_sale') ? ' is-invalid' : '' }}"
                                   value="{{($user_address) ? $user_address->email_sales : ''}}">
                            @if ($errors->has('email_sale'))
                            <span class="invalid-feedback" role="alert" style="color:red;">
                                <strong>{{ $errors->first('email_sale') }}</strong>
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
                            <button type="submit" class="btn btn-md btn-primary" style="height: 38px;padding: 7px;">
                                Update Info
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

