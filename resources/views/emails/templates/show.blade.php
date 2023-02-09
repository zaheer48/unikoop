@extends('layouts.app')
@section('title','Template Details | Unikoop')
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
                            <h4 class="page-title" style="color:blue;"> Email Templates</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="col-md-12 card middlecontainer">
                    <div class="panel panel-info">
                        <div class="row" style="margin-top: 8px;">
                            <div class="col-md-12">
                                <h3 style="padding: 20px;">
                                    Template Details
                                    <a href="{{ route('email-templates.index') }}" class="btn btn-md btn-secondary" style="float: right; margin-top: -10px;">Email Templates</a>
                                </h3>
                                <hr>
                                <div class="row" style="padding: 20px;">
                                    <div class="col-md-6">
                                        <p>
                                            <strong>Type:</strong> {{ $template->email_type }}
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row" style="padding: 20px;">
                                    <div class="col-md-12">
                                        <p>
                                            {!! $template->email_body !!}
                                        </p>
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
