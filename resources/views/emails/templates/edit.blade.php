@extends('layouts.app')
@section('title','Edit Email Template | Unikoop')



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
                            <h4 class="page-title" style="color:blue;">Edit Email Template</h4>
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
                                <h3 style="padding: 20px;">
                                    Template Details
                                    <a href="{{ route('email-templates.index') }}" class="btn btn-md btn-primary" style="float: right; margin-top: -10px;">Email Templates</a>
                                </h3>
                                <hr>
                                <form class="form-horizontal mx-5 " action="{{ url('/email-templates',$template->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mb-3">
                                        <label class="control-label col-sm-2 mb-1" for="blood_group_display_name">Email Type <small style="color:red;">*</small></label>
                                        <div class="col-sm-8">
                                            <select name="email_type" id="blood_group_display_name" class="form-control" required style="height: 36px;">
                                                <option value="Order Invoice">
                                                    Order Invoice
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2 mb-1" for="blood_group_slug">Email Body <small style="color:red;">*</small></label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" name="email_body" id="edit_profile_description" rows="18" style="resize: vertical;" placeholder="Enter Faq Description">
                                                {!! $template->email_body !!}
                                            </textarea>
                                        </div>
                                    </div>

                                    <div class="form-group add-product-footer text-start my-2 mb-4">
                                        <button name="addProduct_btn" type="submit" class="btn btn-primary product-btn">
                                            Update Email Template
                                        </button>
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
@section('js')

<link href="{{URL::asset('assets/css/summernote.css')}}" rel="stylesheet">
<script src="{{URL::asset('assets/js/summernote.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#edit_profile_description').summernote({
            height: 350
        });
    });</script>

@endsection
