@extends('layouts/app')
@section('title','Create Invoice | Unikoop')
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

                        <div class="row mt-5">
                            <div class="col-md-12 mt-5">
                                <div class="card">
                                    <div class="card-body mb-4">
                                        <h4 class="page-title" style="color: blue";>Create Invoice</h4>

                                        <hr>
                                        <div class="row">
                                        <div class="col-12 col-sm-4 col-md-6 col-lg-6 ">
                                            <h5 class="text-center">Order ID</h5>

                                        </div>
                                        <div class="col-12 col-sm-8 col-md-6 col-lg-6">
                                            <div class="input-group text-center">
                                                <div class="form-outline ">
                                                  <input type="search" id="form1" class="col-sm-6 col-xs-6 form-control " placeholder="bestelnummer"/>

                                                </div>
                                                <div>
                                                    <span><button type="button" class="btn btn-primary">Fetch Info

                                                    </button></span>
                                                </div>
                                              </div>
                                        </div>
                                        <div></div>

                                        </div>








                                         <!-- end .responsive-table-plugin-->
                                    </div>
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> &copy; UBold theme by <a href="">Coderthemes</a>
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-end footer-links d-none d-sm-block">
                                    <a href="javascript:void(0);">About Us</a>
                                    <a href="javascript:void(0);">Help</a>
                                    <a href="javascript:void(0);">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
@endsection
