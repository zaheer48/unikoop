@extends('layouts.app')
@section('title','Label Pricing')
@section('sidebar')
    @include('layouts.admin_side_bar')
@endsection
@section('content')

    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <!-- bootstarp-css -->
    <link href="/css/bootstrap.css?1564436599" rel="stylesheet" type="text/css" media="all"/>
    <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/myjquery.js"></script>

    <script src="/js/nav.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!--// bootstarp-css -->
    <!-- css -->

    <link rel="stylesheet"
          href="/css/style.css?1546443064" type="text/css" media="all"/>
    <!--// css -->

    <!--fonts-->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
          rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700'
          rel='stylesheet' type='text/css'>
    <!--/fonts-->
    <!-- dropdown -->
    <script src="/js/jquery.easydropdown.js?1564436599"></script>
    <link href="/css/nav.css?1572371412" rel="stylesheet" type="text/css" media="all"/>
    <script src="/js/scripts.js?1564436599" type="text/javascript"></script>
    <!-- seller_regist jquery -->
    <script src="/js/seller_regist/script.js?1564436599" type="text/javascript"></script>
    <script src="/js/seller_regist/return_shipping.js?1564436599" type="text/javascript"></script>
    <div class="row page-titles">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('label.pricing') }}">Label Pricing</a></li>
                <li class="breadcrumb-item"><a>Label Pricing</a></li>
            </ol>
        </div>
    </div>
    <div class="card card-profile shadow">
        <div class="card-body">
            <h3>Label Pricing</h3>
            <hr class="my-4">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs">
                        <li class="active" style="display: contents;">
                            <a href="#dhl" data-toggle="tab">DHL</a>
                        </li>
                        <li style="display: contents;">
                            <a href="#dpd" data-toggle="tab">DPD</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="dhl" class="tab-pane fade in active">
                            <h3>DHL Pricing Label</h3>
                            <br>
                            <form id="first_form" method="post" action="{{url('/label-pricing')}}">
                                @csrf
                                <input type="hidden" name="service_type" value="dhl">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">DHL Original Price</label>
                                            <small style="color: red;"> *</small>
                                            <input type="" name="dhl_original_price" value="{{ ($dhl) ? $dhl->dhl_original_price : old('dhl_original_price')}}" class="form-control {{ $errors->has('dhl_original_price') ? ' is-invalid' : '' }}" required>
                                            @if ($errors->has('dhl_original_price'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('dhl_original_price') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">DHL Unikoop Price</label>
                                            <small style="color: red;"> *</small>
                                            <input type="" name="dhl_unikoop_price" value="{{ ($dhl) ? $dhl->dhl_unikoop_price : old('dhl_unikoop_price')}}" class="form-control {{ $errors->has('dhl_unikoop_price') ? ' is-invalid' : '' }}" required>
                                            @if ($errors->has('dhl_unikoop_price'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('dhl_unikoop_price') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">DHL Discount Price</label>
                                            <small style="color: red;"> *</small>
                                            <input type="" name="dhl_discount_price" value="{{ ($dhl) ? $dhl->dhl_discount_price : old('dhl_discount_price')}}" class="form-control {{ $errors->has('dhl_discount_price') ? ' is-invalid' : '' }}" required>
                                            @if ($errors->has('dhl_discount_price'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('dhl_discount_price') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">DHL Active Price Status</label>
                                            <small style="color: red;"> *</small>
                                            <br>
                                            <input type="radio" value="Unikoop" name="is_active" @if($dhl) {{ ($dhl->is_active == 'Unikoop') ? 'checked' : '' }} @endif> Unikoop
                                            <input type="radio" value="Discount" name="is_active" @if($dhl) {{ ($dhl->is_active == 'Discount') ? 'checked' : '' }} @endif> Discount
                                            @if ($errors->has('is_active'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('is_active') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">DHL Discount Note</label>
                                            <small style="color: red;"> *</small>
                                            <input type="" name="dhl_discount_note" value="{{ ($dhl) ? $dhl->dhl_discount_note : old('dhl_discount_note')}}" class="form-control {{ $errors->has('dhl_discount_note') ? ' is-invalid' : '' }}" required>
                                            @if ($errors->has('dhl_discount_note'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('dhl_discount_note') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Max Size</label>
                                            <small style="color: red;"> * e.g. 80 x 50 x 35cm</small>
                                            <input type="" name="box_size" value="{{ ($dhl) ? $dhl->box_size : old('box_size')}}" class="form-control {{ $errors->has('box_size') ? ' is-invalid' : '' }}" required>
                                            @if ($errors->has('box_size'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('box_size') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Levering</label>
                                            <small style="color: red;"> * e.g. 24 uur</small>
                                            <input type="" name="delivery" value="{{ ($dhl) ? $dhl->delivery : old('delivery')}}" class="form-control {{ $errors->has('delivery') ? ' is-invalid' : '' }}" required>
                                            @if ($errors->has('delivery'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('delivery') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="dpd" class="tab-pane fade">
                            <h3>DPD Pricing Label</h3>
                            <br>
                            <form id="first_form" method="post" action="{{url('/label-pricing')}}">
                                @csrf
                                <input type="hidden" name="service_type" value="dpd">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">DPD Original Price</label>
                                            <small style="color: red;"> *</small>
                                            <input type="" name="dpd_original_price" value="{{ ($dpd) ? $dpd->dpd_original_price : old('dpd_original_price')}}" class="form-control {{ $errors->has('dpd_original_price') ? ' is-invalid' : '' }}" required>
                                            @if ($errors->has('dpd_original_price'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('dpd_original_price') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">DPD Unikoop Price</label>
                                            <small style="color: red;"> *</small>
                                            <input type="" name="dpd_unikoop_price" value="{{ ($dpd) ? $dpd->dpd_unikoop_price : old('dpd_unikoop_price')}}" class="form-control {{ $errors->has('dpd_unikoop_price') ? ' is-invalid' : '' }}" required>
                                            @if ($errors->has('dpd_unikoop_price'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('dpd_unikoop_price') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">DPD Discount Price</label>
                                            <small style="color: red;"> *</small>
                                            <input type="" name="dpd_discount_price" value="{{ ($dpd) ? $dpd->dpd_discount_price : old('dpd_discount_price')}}" class="form-control {{ $errors->has('dpd_discount_price') ? ' is-invalid' : '' }}" required>
                                            @if ($errors->has('dpd_discount_price'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('dpd_discount_price') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">DPD Active Price Status</label>
                                            <small style="color: red;"> *</small>
                                            <br>
                                            <input type="radio" value="Unikoop" name="dpd_is_active" @if($dpd) {{ ($dpd->is_active == 'Unikoop') ? 'checked' : '' }} @endif> Unikoop
                                            <input type="radio" value="Discount" name="dpd_is_active" @if($dpd) {{ ($dpd->is_active == 'Discount') ? 'checked' : '' }} @endif> Discount
                                            @if ($errors->has('dpd_is_active'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('dpd_is_active') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">DPD Discount Note</label>
                                            <small style="color: red;"> *</small>
                                            <input type="" name="dpd_discount_note" value="{{ ($dpd) ? $dpd->dpd_discount_note : old('dpd_discount_note')}}" class="form-control {{ $errors->has('dpd_discount_note') ? ' is-invalid' : '' }}" required>
                                            @if ($errors->has('dpd_discount_note'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('dpd_discount_note') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Max Size</label>
                                            <small style="color: red;"> * e.g. 80 x 50 x 35cm</small>
                                            <input type="" name="box_size" value="{{ ($dpd) ? $dpd->box_size : old('box_size')}}" class="form-control {{ $errors->has('box_size') ? ' is-invalid' : '' }}" required>
                                            @if ($errors->has('box_size'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('box_size') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Levering</label>
                                            <small style="color: red;"> * e.g. 24 uur</small>
                                            <input type="" name="delivery" value="{{ ($dpd) ? $dpd->delivery : old('delivery')}}" class="form-control {{ $errors->has('delivery') ? ' is-invalid' : '' }}" required>
                                            @if ($errors->has('delivery'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('delivery') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection