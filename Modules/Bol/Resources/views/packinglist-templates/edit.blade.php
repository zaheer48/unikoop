@extends('layouts.service_dashboard')
@section('title','Packing List templates')
@section('sidebar')
    @include('bol::layouts.side_bar')
@endsection
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
<div class="col-md-10 bg-blue middlecontainer">
    @if (Session::has('success'))

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ Session::get('success') }}.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

   @endif
    @if (Session::has('alert-warning'))

        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ Session::get('alert-warning') }}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

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
                        <img src="{{ asset('portal/'.$preview->preview) }}" style="border: 1px solid #999;">
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

<link href="{{asset('css/summernote.css')}}" rel="stylesheet">
<script src="{{asset('css/summernote.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#body_text').summernote({
            height: 350
        });
    });
</script>

@endsection
