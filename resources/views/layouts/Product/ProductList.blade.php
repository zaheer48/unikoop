@extends('layouts.app')
@section('title','Product List')
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
                    <!-- Start Content-->
                    <div class="container-fluid">
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
                                    <h4 class="page-title">Product Lists</h4>
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

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-bordered nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link py-2" data-bs-toggle="tab" href="#chat-tab" role="tab">
                            <i class="mdi mdi-message-text d-block font-22 my-1"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-2" data-bs-toggle="tab" href="#tasks-tab" role="tab">
                            <i class="mdi mdi-format-list-checkbox d-block font-22 my-1"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-2 active" data-bs-toggle="tab" href="#settings-tab" role="tab">
                            <i class="mdi mdi-cog-outline d-block font-22 my-1"></i>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content pt-0">
                    <div class="tab-pane" id="chat-tab" role="tabpanel">

                        <form class="search-bar p-3">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="mdi mdi-magnify"></span>
                            </div>
                        </form>

                        <h6 class="fw-medium px-3 mt-2 text-uppercase">Group Chats</h6>

                        <div class="p-2">
                            <a href="javascript: void(0);" class="text-reset notification-item ps-3 mb-2 d-block">
                                <i class="mdi mdi-checkbox-blank-circle-outline me-1 text-success"></i>
                                <span class="mb-0 mt-1">App Development</span>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item ps-3 mb-2 d-block">
                                <i class="mdi mdi-checkbox-blank-circle-outline me-1 text-warning"></i>
                                <span class="mb-0 mt-1">Office Work</span>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item ps-3 mb-2 d-block">
                                <i class="mdi mdi-checkbox-blank-circle-outline me-1 text-danger"></i>
                                <span class="mb-0 mt-1">Personal Group</span>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item ps-3 d-block">
                                <i class="mdi mdi-checkbox-blank-circle-outline me-1"></i>
                                <span class="mb-0 mt-1">Freelance</span>
                            </a>
                        </div>

                        <h6 class="fw-medium px-3 mt-3 text-uppercase">Favourites <a href="javascript: void(0);" class="font-18 text-danger"><i class="float-end mdi mdi-plus-circle"></i></a></h6>

                        <div class="p-2">
                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="d-flex align-items-start noti-user-item">
                                    <div class="position-relative me-2">
                                        <img src="assets/images/users/user-10.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status online"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Andrew Mackie</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">It will seem like simplified English.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="d-flex align-items-start noti-user-item">
                                    <div class="position-relative me-2">
                                        <img src="assets/images/users/user-1.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status away"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Rory Dalyell</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">To an English person, it will seem like simplified</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="d-flex align-items-start noti-user-item">
                                    <div class="position-relative me-2">
                                        <img src="assets/images/users/user-9.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status busy"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Jaxon Dunhill</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">To achieve this, it would be necessary.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <h6 class="fw-medium px-3 mt-3 text-uppercase">Other Chats <a href="javascript: void(0);" class="font-18 text-danger"><i class="float-end mdi mdi-plus-circle"></i></a></h6>

                        <div class="p-2 pb-4">
                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="d-flex align-items-start noti-user-item">
                                    <div class="position-relative me-2">
                                        <img src="assets/images/users/user-2.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status online"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Jackson Therry</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">Everyone realizes why a new common language.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="d-flex align-items-start noti-user-item">
                                    <div class="position-relative me-2">
                                        <img src="assets/images/users/user-4.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status away"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Charles Deakin</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">The languages only differ in their grammar.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="d-flex align-items-start noti-user-item">
                                    <div class="position-relative me-2">
                                        <img src="assets/images/users/user-5.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status online"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Ryan Salting</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">If several languages coalesce the grammar of the resulting.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="d-flex align-items-start noti-user-item">
                                    <div class="position-relative me-2">
                                        <img src="assets/images/users/user-6.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status online"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Sean Howse</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">It will seem like simplified English.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="d-flex align-items-start noti-user-item">
                                    <div class="position-relative me-2">
                                        <img src="assets/images/users/user-7.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status busy"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Dean Coward</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">The new common language will be more simple.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="d-flex align-items-start noti-user-item">
                                    <div class="position-relative me-2">
                                        <img src="assets/images/users/user-8.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status away"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Hayley East</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">One could refuse to pay expensive translators.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <div class="text-center mt-3">
                                <a href="javascript:void(0);" class="btn btn-sm btn-white">
                                    <i class="mdi mdi-spin mdi-loading me-2"></i>
                                    Load more
                                </a>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane" id="tasks-tab" role="tabpanel">
                        <h6 class="fw-medium p-3 m-0 text-uppercase">Working Tasks</h6>
                        <div class="px-2">
                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                                <p class="text-muted mb-0">App Development<span class="float-end">75%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                                <p class="text-muted mb-0">Database Repair<span class="float-end">37%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 37%" aria-valuenow="37" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                                <p class="text-muted mb-0">Backup Create<span class="float-end">52%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 52%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>
                        </div>

                        <h6 class="fw-medium px-3 mb-0 mt-4 text-uppercase">Upcoming Tasks</h6>

                        <div class="p-2">
                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                                <p class="text-muted mb-0">Sales Reporting<span class="float-end">12%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                                <p class="text-muted mb-0">Redesign Website<span class="float-end">67%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 67%" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                                <p class="text-muted mb-0">New Admin Design<span class="float-end">84%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 84%" aria-valuenow="84" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>
                        </div>

                        <div class="p-3 mt-2 d-grid">
                            <a href="javascript: void(0);" class="btn btn-success waves-effect waves-light">Create Task</a>
                        </div>

                    </div>
                    <div class="tab-pane active" id="settings-tab" role="tabpanel">
                        <h6 class="fw-medium px-3 m-0 py-2 font-13 text-uppercase bg-light">
                            <span class="d-block py-1">Theme Settings</span>
                        </h6>

                        <div class="p-3">
                            <div class="alert alert-warning" role="alert">
                                <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
                            </div>

                            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Color Scheme</h6>
                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="layout-color" value="light"
                                    id="light-mode-check" checked />
                                <label class="form-check-label" for="light-mode-check">Light Mode</label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="layout-color" value="dark"
                                    id="dark-mode-check" />
                                <label class="form-check-label" for="dark-mode-check">Dark Mode</label>
                            </div>

                            <!-- Width -->
                            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Width</h6>
                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="layout-width" value="fluid" id="fluid-check" checked />
                                <label class="form-check-label" for="fluid-check">Fluid</label>
                            </div>
                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="layout-width" value="boxed" id="boxed-check" />
                                <label class="form-check-label" for="boxed-check">Boxed</label>
                            </div>

                            <!-- Menu positions -->
                            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Menus (Leftsidebar and Topbar) Positon</h6>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="menu-position" value="fixed" id="fixed-check"
                                    checked />
                                <label class="form-check-label" for="fixed-check">Fixed</label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="menu-position" value="scrollable"
                                    id="scrollable-check" />
                                <label class="form-check-label" for="scrollable-check">Scrollable</label>
                            </div>

                            <!-- Left Sidebar-->
                            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Left Sidebar Color</h6>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="leftbar-color" value="light" id="light-check" />
                                <label class="form-check-label" for="light-check">Light</label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="leftbar-color" value="dark" id="dark-check" checked/>
                                <label class="form-check-label" for="dark-check">Dark</label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="leftbar-color" value="brand" id="brand-check" />
                                <label class="form-check-label" for="brand-check">Brand</label>
                            </div>

                            <div class="form-check form-switch mb-3">
                                <input type="checkbox" class="form-check-input" name="leftbar-color" value="gradient" id="gradient-check" />
                                <label class="form-check-label" for="gradient-check">Gradient</label>
                            </div>

                            <!-- size -->
                            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Left Sidebar Size</h6>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="leftbar-size" value="default"
                                    id="default-size-check" checked />
                                <label class="form-check-label" for="default-size-check">Default</label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="leftbar-size" value="condensed"
                                    id="condensed-check" />
                                <label class="form-check-label" for="condensed-check">Condensed <small>(Extra Small size)</small></label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="leftbar-size" value="compact"
                                    id="compact-check" />
                                <label class="form-check-label" for="compact-check">Compact <small>(Small size)</small></label>
                            </div>

                            <!-- User info -->
                            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Sidebar User Info</h6>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="sidebar-user" value="fixed" id="sidebaruser-check" />
                                <label class="form-check-label" for="sidebaruser-check">Enable</label>
                            </div>


                            <!-- Topbar -->
                            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Topbar</h6>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="topbar-color" value="dark" id="darktopbar-check"
                                    checked />
                                <label class="form-check-label" for="darktopbar-check">Dark</label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="topbar-color" value="light" id="lighttopbar-check" />
                                <label class="form-check-label" for="lighttopbar-check">Light</label>
                            </div>


                            <div class="d-grid mt-4">
                                <button class="btn btn-primary" id="resetBtn">Reset to Default</button>
                                <a href="https://1.envato.market/uboldadmin" class="btn btn-danger mt-3" target="_blank"><i class="mdi mdi-basket me-1"></i> Purchase Now</a>
                            </div>

                        </div>

                    </div>
                </div>

            </div> <!-- end slimscroll-menu-->
        </div>


    </body>
</html>

@endsection
