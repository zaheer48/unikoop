
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        {{-- <link rel="shortcut icon" href="assets/images/favicon.ico"> --}}
        <link href=" {{ URL::asset('assets/images/favicon.ico') }}" rel="shortcut icon"  />


        <!-- Responsive Table css -->
        <link href="{{URL::asset('assets/libs/admin-resources/rwd-table/rwd-table.min.css')}}" rel="stylesheet" type="text/css" />



        <!-- third party css -->
        <link href="{{URL::asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

        <!-- Font Awsome  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
       <!-- Favicon css -->
        <link href=" {{ URL::asset('assets/libs/images/favicon.ico') }}" rel="stylesheet"  />

        <!-- Plugins css -->
        {{-- <link href="assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" /> --}}
        <link href=" {{ URL::asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />

        {{-- <link href="assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" /> --}}
        <link href=" {{ URL::asset('assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />

        <!-- Bootstrap css -->
        {{-- <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> --}}
        <link href=" {{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- App css -->
        {{-- <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style"/> --}}
        <link href=" {{ URL::asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- icons -->
        {{-- <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" /> --}}
        <link href=" {{ URL::asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Head js -->
        {{-- <script src="asset/js/head.js"></script> --}}
        <script src="{{URL::asset('assets/js/head.js')}}"></script>





<style>
    .table-responsive {
    overflow-x: scroll;


      }


            .has-details {
          position: relative;
        }

        .details {
          position: absolute;
          top: 1;
          transform: translateY(0%) scale(0);
          transition: transform 0.1s ease-in;
          transform-origin: left;
          display: inline;
          background: white;
          z-index: 20;
          min-width: 100%;
          padding: 1rem;
          border: 1px solid black;
        }

        .has-details:hover span {
          transform: translateY(10%) scale(1);
        }

        /* td {
          padding: 1rem;
          background: whitesmoke;

        } */

        /* table {
          border-collapse: collapse;
        } */
        </style>
    </head>
 <!-- body start -->
 <body data-layout-mode="default" data-theme="light" data-layout-width="fluid" data-topbar-color="dark" data-menu-position="fixed" data-leftbar-color="light" data-leftbar-size='default' data-sidebar-user='false'>

    <!-- Begin page -->
    <div id="wrapper">
        <!-- Topbar Start -->
        <div class="navbar-custom">
            <div class="container-fluid">



                <ul class="list-unstyled topnav-menu float-end mb-0">

                    <li class="d-none d-lg-block">
                        <form class="app-search ">
                            <div class="app-search-box dropdown ">
                                <div class="input-group">
                                    <input type="search" class="form-control" placeholder="Search..." id="top-search">
                                    <button class="btn input-group-text" type="submit">
                                        <i class="fe-search"></i>
                                    </button>
                                </div>
                                <div class="dropdown-menu dropdown-lg" id="search-dropdown">
                                    <!-- item-->
                                    <div class="dropdown-header noti-title">
                                        <h5 class="text-overflow mb-2">Found 22 results</h5>
                                    </div>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="fe-home me-1"></i>
                                        <span>Analytics Report</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="fe-aperture me-1"></i>
                                        <span>How can I help you?</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="fe-settings me-1"></i>
                                        <span>User profile settings</span>
                                    </a>

                                    <!-- item-->
                                    <div class="dropdown-header noti-title">
                                        <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
                                    </div>

                                    <div class="notification-list">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="d-flex align-items-start">
                                                <img class="d-flex me-2 rounded-circle" src="{{URL::asset('assets/images/users/user-2.jpg')}}" alt="Generic placeholder image" height="32">
                                                <div class="w-100">
                                                    <h5 class="m-0 font-14">Erwin E. Brown</h5>
                                                    <span class="font-12 mb-0">UI Designer</span>
                                                </div>
                                            </div>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="d-flex align-items-start">
                                                <img class="d-flex me-2 rounded-circle" src="{{URL::asset('assets/images/users/user-5.jpg')}}" alt="Generic placeholder image" height="32">
                                                <div class="w-100">
                                                    <h5 class="m-0 font-14">Jacob Deo</h5>
                                                    <span class="font-12 mb-0">Developer</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </li>







                    <li class="dropdown d-none d-lg-inline-block topbar-dropdown">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="{{URL::asset('assets/images/flags/us.jpg')}}" alt="user-image" height="16">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <img src="{{URL::asset('assets/images/flags/germany.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">


                                <img src="{{URL::asset('assets/images/flags/italy.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">

                                <img src="{{URL::asset('assets/images/flags/spain.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">

                                <img src="{{URL::asset('assets/images/flags/russia.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                            </a>

                        </div>
                    </li>



                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="{{URL::asset('assets/images/users/user-1.jpg')}}" alt="user-image" class="rounded-circle">
                            <span class="pro-user-name ms-1">
                                Geneva <i class="mdi mdi-chevron-down"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                            item
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div>

                             item
                            <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-user"></i>
                                <span>My Account</span>
                            </a> -->



                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-settings"></i>
                                <span>Settings</span>
                            </a>

                            <!-- item-->
                            <a href="{{route('lockScreen')}}" class="dropdown-item notify-item">
                                <i class="fe-lock"></i>
                                <span>Lock Screen</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <!-- item-->

                            {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-log-out"></i>
                                <span>Logout</span>
                            </a> --}}
                            <form method="POST" action="{{ route('logout') }}" class="inline mx-3">
                                @csrf

                                <button type="submit" class=" btn btn-light underline text-sm text-gray-600 hover:text-gray-900 ml-2">
                                    {{ __('Log Out') }}
                                </button>
                            </form>

                        </div>
                    </li>
                    <li class="dropdown notification-list">
                        <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                            <i class="fe-settings noti-icon"></i>
                        </a>
                    </li>

                </ul>

                <!-- LOGO -->
                <div class="logo-box">
                    <a href="index.html" class="logo logo-dark text-center">
                        <span class="logo-sm">
                            <img src="{{URL::asset('assets/images/logo-sm.png')}}" alt="" height="22">
                            <!-- <span class="logo-lg-text-light">UBold</span> -->
                        </span>
                        <span class="logo-lg">
                            <img src=" {{URL::asset('assets/images/logo-dark.png')}}"  alt="" height="20">
                            <!-- <span class="logo-lg-text-light">U</span> -->
                        </span>
                    </a>
                    <a href="index.html" class="logo logo-light text-center">
                        <span class="logo-sm">
                            <img src="{{URL::asset('assets/images/logo-sm.png')}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{URL:: asset('assets/images/logo-light.png')}}" alt="" height="20">
                        </span>
                    </a>
                </div>
                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile waves-effect waves-light">
                            <i class="fe-menu"></i>
                        </button>
                    </li>
                    <li>
                        <!-- Mobile menu toggle (Horizontal Layout)-->
                        <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">

            <div class="h-100" data-simplebar>

                <!-- User box -->
                <div class="user-box text-center">
                    <img src="{{URL::asset('assets/images/users/user-1.jpg')}}" alt="user-img" title="Mat Helme"
                        class="rounded-circle avatar-md">
                    <div class="dropdown">
                        <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                            data-bs-toggle="dropdown">Geneva Kennedy</a>
                        <div class="dropdown-menu user-pro-dropdown">

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-user me-1"></i>
                                <span>My Account</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-settings me-1"></i>
                                <span>Settings</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-lock me-1"></i>
                                <span>Lock Screen</span>
                            </a>

                            <!-- item-->
                            {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-log-out me-1"></i>
                                <span>Logout</span>
                            </a> --}}
                            <form method="POST" action="{{ route('logout') }}" class="inline mx-3">
                                @csrf

                                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 ml-2">
                                    {{ __('Log Out') }}
                                </button>
                            </form>

                        </div>
                    </div>
                    <p class="text-muted">Admin Head</p>
                </div>

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <ul id="side-menu">
                        <li class="menu-title">Navigation</li>
                        <li>
                            <a href="#sidebarDashboards" data-bs-toggle="collapse">
                                <i data-feather="airplay"></i>
                                <!-- <span class="badge bg-success rounded-pill float-end">4</span> -->
                                <span> Dashboards </span>
                            </a>
                            <div class="collapse" id="sidebarDashboards">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('dashboard') }}">Dashboard</a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#sidebarCrm" data-bs-toggle="collapse">
                                <i data-feather="shopping-cart"></i>
                                <span> Orders</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarCrm">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{route('all.orders')}}">All Orders</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="{{ route('my.wallet')}}" class="dropdown-item notify-item">
                                <i class="fa-solid fa-wallet"></i>
                                <span>My Wallet</span>
                            </a>
                        </li>
                        <li>

                            <a href="{{ route('my.profile')}}" class="dropdown-item notify-item">
                                <i class="fe-user"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('email-templates.index')}}" class="dropdown-item notify-item">
                                <i class="fa-solid fa-envelope-open-text"></i>
                                <span>Email Templates</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('invoice-templates.index')}}" class="dropdown-item notify-item">
                                <i class="fa-solid fa-file-invoice"></i>
                                <span>Invoice Templates</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('packinglist-templates.index')}}" class="dropdown-item notify-item">
                                <i class="fa-sharp fa-solid fa-list-ul"></i>
                                <span>Packing List Templates</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('payment.history')}}" class="dropdown-item notify-item">
                                <i class="fa-solid fa-money-check-dollar"></i>
                                <span>Payment History</span>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                                <i data-feather="shopping-cart"></i>
                                <span> Ecommerce </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarEcommerce">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="Companies.html">Companies</a>
                                    </li>
                                    <li>
                                        <a href="All-Lists.html">All-Lists</a>
                                    </li>

                                    <li>
                                        <a href="All-Orders.html">All-Orders</a>
                                    </li>
                                    <li>
                                        <a href="Orders.html">Orders</a>
                                    </li>

                                </ul>
                            </div>
                        </li> --}}
                        {{-- <li>
                            <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                                <i data-feather="shopping-cart"></i>
                                <span> Products </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarEcommerce">
                                <ul class="nav-second-level">

                                    <li>
                                        <a href="ProductList">All-Lists</a>
                                    </li>

                                    <li>
                                        <a href="AddProduct">Add Products</a>
                                    </li>
                                    <li>
                                        <a href="UpdateProduct">Update Products</a>
                                    </li>

                                </ul>
                            </div>
                        </li> --}}                        
                        <!-- <li>
                            <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                                <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                <span> Upload Bol Sheets </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarEcommerce">
                                <ul class="nav-second-level">

                                    <li>
                                        <a href="{{'uploadBolSheet'}}">See All</a>
                                    </li>
                                </ul>
                            </div>
                        </li> -->
                        <!-- <li>
                            <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                                <i data-feather="shopping-cart"></i>
                                <span> All Bol Sheets</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarEcommerce">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{route('allBolSheet')}}">See All</a>
                                    </li>
                                </ul>
                            </div>
                        </li> -->
                        <li>
                            <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                                <i class="fa-solid fa-hand-holding-dollar"></i>
                                <span> Transaction Report</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarEcommerce">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('account.report') }}">See All</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#sidebarCrm" data-bs-toggle="collapse">
                                <i class="fa-solid fa-file-invoice"></i>
                                <span> Invoice</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarCrm">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('invoice') }}">Create Invoice</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                                <i class="fa-solid fa-download"></i>
                                <span> Download Label </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarEcommerce">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{route('download.label')}}">Download Label</a>
                                    </li>
                                </ul>
                            </div>
                        </li>






                        <!-- <li>
                            <a href="#sidebarContacts" data-bs-toggle="collapse">
                                <i data-feather="book"></i>
                                <span> Contacts </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarContacts">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="contacts-list.html">Members List</a>
                                    </li>
                                    <li>
                                        <a href="contacts-profile.html">Profile</a>
                                    </li>
                                </ul>
                            </div>
                        </li> -->







                    <!--
                                            <li class="menu-title mt-2">Components</li> -->








                    <!--
                                        <li>
                                            <a href="#sidebarTables" data-bs-toggle="collapse">
                                                <i data-feather="grid"></i>
                                                <span> Tables </span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <div class="collapse" id="sidebarTables">
                                                <ul class="nav-second-level">

                                                    <li>
                                                        <a href="tables-responsive - Copy.html">Responsive Tables</a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </li> -->






                    </ul>

                </div>
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

            </div>
        <!-- Left Sidebar End -->
    </div>
