@extends('layouts/app')
@section('title','Upload Bol Sheet | Unikoop')
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
                                    <h2 class="page-title" style="color: blue";>Uplaod Bol Sheet</h2>
                                </div>
                            </div>
                        </div>




                        <!-- end page title -->


                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown float-end">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Edit Report</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                        </div>
                                    </div>

                                    <h4 class="header-title mb-3">Revenue History</h4>

                                    <div class="table-responsive">
                                        <table class="table table-borderless table-nowrap table-hover table-centered m-0">

                                            <thead class="table-light">
                                                <tr>
                                                    <th>Marketplaces</th>
                                                    <th>Date</th>
                                                    <th>Payouts</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <h5 class="m-0 fw-normal">Themes Market</h5>
                                                    </td>

                                                    <td>
                                                        Oct 15, 2018
                                                    </td>

                                                    <td>
                                                        $5848.68
                                                    </td>

                                                    <td>
                                                        <span class="badge bg-soft-warning text-warning">Upcoming</span>
                                                    </td>

                                                    <td>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-pencil"></i></a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <h5 class="m-0 fw-normal">Freelance</h5>
                                                    </td>

                                                    <td>
                                                        Oct 12, 2018
                                                    </td>

                                                    <td>
                                                        $1247.25
                                                    </td>

                                                    <td>
                                                        <span class="badge bg-soft-success text-success">Paid</span>
                                                    </td>

                                                    <td>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-pencil"></i></a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <h5 class="m-0 fw-normal">Share Holding</h5>
                                                    </td>

                                                    <td>
                                                        Oct 10, 2018
                                                    </td>

                                                    <td>
                                                        $815.89
                                                    </td>

                                                    <td>
                                                        <span class="badge bg-soft-success text-success">Paid</span>
                                                    </td>

                                                    <td>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-pencil"></i></a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <h5 class="m-0 fw-normal">Envato's Affiliates</h5>
                                                    </td>

                                                    <td>
                                                        Oct 03, 2018
                                                    </td>

                                                    <td>
                                                        $248.75
                                                    </td>

                                                    <td>
                                                        <span class="badge bg-soft-danger text-danger">Overdue</span>
                                                    </td>

                                                    <td>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-pencil"></i></a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <h5 class="m-0 fw-normal">Marketing Revenue</h5>
                                                    </td>

                                                    <td>
                                                        Sep 21, 2018
                                                    </td>

                                                    <td>
                                                        $978.21
                                                    </td>

                                                    <td>
                                                        <span class="badge bg-soft-warning text-warning">Upcoming</span>
                                                    </td>

                                                    <td>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-pencil"></i></a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <h5 class="m-0 fw-normal">Advertise Revenue</h5>
                                                    </td>

                                                    <td>
                                                        Sep 15, 2018
                                                    </td>

                                                    <td>
                                                        $358.10
                                                    </td>

                                                    <td>
                                                        <span class="badge bg-soft-success text-success">Paid</span>
                                                    </td>

                                                    <td>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-pencil"></i></a>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div> <!-- end .table-responsive-->
                                </div>
                            </div> <!-- end card-->
                        </div> <!-- end col -->







@endsection
