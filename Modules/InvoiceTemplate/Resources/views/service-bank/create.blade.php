@extends('layouts.app')
@section('title','Service Bank')
@section('sidebar')
    @include('layouts.admin_side_bar', ['modules' => $modules])
@endsection
@section('content')
<!-- Start Page Content here -->
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="col-md-10 bg-blue middlecontainer">
            <div class="card card-profile shadow">
                <div class="card-body">
                    <div class="row page-titles">
                        <div class="col-md-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item" style="color:white;"><a>Create Service Bank</a></li>
                            </ol>
                        </div>
                    </div>
                    <hr class="my-4">
                    <form method="post" action="{{ route('service-bank.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10"><h3 style="padding: 5px;">Bank 1</h3></div>
                            <div class="col-md-1"></div>
                            </div>
                            <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="bank_name">Bank Name</label>
                                    <input type="text" name="bank_name"
                                    class="form-control{{ $errors->has('bank_name') ? ' is-invalid' : '' }}">
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
                                    <input type="text" name="iban"
                                    class="form-control{{ $errors->has('iban') ? ' is-invalid' : '' }}"
                                    >
                                    @if ($errors->has('iban'))
                                    <span class="invalid-feedback" role="alert" style="color:red;">
                                        <strong>{{ $errors->first('iban') }}</strong>
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
                                    <label for="bic">BIC</label>
                                    <input type="text" name="bic"
                                    class="form-control{{ $errors->has('bic') ? ' is-invalid' : '' }}"
                                    >
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
                            <div class="col-md-10"><h3 style="padding: 5px;">Bank 2</h3></div>
                            <div class="col-md-1"></div>
                            </div>
                        <div class="row">
                        <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="bank_name_2">Bank Name</label>
                                    <input type="text" name="bank_name_2"
                                    class="form-control">
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
                                    <input type="text" name="iban_2"
                                    class="form-control"
                                    >
                                    @if ($errors->has('iban_2'))
                                    <span class="invalid-feedback" role="alert" style="color:red;">
                                        <strong>{{ $errors->first('iban_2') }}</strong>
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
                                    <label for="bic_2">BIC</label>
                                    <input type="text" name="bic_2"
                                    class="form-control"
                                    >
                                    @if ($errors->has('bic_2'))
                                    <span class="invalid-feedback" role="alert" style="color:red;">
                                        <strong>{{ $errors->first('bic_2') }}</strong>
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
                                    Save
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
@endsection
@section('js')
@endsection