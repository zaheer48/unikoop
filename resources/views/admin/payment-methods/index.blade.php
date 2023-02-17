@extends('layouts.app')
@section('title','Payment Methods')
@section('sidebar')
    @include('layouts.admin_side_bar', ['modules' => $modules])
@endsection
@section('content')
    @php
        $privileges = explode(",",\Auth::user()->privilages);
    @endphp
    <div class="content-page">
        <div class="content">
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
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="card shadow" style="
                    height: 96%;
                ">
                        <div class="card-body">
                            <div class="card-body">
                                <h4 class="text-center">Mollie Credential</h4>
                                <br>
                                <form action="{{ url('/payment-methods') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="type" value="mollie_payment">
                                    <div class="row form-group">
                                        <div class="col-md-4">
                                            <label for="">Mollie Key</label>
                                        </div>
                                        <div class="col-md-8">
                                            @php
                                                if ($mollie)
                                                $obj = json_decode($mollie->value);
                                            @endphp
                                            <input type="text" name="mollie_key"
                                                value="{{ ($mollie) ? $obj->mollie_key : ''  }}"
                                                class="form-control {{ $errors->has('mollie_key') ? ' is-invalid' : '' }}"
                                                required>
                                            @if ($errors->has('mollie_key'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('mollie_key') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group mt-3">
                                        <div class="col-md-4">
                                            <label for="">Mollie Profile ID</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="mollie_profile_id"
                                                value="{{ ($mollie) ? $obj->mollie_profile_id : ''  }}"
                                                class="form-control {{ $errors->has('mollie_profile_id') ? ' is-invalid' : '' }}"
                                                required>
                                            @if ($errors->has('mollie_profile_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('mollie_profile_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-12 pull-right">
                                            @if (in_array('update_pmethod',$privileges) || Auth::user()->is_admin == 1)
                                                <button class="btn btn-md btn-primary mt-3" style="margin-left:164px">Save</button>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-body">
                                <h4 class="text-center">Bank Transfer</h4>
                                <br>
                                <form action="{{ url('/payment-methods') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="type" value="bank_transfer">
                                    <div class="row form-group">
                                        <div class="col-md-4">
                                            <label for="">Bank name</label>
                                        </div>
                                        <div class="col-md-8">
                                            @php
                                                if ($bank)
                                                $details = json_decode($bank->value);
                                            @endphp
                                            <input type="text" name="bank_name"
                                                value="@if($bank) {{ ($details->bank_name ?? '') }} @endif"
                                                class="form-control {{ $errors->has('bank_name') ? ' is-invalid' : '' }}"
                                                required>
                                            @if ($errors->has('bank_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('bank_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group mt-2">
                                        <div class="col-md-4">
                                            <label for="">Account name</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="account_name"
                                                value="@if($bank) {{ ($details->account_name ?? '') }} @endif"
                                                class="form-control {{ $errors->has('account_name') ? ' is-invalid' : '' }}"
                                                required>
                                            @if ($errors->has('account_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('account_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group mt-2">
                                        <div class="col-md-4">
                                            <label for="">Account</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="account"
                                                value="@if($bank) {{ ($details->account ?? '') }} @endif"
                                                class="form-control {{ $errors->has('account') ? ' is-invalid' : '' }}"
                                                required>
                                            @if ($errors->has('account'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('account') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group mt-2">
                                        <div class="col-md-4">
                                            <label for="">Account IBAN</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="account_iban"
                                                value="@if($bank) {{ ($details->account_iban ?? '') }} @endif"
                                                class="form-control {{ $errors->has('account_iban') ? ' is-invalid' : '' }}"
                                                required>
                                            @if ($errors->has('account_iban'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('account_iban') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group mt-2">
                                        <div class="col-md-4">
                                            <label for="">Swift code</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="swift_code"
                                                value="@if($bank) {{ ($details->swift_code ?? '') }} @endif"
                                                class="form-control {{ $errors->has('swift_code') ? ' is-invalid' : '' }}"
                                                required>
                                            @if ($errors->has('swift_code'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('swift_code') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group mt-2">
                                        <div class="col-md-4">
                                            <label for="">Bank Address</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="bank_address"
                                                value="@if($bank) {{ ($details->bank_address ?? '') }} @endif"
                                                class="form-control {{ $errors->has('bank_address') ? ' is-invalid' : '' }}"
                                                required>
                                            @if ($errors->has('bank_address'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('bank_address') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group mt-2">
                                        <div class="col-md-4">
                                            <label for="">City</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="city"
                                                value="@if($bank) {{ ($details->city ?? '') }} @endif"
                                                class="form-control {{ $errors->has('city') ? ' is-invalid' : '' }}"
                                                required>
                                            @if ($errors->has('city'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('city') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <?php
                                    $countries = array(
                                        'AL' => 'Albania',
                                        'DZ' => 'Algeria',
                                        'AO' => 'Angola',
                                        'AR' => 'Argentina',
                                        'AM' => 'Armenia',
                                        'AU' => 'Australia',
                                        'AT' => 'Austria',
                                        'AZ' => 'Azerbaijan',
                                        'BD' => 'Bangladesh',
                                        'BY' => 'Belarus',
                                        'BE' => 'Belgium',
                                        'BJ' => 'Benin',
                                        'BO' => 'Bolivia',
                                        'BW' => 'Botswana',
                                        'BR' => 'Brazil',
                                        'BN' => 'Brunei Darussalam',
                                        'BG' => 'Bulgaria',
                                        'BF' => 'Burkina Faso',
                                        'KH' => 'Cambodia',
                                        'CM' => 'Cameroon',
                                        'CA' => 'Canada',
                                        'TD' => 'Chad',
                                        'CL' => 'Chile',
                                        'CN' => 'China',
                                        'CO' => 'Colombia',
                                        'CR' => 'Costa Rica',
                                        'CI' => 'Cote d\'Ivoire',
                                        'HR' => 'Croatia',
                                        'CY' => 'Cyprus',
                                        'CZ' => 'Czech Republic',
                                        'DK' => 'Denmark',
                                        'DO' => 'Dominican Republic',
                                        'EG' => 'Egypt',
                                        'SV' => 'El Salvador',
                                        'GQ' => 'Equatorial Guinea',
                                        'EE' => 'Estonia',
                                        'FI' => 'Finland',
                                        'FR' => 'France',
                                        'GF' => 'French Guiana',
                                        'PF' => 'French Polynesia',
                                        'GA' => 'Gabon',
                                        'GE' => 'Georgia',
                                        'DE' => 'Germany',
                                        'GI' => 'Gibraltar',
                                        'GR' => 'Greece',
                                        'GP' => 'Guadeloupe',
                                        'GG' => 'Guernsey',
                                        'GN' => 'Guinea',
                                        'HT' => 'Haiti',
                                        'HN' => 'Honduras',
                                        'HK' => 'Hong Kong',
                                        'HU' => 'Hungary',
                                        'IS' => 'Iceland',
                                        'IN' => 'India',
                                        'ID' => 'Indonesia',
                                        'IE' => 'Ireland',
                                        'IM' => 'Isle of Man',
                                        'IL' => 'Israel',
                                        'IT' => 'Italy',
                                        'JP' => 'Japan',
                                        'JE' => 'Jersey',
                                        'JO' => 'Jordan',
                                        'KE' => 'Kenya',
                                        'KR' => 'Korea (South)',
                                        'KW' => 'Kuwait',
                                        'LV' => 'Latvia',
                                        'LI' => 'Liechtenstein',
                                        'LT' => 'Lithuania',
                                        'LU' => 'Luxembourg',
                                        'MK' => 'Macedonia',
                                        'MG' => 'Madagascar',
                                        'MY' => 'Malaysia',
                                        'ML' => 'Mali',
                                        'MT' => 'Malta',
                                        'MQ' => 'Martinique',
                                        'MU' => 'Mauritius',
                                        'YT' => 'Mayotte',
                                        'MX' => 'Mexico',
                                        'MA' => 'Morocco',
                                        'MZ' => 'Mozambique',
                                        'NA' => 'Namibia',
                                        'NP' => 'Nepal',
                                        'NL' => 'Netherlands',
                                        'NC' => 'New Caledonia',
                                        'NZ' => 'New Zealand',
                                        'NE' => 'Niger',
                                        'NO' => 'Norway',
                                        'OM' => 'Oman',
                                        'PA' => 'Panama',
                                        'PY' => 'Paraguay',
                                        'PE' => 'Peru',
                                        'PH' => 'Philippines',
                                        'PL' => 'Poland',
                                        'PT' => 'Portugal',
                                        'PR' => 'Puerto Rico',
                                        'QA' => 'Qatar',
                                        'RE' => 'Reunion',
                                        'RO' => 'Romania',
                                        'RU' => 'Russia',
                                        'SM' => 'San Marino',
                                        'SN' => 'Senegal',
                                        'RS' => 'Serbia',
                                        'SG' => 'Singapore',
                                        'SK' => 'Slovakia',
                                        'SI' => 'Slovenia',
                                        'ZA' => 'South Africa',
                                        'ES' => 'Spain',
                                        'LK' => 'Sri Lanka',
                                        'SE' => 'Sweden',
                                        'CH' => 'Switzerland',
                                        'TW' => 'Taiwan',
                                        'TH' => 'Thailand',
                                        'TG' => 'Togo',
                                        'TT' => 'Trinidad and Tobago',
                                        'TR' => 'Turkey',
                                        'UG' => 'Uganda',
                                        'UA' => 'Ukraine',
                                        'AE' => 'United Arab Emirates',
                                        'GB' => 'United Kingdom',
                                        'US' => 'United States',
                                        'VN' => 'Vietnam',
                                    );
                                    ?>
                                    <div class="row form-group">
                                        <div class="col-md-4">
                                            <label for="">Country</label>
                                        </div>
                                        <div class="col-md-8 mt-2">
                                            <select name="country" class="form-control" required
                                                    style="height: 34px !important;">
                                                <option value="">--Select--</option>
                                                @foreach($countries as $key => $value)
                                                    <option value="{{ $key }}" @if($bank) {{ ($details->country == $key) ? 'selected' :
                                                '' }} @endif>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('country'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('country') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group mt-3">
                                        <div class="col-md-12 pull-right">
                                            @if (in_array('update_pmethod',$privileges) || Auth::user()->is_admin == 1)
                                                <button class="btn btn-md btn-primary" style="margin-left: 164px">Save</button>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
