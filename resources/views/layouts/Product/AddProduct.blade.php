@extends('layouts.app')
@section('title', 'Add Product  | Unikoop')
@section('content')
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <form class="d-flex align-items-center mb-3">
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
                                        </form>
                                    </div>
                                    <h4 class="page-title">Add Product</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
            <!-- Start Content-->
            <div class="container-fluid">

                <div class="row ">
                    <div class="col-md-12">
                        <div class="col-12 col-sm-4 col-md-6 col-lg-6 my-4">
                            <h3>Sell New Item</h3>

                        </div>


                        <div class="card">

                            <div class="card-body mb-4">
                                <h3 class="page-title fw-bold">You are the first to sell this item on Keydevs.com</h3>
                                <p>We don not yet know the artical you entered during the search in our range.Enter the EAN
                                    and Product name below to tell us what you will be selling </p>


                                <div class="row">




                                    <form action="" method="">
                                        <div class="col-12 col-sm-8 col-md-6 col-lg-6">
                                            <div class="input-group mt-3">
                                                <label for="" class="fw-bold">EAN</label>

                                                <div class="input-group ">
                                                    <input type="text" id="EAN" name="EAN"
                                                        class="col-sm-6 col-xs-6 form-control " placeholder="EAN Number" />


                                                </div>
                                            </div>
                                            <div class="input-group mt-3">

                                                <label for="" class="fw-bold">The name of your Article</label>

                                                <div class="input-group">
                                                    <input type="text" id="article" name="article"
                                                        class="col-sm-6 col-xs-6 form-control " placeholder="Sportlife- Extra Mint Chewing gum - Value pack" />

                                                </div>
                                            </div>
                                            <div class="subtitle">
                                                <p>[Brand Name].[Series]-[Product-Group]-[Feature-1]-[Feature-2]-[Feature-3]
                                                </p>

                                            </div>
                                            <div class="btn-group my-3">
                                                <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Continue</button>
                                                        <h5 class="mx-3"><a href="">or go back</a></h5>
                                            </div>

                                        </div>


                                        <div>
                                    </form>


                                </div>

                            </div>








                            <!-- end .responsive-table-plugin-->
                        </div>
                    </div> <!-- end card -->
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
