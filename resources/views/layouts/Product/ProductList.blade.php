@extends('layouts.app')
@section('title','Product List  | Unikoop')
@section('content')


    <!-- body start -->
    <body data-layout-mode="default" data-theme="light" data-layout-width="fluid" data-topbar-color="dark" data-menu-position="fixed" data-leftbar-color="light" data-leftbar-size='default' data-sidebar-user='false'>

        <!-- Begin page -->
        <div id="wrapper">
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
                                <h4 class="page-title">Product List</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                       <div class="findarticle border">
                        <h4>Find Article</h4>

                            <div class="card m-4">
                                <div class="card-body  border-bottom">
                                    <div class="row">
                                        <form action="" method="">
                                            <div class="col-12 col-sm-8 col-md-6 col-lg-6">
                                                <div class="input-group mt-3">
                                                    <label for="" class="fw-bold">Find your article</label>

                                                    <div class="input-group ">
                                                        <input type="search" id="EAN" name="EAN"
                                                            class="col-sm-6 col-xs-6 form-control " placeholder="Search by EAN ISBN ,title etc " />

                                                            <button>
                                                                <i class="fa-solid fa-magnifying-glass"></i>

                                                            </button>



                                                    </div>

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card m-4">

                                <div class="card border-start border-primary border-4 bg-soft-info col-12 col-sm-8 col-md-6 col-lg-12 p-2">

                                                        {{-- <div class="card-body col-12 col-sm-8 col-md-6 col-lg-6 "> --}}
                                                        <div class="info ">
                                                        <p>Good to know</p>
                                                        <div class="d-flex">
                                                            <p ><i class="fa-solid fa-circle-info "></i>
                                                            <div
                                                            class="mx-2" >
                                                            On bol products are sold by several partners.it is therefore possible that the product you want to sell is already in our catalogue.Therefore first search for the item you want to sell.if your article is not listed,we do not yet know the article and you can add it!</div></p>
                                                        </div>
                                                        </div>

                                                        {{-- </div> --}}
                                </div>
                            </div>

                    </div>





                    <!-- Start Content-->


                    <div class="container-fluid mt-3">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="">
                                    <!-- <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                            <li class="breadcrumb-item active">Responsive Table</li>
                                        </ol>
                                    </div> -->
                                    {{-- <h4 class="page-title">Product Lists</h4> --}}
                                </div>
                                <div data-simplebar class="h-100">
                                    <!-- Nav tabs -->
                                    <!-- Tab panes -->
                                    <div class="tab-content pt-0">
                                        <div class="tab-pane" id="chat-tab" role="tabpanel">
                                        </div>
                                        <div class="tab-pane" id="tasks-tab" role="tabpanel">
                                        </div>
                                        <div class="tab-pane active" id="settings-tab" role="tabpanel">
                                        </div>
                                    </div>
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
                                                    <ul class="nav nav-pills navtab-bg nav-justified">
                                                    <div class="button-list">
                                                         <button type="button" class="btn btn-primary waves-effect waves-light">Fetch Order From Bol.com(NL)</button>
                                                        <button type="button" class="btn btn-primary waves-effect waves-light">Fetch Order From Bol.com(BE)</button>
                                                        <button type="button" class="btn btn-info rounded-pill waves-effect waves-light">Total Orders5152</button>
                                                        <button type="button" class="btn btn-info rounded-pill waves-effect waves-light">Active Orders1696</button>



                                                        <button type="button" class="btn btn-info rounded-pill waves-effect waves-light">Pending Orders3446</button>



                                                        <button type="button" class="btn btn-danger rounded-pill waves-effect waves-light">Failure Orders10</button>


                                                    </div>
                                                    </ul>
                                                    <table id="tech-companies-1" class="table table-striped">
                                                        <thead>
                                                        <tr>
                                                            <!-- <th>Id</th>
                                                            <th>Date</th>
                                                            <th>Orders</th>
                                                            <th>Site</th>
                                                            <th>Label</th>

                                                            <th>Action</th> -->

                                                            <th>Article</th>
                                                            <th>Product group</th>
                                                            <th>Other Providers</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>

                                                                    <div class="d-flex">
                                                                        <img src="assets\images\products\product-1.png" alt=""
                                                                        width="5%" height="5%">
                                                                        <div class="info mx-" style="text-decoration:none">
                                                                            <ul style="list-style: none;">
                                                                                <li class="mt-1">
                                                                                    <strong>Tea Shirt  |  Tea Shirt</strong>

                                                                                </li>

                                                                                <li class="mt-1"><i class="fa-solid fa-arrow-up-right-from-square"> | </i>  EAN : 342353225 <i class="fa-regular fa-file"> | </i> Lorella</li>
                                                                            </ul>

                                                                        </div>

                                                                    </div>

                                                                </td>
                                                                <td>04-11-2022 01:12:34</td>
                                                                <td>9</td>
                                                                <td>
                                                                    <div class="btn-group mb-2">
                                                                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Add</button>

                                                                    </div>
                                                                </td>
                                                                <!-- <td>bol-bc</td>
                                                                <td>pending Fetch(9)</td>

                                                                <td><div class="btn-group mb-2">
                                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="mdi mdi-chevron-down"></i></button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item" href="#">Bol Update</a>
                                                                        <a class="dropdown-item" href="#">Pick List(Products)</a>
                                                                        <a class="dropdown-item" href="#">Pick List(Quantity)</a>
                                                                        <a class="dropdown-item" href="#">DHL CSV</a>
                                                                        <a class="dropdown-item" href="#">Packing List</a>
                                                                        <a class="dropdown-item" href="#">Invoice</a>
                                                                        <a class="dropdown-item" href="#">Emails</a>
                                                                        <a class="dropdown-item" href="#">Delete</a>

                                                                    </div></td> -->
                                                            </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="assets\images\products\product-2.png" alt=""
                                                                    width="5%" height="5%">
                                                                    <div class="info mx-" style="text-decoration:none">
                                                                        <ul style="list-style: none;">
                                                                            <li class="mt-1">
                                                                                <strong>Tea Shirt  |  Tea Shirt</strong>

                                                                            </li>

                                                                            <li class="mt-1"><i class="fa-solid fa-arrow-up-right-from-square"> | </i>  EAN : 342353225 <i class="fa-regular fa-file"> | </i> Lorella</li>
                                                                        </ul>

                                                                    </div>

                                                                </div>

                                                            </td>
                                                            <td>04-11-2022 01:12:34</td>
                                                            <td>9</td>
                                                            <!-- <td>bol-bc</td>
                                                            <td>pending Fetch(9)</td>

                                                            <td><div class="btn-group mb-2">
                                                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="mdi mdi-chevron-down"></i></button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="#">Bol Update</a>
                                                                    <a class="dropdown-item" href="#">Pick List(Products)</a>
                                                                    <a class="dropdown-item" href="#">Pick List(Quantity)</a>
                                                                    <a class="dropdown-item" href="#">DHL CSV</a>
                                                                    <a class="dropdown-item" href="#">Packing List</a>
                                                                    <a class="dropdown-item" href="#">Invoice</a>
                                                                    <a class="dropdown-item" href="#">Emails</a>
                                                                    <a class="dropdown-item" href="#">Delete</a>

                                                                </div></td> -->
                                                        </tr>




                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="assets\images\products\product-7.png" alt=""
                                                                    width="5%" height="5%">
                                                                    <div class="info mx-" style="text-decoration:none">
                                                                        <ul style="list-style: none;">
                                                                            <li class="mt-1" >

                                                                                <strong>Tea Shirt  |  Tea Shirt</strong>

                                                                            </li>

                                                                            <li class="mt-1"><i class="fa-solid fa-arrow-up-right-from-square"> | </i>  EAN : 342353225 <i class="fa-regular fa-file"> | </i> Lorella</li>
                                                                        </ul>

                                                                    </div>

                                                                </div>

                                                            </td>
                                                            <td>04-11-2022 01:12:34</td>
                                                            <td>9</td>
                                                            <td>
                                                                <div class="btn-group mb-2">
                                                                <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Add</button>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="assets\images\products\product-8.png" alt=""
                                                                    width="5%" height="5%">
                                                                    <div class="info mx-" style="text-decoration:none">
                                                                        <ul style="list-style: none;">
                                                                            <li class="mt-1" >
                                                                                <strong>Tea Shirt  |  Tea Shirt</strong>

                                                                            </li>


                                                                            <li class="mt-1" ><i class="fa-solid fa-arrow-up-right-from-square"> | </i>  EAN : 342353225 <i class="fa-regular fa-file"> | </i> Lorella</li>
                                                                        </ul>

                                                                    </div>

                                                                </div>

                                                            </td>



                                                            <td>04-11-2022 01:12:34</td>
                                                            <td>9</td>
                                                            <td>
                                                                <div class="btn-group mb-2">
                                                                <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Add</button>

                                                                </div>
                                                            </td>
                                                        </tr>


                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="assets\images\products\product-4.png" alt=""
                                                                    width="5%" height="5%">
                                                                    <div class="info mx-" style="text-decoration:none">
                                                                        <ul style="list-style: none;">
                                                                            <li class="mt-1">
                                                                            <strong>Tea Shirt  |  Tea Shirt</strong>

                                                                            </li>

                                                                            <li class="mt-1"><i class="fa-solid fa-arrow-up-right-from-square"> | </i>  EAN : 342353225 <i class="fa-regular fa-file"> | </i> Lorella</li>
                                                                        </ul>

                                                                    </div>

                                                                </div>

                                                            </td>

                                                            <td>04-11-2022 01:12:34</td>
                                                            <td>9</td>
                                                            <td>
                                                                <div class="btn-group mb-2">
                                                                <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Add</button>

                                                                </div>
                                                            </td>
                                                        </tr>



                                                        <!-- Repeat -->
                                                        </tbody>
                                                    </table>

                                                    <div class="text-center my-3">  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Add New Item</button></div>
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


        </div>
        <!-- END wrapper -->

        


    </body>
</html>

@endsection
