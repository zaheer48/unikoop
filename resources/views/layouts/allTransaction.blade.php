@extends('layouts/app')
@section('title','All Transaction | Unikoop')
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
                                    <h2 class="page-title" style="color: blue";>Payment History</h2>
                                </div>
                            </div>
                        </div>




                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">











                                        <div class="responsive-table-plugin">
                                            <div class="table-rep-plugin">
                                                <div class="table-responsive">
                                                    <div class="row" >
                                                        <div class="col-4"></div>
                                                        <div class="col-4"></div>
                                                        <div class="col-4" >
                                                            <div class="input-group" >
                                                                <div class="form-outline" style="margin-left: 70px;">
                                                                  <input type="search" id="form1" class="form-control" />

                                                                </div>
                                                                <button type="button" class="btn btn-primary" style="float: right;">
                                                                  <i class="fas fa-search"></i>
                                                                </button>
                                                              </div>
                                                        </div>
                                                    </div>
                                                    <table id="tech-companies-1" class="table table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th> ID</th>
                                                            <th>Amount</th>
                                                            <th width="30%">Discription</th>
                                                            <th>Date</th>
                                                            <th >Status</th>
                                                            <th >PDF</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>




                                                        <tr>
                                                            <td>200</td>
                                                            <td>20000</td>
                                                            <td>test payment</td>
                                                            <td>test 2008-12-06 15:09:08</td>
                                                            <td>Approved</td>
                                                        <td><button type="button" class="btn btn-primary"  aria-haspopup="true" aria-expanded="false">PDF <i class="fe-file-plus"></i></button></td>


                                                        </tr>
                                                        <tr>
                                                            <td>200</td>
                                                            <td>20000</td>
                                                            <td>test payment</td>
                                                            <td>test 2008-12-06 15:09:08</td>
                                                            <td>Approved</td>
                                                        <td><button type="button" class="btn btn-primary"  aria-haspopup="true" aria-expanded="false">PDF <i class="fe-file-plus"></i></button></td>


                                                        </tr>
                                                        <tr>
                                                            <td>200</td>
                                                            <td>20000</td>
                                                            <td>test payment</td>
                                                            <td>test 2008-12-06 15:09:08</td>
                                                            <td>Approved</td>
                                                        <td><button type="button" class="btn btn-primary"  aria-haspopup="true" aria-expanded="false">PDF <i class="fe-file-plus"></i></button></td>


                                                        <tr>
                                                            <td>200</td>
                                                            <td>20000</td>
                                                            <td>test payment</td>
                                                            <td>test 2008-12-06 15:09:08</td>
                                                            <td>Approved</td>
                                                        <td><button type="button" class="btn btn-primary"  aria-haspopup="true" aria-expanded="false">PDF <i class="fe-file-plus"></i></button></td>


                                                        </tr>
                                                        <tr>
                                                            <td>200</td>
                                                            <td>20000</td>
                                                            <td>test payment</td>
                                                            <td>test 2008-12-06 15:09:08</td>
                                                            <td>Approved</td>
                                                        <td><button type="button" class="btn btn-primary"  aria-haspopup="true" aria-expanded="false">PDF <i class="fe-file-plus"></i></button></td>


                                                        </tr>
                                                        <tr>
                                                            <td>200</td>
                                                            <td>20000</td>
                                                            <td>test payment</td>
                                                            <td>test 2008-12-06 15:09:08</td>
                                                            <td>Approved</td>
                                                        <td><button type="button" class="btn btn-primary"  aria-haspopup="true" aria-expanded="false">PDF <i class="fe-file-plus"></i></button></td>


                                                        </tr>
                                                        <tr>
                                                            <td>200</td>
                                                            <td>20000</td>
                                                            <td>test payment</td>
                                                            <td>test 2008-12-06 15:09:08</td>
                                                            <td>Approved</td>
                                                        <td><button type="button" class="btn btn-primary"  aria-haspopup="true" aria-expanded="false">PDF <i class="fe-file-plus"></i></button></td>


                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                </div> <!-- end .table-responsive -->

                                            </div> <!-- end .table-rep-plugin-->
                                        </div> <!-- end .responsive-table-plugin-->
                                    </div>
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="text-end">
                                    <ul class="pagination pagination-rounded justify-content-end">
                                        <li class="page-item">
                                            <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                                <span aria-hidden="true">«</span>
                                                <span class="visually-hidden">Previous</span>
                                            </a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="javascript: void(0);">1</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                                <span aria-hidden="true">»</span>
                                                <span class="visually-hidden">Next</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> <!-- container -->

                </div> <!-- content -->

              

            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->



@endsection
