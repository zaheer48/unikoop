@extends('layouts/app')
@section('title','Download Label | Unikoop')
@section('content')


<div class="content-page">
    <div class="content ">

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
                    <h2 class="page-title" style="color: blue";>Download</h2>
                </div>
            </div>
        </div>




        <!-- end page title -->
                <div class="row">
                    <div class="col-xl-12">
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

                                <h4 class="header-title mb-3">Top 5 Users Balances</h4>

                                <div class="table-responsive">
                                    <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                                        <thead class="table-light">
                                            <tr>
                                                <th colspan="2">Profile</th>
                                                <th>Currency</th>
                                                <th>Balance</th>
                                                <th>Reserved in orders</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="width: 36px;">
                                                    <img src="assets/images/users/user-2.jpg" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                                                </td>

                                                <td>
                                                    <h5 class="m-0 fw-normal">Tomaslau</h5>
                                                    <p class="mb-0 text-muted"><small>Member Since 2017</small></p>
                                                </td>

                                                <td>
                                                    <i class="mdi mdi-currency-btc text-primary"></i> BTC
                                                </td>

                                                <td>
                                                    0.00816117 BTC
                                                </td>

                                                <td>
                                                    0.00097036 BTC
                                                </td>

                                                <td>
                                                    <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-plus"></i></a>
                                                    <a href="javascript: void(0);" class="btn btn-xs btn-danger"><i class="mdi mdi-minus"></i></a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="width: 36px;">
                                                    <img src="assets/images/users/user-3.jpg" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                                                </td>

                                                <td>
                                                    <h5 class="m-0 fw-normal">Erwin E. Brown</h5>
                                                    <p class="mb-0 text-muted"><small>Member Since 2017</small></p>
                                                </td>

                                                <td>
                                                    <i class="mdi mdi-currency-eth text-primary"></i> ETH
                                                </td>

                                                <td>
                                                    3.16117008 ETH
                                                </td>

                                                <td>
                                                    1.70360009 ETH
                                                </td>

                                                <td>
                                                    <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-plus"></i></a>
                                                    <a href="javascript: void(0);" class="btn btn-xs btn-danger"><i class="mdi mdi-minus"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 36px;">
                                                    <img src="assets/images/users/user-4.jpg" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                                                </td>

                                                <td>
                                                    <h5 class="m-0 fw-normal">Margeret V. Ligon</h5>
                                                    <p class="mb-0 text-muted"><small>Member Since 2017</small></p>
                                                </td>

                                                <td>
                                                    <i class="mdi mdi-currency-eur text-primary"></i> EUR
                                                </td>

                                                <td>
                                                    25.08 EUR
                                                </td>

                                                <td>
                                                    12.58 EUR
                                                </td>

                                                <td>
                                                    <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-plus"></i></a>
                                                    <a href="javascript: void(0);" class="btn btn-xs btn-danger"><i class="mdi mdi-minus"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 36px;">
                                                    <img src="assets/images/users/user-5.jpg" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                                                </td>

                                                <td>
                                                    <h5 class="m-0 fw-normal">Jose D. Delacruz</h5>
                                                    <p class="mb-0 text-muted"><small>Member Since 2017</small></p>
                                                </td>

                                                <td>
                                                    <i class="mdi mdi-currency-cny text-primary"></i> CNY
                                                </td>

                                                <td>
                                                    82.00 CNY
                                                </td>

                                                <td>
                                                    30.83 CNY
                                                </td>

                                                <td>
                                                    <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-plus"></i></a>
                                                    <a href="javascript: void(0);" class="btn btn-xs btn-danger"><i class="mdi mdi-minus"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 36px;">
                                                    <img src="assets/images/users/user-6.jpg" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                                                </td>

                                                <td>
                                                    <h5 class="m-0 fw-normal">Luke J. Sain</h5>
                                                    <p class="mb-0 text-muted"><small>Member Since 2017</small></p>
                                                </td>

                                                <td>
                                                    <i class="mdi mdi-currency-btc text-primary"></i> BTC
                                                </td>

                                                <td>
                                                    2.00816117 BTC
                                                </td>

                                                <td>
                                                    1.00097036 BTC
                                                </td>

                                                <td>
                                                    <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-plus"></i></a>
                                                    <a href="javascript: void(0);" class="btn btn-xs btn-danger"><i class="mdi mdi-minus"></i></a>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>

</div>

@endsection
