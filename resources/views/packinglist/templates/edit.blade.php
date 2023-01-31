@extends('layouts.app')
@section('title','Packing List templates | Unikoop')
@section('content')
<style>
    .invalid-feedback {
        color: red;
    }
    .close {
        transform: translate(0%, -50%);
        opacity: 1;
        color: red;
    }
</style>

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
                            <h4 class="page-title" style="color: blue">Packing List Temlpates</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

            <div class="col-md-12 card middlecontainer">
                @if(Session::has('success'))
                <p class="alert alert-success">{{ Session::get('success') }}
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </p>
                @endif
                @if(Session::has('alert-warning'))
                <p class="alert alert-warning">{{ Session::get('alert-warning') }}
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </p>
                @endif

                <div class="panel panel-info">
                    <div class="row" style="margin-top: 8px;">
                        <div class="col-md-12">
                            <h3 style="padding: 20px;">Packing List Templates
                            <a href="{{route('packinglist-templates.index')}}" class="btn btn-primary" style="float: right;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
                            </h3>
                            <hr>
                            <div class="row" style="padding: 20px;">
                                <div class="col-md-7">
                                    <form action="{{ route('packinglist-templates.update',$preview->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="">Logo 1</label>
                                                <input type="file" name="logo_1" class="form-control">
                                                @error('logo_1')
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Logo 2</label>
                                                <input type="file" name="logo_2" class="form-control">
                                                @error('logo_2')
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label for="">Body Text</label>
                                                <small style="color: red;"> *</small>
                                                <textarea name="body_text" id="body_text" class="form-control" placeholder="Enter Body Text">@if($preview){{$preview->body_text}}@endif</textarea>
                                                @error('body_text')
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label for="">Footer Logo(s)</label>
                                                <small style="color: red;"> * Select max 5 logos.</small>
                                                <input type="file" name="footer_logos[]" id="file_input" class="form-control">
                                                @error('footer_logos')
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <button class="btn btn-md btn-primary">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-5 form-group">
                                    <h4 class="text-center">Template Sample</h4>
                                    <img src="{{ asset('portal/'.$preview->preview) }}" style="border: 1px solid #999;height:420px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>


@endsection
@section('js')

<script src="{{url('/dhl')}}/js/jquery.multifile.js"></script>
<script type="text/javascript">
    jQuery(function () {
        $('#file_input').multifile();
    });
</script>

<link href="{{asset('assets/css/summernote.css')}}" rel="stylesheet">
<script src="{{asset('assets/js/summernote.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#body_text').summernote({
            height: 350
        });
    });
</script>

@endsection
