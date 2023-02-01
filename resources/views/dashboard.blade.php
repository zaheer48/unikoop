@extends('layouts.app')
@section('title','Dashboard | Unikoop')
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
                                <div class="page-title-box">
                                    <!-- <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Apps</a></li>
                                            <li class="breadcrumb-item active">Companies</li>
                                        </ol>
                                    </div> -->
                                    <h4 class="page-title">Companies</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->


                        <div class="row">
                            <div class="col-12">
                                <div class="card">

                                        <!-- < class="row justify-content-between">
                                            <div class="col-md-8">
                                                <form class="d-flex flex-wrap align-items-center">
                                                    <label for="inputPassword2" class="visually-hidden">Search</label>
                                                    <div class="me-3">
                                                        <input type="search" class="form-control my-1 my-md-0" id="inputPassword2" placeholder="Search...">
                                                    </div>
                                                    <label for="status-select" class="me-2">Sort By</label>
                                                    <div class="me-sm-3">
                                                        <select class="form-select my-1 my-md-0" id="status-select">
                                                            <option>Select</option>
                                                            <option>Date</option>
                                                            <option selected>Name</option>
                                                            <option>Revenue</option>
                                                            <option>Employees</option>
                                                        </select>
                                                    </div>
                                                </form>
                                                </div>
                                               <div class="col-md-4">
                                                <div class="text-md-end mt-3 mt-md-0">
                                                    <button type="button" class="btn btn-success waves-effect waves-light me-1"><i class="mdi mdi-cog"></i></button>
                                                    <button type="button" class="btn btn-danger waves-effect waves-light me-1"><i class="mdi mdi-plus-circle me-1"></i> Add New</button>
                                                </div>
                                            </div><!-- end col-->

                                    </div>
                                </div>
                                 <!-- end card -->
                            </div>
                        </div>

                        <div class="row">
                            @if (isset($available_modules['Amazon']))
                            <div class="col-lg-4">
                                <div class="card bg-pattern">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img src="{{ URL::asset('assets/images/companies/amazon.png') }}" alt="logo" class="avatar-xl rounded-circle mb-3">
                                            <h4 class="mb-1 font-20">Amazon.de Inc.</h4>
                                            <p class="text-muted  font-14">Seattle, Washington</p>
                                        </div>

                                        <p class="font-14 text-center text-muted">
                                            Amazon.de, Inc., doing business as Amazon, is an American electronic commerce and cloud computing company based in Seattle..
                                        </p>

                                        <div class="text-center">
                                            <a href="@if(Route::has('amazon')){{ route('amazon') }}@endif" class="btn btn-sm btn-light">View more info</a>
                                        </div>

                                        <div class="row mt-4 text-center">
                                            <div class="col-6">
                                                <h5 class="fw-normal text-muted">Revenue (USD)</h5>
                                                <h4>17,786 cr</h4>
                                            </div>
                                            <div class="col-6">
                                                <h5 class="fw-normal text-muted">Number of employees</h5>
                                                <h4>566k</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card -->
                            </div><!-- end col -->
                            @endif
                            @if (isset($available_modules['Unikoop']))
                            <div class="col-lg-4">
                                <div class="card bg-pattern">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img src="{{ URL::asset('assets/images/companies/unikoop.jpg') }}" alt="logo" class="avatar-xl rounded-circle mb-3">
                                            <h4 class="mb-1 font-20">UniKoop Inc.</h4>
                                            <p class="text-muted  font-14">Cupertino, California</p>
                                        </div>

                                        <p class="font-14 text-center text-muted">
                                            UniKoop Inc. is an American multinational technology company headquartered in Cupertino, California, that designs, develops,
                                            and sells..
                                        </p>

                                        <div class="text-center">
                                            <a href="@if(Route::has('unikoop')){{ route('unikoop') }}@endif" class="btn btn-sm btn-light">View more info</a>
                                        </div>

                                        <div class="row mt-4 text-center">
                                            <div class="col-6">
                                                <h5 class="fw-normal text-muted">Revenue (USD)</h5>
                                                <h4>22,923.4 cr</h4>
                                            </div>
                                            <div class="col-6">
                                                <h5 class="fw-normal text-muted">Number of employees</h5>
                                                <h4>47k</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card -->
                            </div><!-- end col -->
                            @endif
                            @if (isset($available_modules['Bestlist']))
                            <div class="col-lg-4">
                                <div class="card bg-pattern">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img src="{{ URL::asset('assets/images/companies/google.png') }}" alt="logo" class="avatar-xl rounded-circle mb-3">
                                            <h4 class="mb-1 font-20">Bestlist.ni LLC</h4>
                                            <p class="text-muted  font-14">Menlo Park, California</p>
                                        </div>

                                        <p class="font-14 text-center text-muted">
                                            Bestlist.ni LLC is an American multinational technology company that specializes in Internet-related services and products, which
                                            include..
                                        </p>

                                        <div class="text-center">
                                            <a href="@if(Route::has('bestlist')){{ route('bestlist') }}@endif" class="btn btn-sm btn-light">View more info</a>
                                        </div>

                                        <div class="row mt-4 text-center">
                                            <div class="col-6">
                                                <h5 class="fw-normal text-muted">Revenue (USD)</h5>
                                                <h4>110 bn</h4>
                                            </div>
                                            <div class="col-6">
                                                <h5 class="fw-normal text-muted">Number of employees</h5>
                                                <h4>72k</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card -->
                            </div><!-- end col -->
                            @endif
                        </div>
                        <!-- end row -->

                        <div class="row">
                            @if (isset($available_modules['Bol']))
                            <div class="col-lg-4">
                                <div class="card bg-pattern">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img src="{{ URL::asset('assets/images/companies/bol.jpeg') }}" alt="logo" class="avatar-xl rounded-circle mb-3">
                                            <h4 class="mb-1 font-20">Bol.com Inc.</h4>
                                            <p class="text-muted  font-14">San Francisco, California</p>
                                        </div>

                                        <p class="font-14 text-center text-muted">
                                            Bol.com is a company based in San Francisco that operates an online marketplace and hospitality service
                                            for people to lease or rent..
                                        </p>
                                        <div class="text-center">
                                            <a href="@if(Route::has('bol')){{ route('all.orders') }}@endif" class="btn btn-sm btn-light">View more info</a>
                                        </div>

                                        <div class="row mt-4 text-center">
                                            <div class="col-6">
                                                <h5 class="fw-normal text-muted">Revenue (USD)</h5>
                                                <h4>260 cr</h4>
                                            </div>
                                            <div class="col-6">
                                                <h5 class="fw-normal text-muted">Number of employees</h5>
                                                <h4>3.1k</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card -->
                            </div><!-- end col -->
                            @endif
                            @if (isset($available_modules['Ebay']))
                            <div class="col-lg-4">
                                <div class="card bg-pattern">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img src="{{ URL::asset('assets/images/companies/EBay1.png') }}" alt="logo" class="avatar-xl rounded-circle mb-3">
                                            <h4 class="mb-1 font-20">ebay.</h4>
                                            <p class="text-muted  font-14">Cambridge, Massachusetts</p>
                                        </div>

                                        <p class="font-14 text-center text-muted">
                                            ebay is an American online social media and social networking service company based in Menlo Park, California..
                                        </p>

                                        <div class="text-center">
                                            <a href="@if(Route::has('ebay')){{ route('ebay') }}@endif" class="btn btn-sm btn-light">View more info</a>
                                        </div>

                                        <div class="row mt-4 text-center">
                                            <div class="col-6">
                                                <h5 class="fw-normal text-muted">Revenue (USD)</h5>
                                                <h4>9.16 bn</h4>
                                            </div>
                                            <div class="col-6">
                                                <h5 class="fw-normal text-muted">Number of employees</h5>
                                                <h4>25.1k</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card -->
                            </div><!-- end col -->
                            @endif
                            @if (isset($available_modules['Homee']))
                            <div class="col-lg-4">
                                <div class="card bg-pattern">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img src="{{ URL::asset('assets/images/companies/homee.png') }}" alt="logo" class="avatar-xl rounded-circle mb-3">
                                            <h4 class="mb-1 font-20">Homee</h4>
                                            <p class="text-muted  font-14">San Jose, California</p>
                                        </div>

                                        <p class="font-14 text-center text-muted">
                                            Homee Systems, Inc. is an American multinational technology conglomerate headquartered in San Jose, California..
                                        </p>

                                        <div class="text-center">
                                            <a href="@if(Route::has('homee')){{ route('homee') }}@endif" class="btn btn-sm btn-light">View more info</a>
                                        </div>

                                        <div class="row mt-4 text-center">
                                            <div class="col-6">
                                                <h5 class="fw-normal text-muted">Revenue (USD)</h5>
                                                <h4>4,800.5 cr</h4>
                                            </div>
                                            <div class="col-6">
                                                <h5 class="fw-normal text-muted">Number of employees</h5>
                                                <h4>73.4k</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card -->
                            </div><!-- end col -->
                            @endif
                        </div>
                        <!-- end row -->

                        {{-- <div class="row">
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
                        </div> --}}
                        <!-- end row -->

                    </div> <!-- container -->

                </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->


</body>
@endsection


