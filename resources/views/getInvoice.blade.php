@extends('layouts/app')
@section('title','Get Invoice | Unikoop')
@section('sidebar')
    @include('bol::layouts.side_bar')
@endsection
@section('content')
           <!-- Left Sidebar End -->

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
                                    <!-- <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                            <li class="breadcrumb-item active">Responsive Table</li>
                                        </ol>
                                    </div> -->

                                </div>
                            </div>
                        </div>




                        <!-- end page title -->

                        <div class="row ">
                            <div class="col-md-12 mt-2">

                                <div class="card">


                                    <div class="card-body mb-4">
                                        <h4 class="page-title" style="color: blue";>Get Invoice</h4>

                                        <hr>
                                        <div class="row">
                                            <div class="col-12 col-sm-3">
                                                <h5 class="text-start">Order ID</h5>
                                            </div>
                                            <div class="col-12 col-sm-9 col-md-7 col-lg-7">
                                                <div class="input-group text-start gap-2">
                                                    <div class="form-outline ">
                                                        <input type="text" name="bestelnummer" id="bestelnummer" class="form-control" placeholder="bestelnummer" required="" value="">
                                                    </div>
                                                    <div class="d-flex gap-3">
                                                        <!-- <span><button type="button" class="btn btn-primary">Fetch Info</button></span> -->
                                                        <select class="col-lg col-md col-sm-2 form-select" name="" id="">
                                                                    <option value="bol">Bol</option>
                                                                    <option value="amazon">Amazon</option>
                                                                    <option value="unikoop">Unikoop</option>
                                                        </select>
                                                    </div>
                                                    <input type="button" id="check_invoice" value="Fetch Info" class="btn btn-primary">

                                                </div>
                                            </div>
                                        <div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <form name="register" method="post" id="my_form" action="/bol/invoice_submit2"
                                                    enctype="multipart/form-data"
                                                    style="display:none;">
                                                    @csrf
                                                    <br>
                                                    <input type="hidden" value="2577628200" name="o_no" id="o_no">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label>Email</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <input style="margin-bottom: 5px;" type="email" name="email" id="or_email" value=""
                                                                    class="form-control">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label class="mb_margin">CC</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <input style="margin-bottom: 5px;" type="text" name="cc" value=""
                                                                    class="form-control"
                                                                    placeholder="can enter multiple emails separated by comma">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label>Subject</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <input style="margin-bottom: 5px;" type="text" name="subject" value="" id="subject"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <input type="hidden" name="finvoice_input" id="finvoice_input" value="">
                                                                <input type="hidden" name="fpackinglist_input" id="fpackinglist_input" value="">
                                                                <input type="hidden" name="sinvoice_input" id="sinvoice_input" value="">
                                                                <input type="hidden" name="tpackinglist_input" id="tpackinglist_input" value="">
                                                                <a style="display:none" href="" id="f_anchor">Invoice</a>
                                                                <a style="display:none" href="" id="sf_anchor">Packing List</a>
                                                                <a style="display:none" href="" id="second_anchor">Invoice</a>
                                                                <a style="display:none" href="" id="third_anchor">Packing List</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label>File(s)</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <input id="file_input" type="file" name="files[]" style="margin-bottom: 5px;"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <button class="btn btn-primary btn-block" id="s_email" style="padding: 9px;">
                                                                    Send Email
                                                                </button>
                                                            </div>
                                                            <input type="hidden" name="content" id="content" value="">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div id="new_template"
                                                                style="height: auto !important; border: 1px solid #ccc; border-radius: 4px; padding: 20px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div style="text-align:center; margin-bottom:20px">
                                            <form name="register" method="post" id="check_invoice_form2" action="" enctype="multipart/form-data"
                                                style="display:none">
                                                <input type="text" name="bestelnummer" id="bestelnummer2" class="form-control"
                                                    placeholder="bestelnummer" required="" value="">
                                            </form>
                                        </div>
                                    </div>

                                        {{-- <p class="alert alert-danger">Please configure your email template in settings tab area</p> --}}

                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->


            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
@endsection
@section('js')


@endsection
