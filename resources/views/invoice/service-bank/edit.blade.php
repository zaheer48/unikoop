@extends('layouts.app')
@section('title','Edit Service Bank | Unikoop')
@section('content')

 <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">


            <!-- Start Content-->
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
                            <h4 class="page-title" style="color: blue">Edit Bank</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="col-md-12 card middlecontainer">
                    <div class="card card-profile shadow">
                        <div class="card-body">
                            <div class="row page-titles">
                                <div class="col-md-12">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item" ><a>Edit Service Bank</a></li>
                                    </ol>
                                </div>
                            </div>
                            {{-- <hr class="my-4"> --}}
                            <form method="post" action="{{ route('service_bank.service.update',$details->id)}}">
                                @csrf
                                <div class="row">

                                    <div class="col-md-1"></div>
                                    <div class="col-md-10"><h3 style="padding: 5px;">Bank 2</h3></div>
                                    <div class="col-md-1"></div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="bank_name">Bank Name</label>
                                            <input type="text" name="bank_name" placeholder="Bank Name"
                                            class="form-control{{ $errors->has('bank_name') ? ' is-invalid' : '' }}" value="{{$details->bank_name}}">
                                            @if ($errors->has('bank_name'))
                                            <span class="invalid-feedback" role="alert" style="color:red;">
                                                <strong>{{ $errors->first('bank_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="iban">IBAN</label>
                                            <input type="text" name="iban" placeholder="IBN"
                                            class="form-control{{ $errors->has('iban') ? ' is-invalid' : '' }}"
                                            value="{{$details->iban}}">
                                            @if ($errors->has('iban'))
                                            <span class="invalid-feedback" role="alert" style="color:red;">
                                                <strong>{{ $errors->first('iban') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>


                                <div class="row mt-3">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="bic">BIC</label>
                                            <input type="text" name="bic" placeholder="BIC"
                                            class="form-control{{ $errors->has('bic') ? ' is-invalid' : '' }}"
                                            value="{{$details->bic}}">
                                            @if ($errors->has('bic'))
                                            <span class="invalid-feedback" role="alert" style="color:red;">
                                                <strong>{{ $errors->first('bic') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>


                                <div class="col-md-1"></div>
                            </div>
                <hr>
                            <div class="row">

                                    <div class="col-md-1"></div>
                                    <div class="col-md-10"><h3 style="padding: 5px;">Bank 1</h3></div>
                                    <div class="col-md-1"></div>
                                    </div>
                            <div class="row">
                                <div class="col-md-1"></div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="bank_name_2">Bank Name</label>
                                            <input type="text" name="bank_name_2" placeholder="Bank Name"
                                            class="form-control" value="{{$details->bank_name_2}}">
                                            @if ($errors->has('bank_name_2'))
                                            <span class="invalid-feedback" role="alert" style="color:red;">
                                                <strong>{{ $errors->first('bank_name_2') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="iban_2">IBAN</label>
                                            <input type="text" name="iban_2" placeholder="IBN"
                                            class="form-control"
                                            value="{{$details->iban_2}}">
                                            @if ($errors->has('iban_2'))
                                            <span class="invalid-feedback" role="alert" style="color:red;">
                                                <strong>{{ $errors->first('iban_2') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>
                                <div class="row mt-3">

                                    <div class="col-md-1"></div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="bic_2">BIC</label>
                                            <input type="text" name="bic_2" placeholder="BIC"
                                            class="form-control"
                                            value="{{$details->bic_2}}">
                                            @if ($errors->has('bic_2'))
                                            <span class="invalid-feedback" role="alert" style="color:red;">
                                                <strong>{{ $errors->first('bic_2') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>


                                <div class="col-md-1"></div>

                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10">
                                        <div class="form-group" id="adding-form">
                                            <button type="submit" class="btn btn-md btn-primary">
                                            Update
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
