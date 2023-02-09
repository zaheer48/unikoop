<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link href=" {{ URL::asset('assets/images/favicon.ico') }}" rel="shortcut icon"  />
    <!-- Responsive Table css -->
    <link href="{{URL::asset('assets/libs/admin-resources/rwd-table/rwd-table.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- third party css -->
    <link href="{{URL::asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->

    <!-- Font Awsome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href=" {{ URL::asset('assets/libs/images/favicon.ico') }}" rel="stylesheet"  />
    <!-- Plugins css -->
    <link href=" {{ URL::asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href=" {{ URL::asset('assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />

    <!-- Bootstrap css -->
    <link href=" {{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href=" {{ URL::asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- icons -->
    <link href=" {{ URL::asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Head js -->
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
      .btn-btn-logout:hover{
        border-color:#ffffff00;
    }
    </style>
    @yield('css')
    </head>
    <!-- body start -->
    <body data-layout-mode="default" data-theme="light" data-layout-width="fluid" data-topbar-color="dark" data-menu-position="fixed" data-leftbar-color="light" data-leftbar-size='default' data-sidebar-user='false'>
        <!-- Begin page -->
        <div id="wrapper">
            <!-- Topbar Start -->
            @include('layouts.header')
            @yield('header')
            <!-- end Topbar -->
            <!-- Left Sidebar Start  -->
            <!-- @include('layouts.side_bar') -->
            @yield('sidebar')
            <!-- Left Sidebar End -->
        </div>
        <div class="main">
            @yield('content')
        </div>
        @include('layouts.footer')
        @yield('footer')
        <!-- Vendor js -->
        <script src="{{URL::asset('assets/js/vendor.min.js')}}"></script>
        <!-- Responsive Table js -->
        <script src="{{URL::asset('assets/libs/admin-resources/rwd-table/rwd-table.min.js')}}"></script>
        <!-- third party js -->
        <script src="{{URL::asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{URL::asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
        <script src="{{URL::asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{URL::asset('assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>
        <script src="{{URL::asset('assets/libs/jquery-datatables-checkboxes/js/dataTables.checkboxes.min.js')}}"></script>
        <!-- third party js ends -->
        <!-- Plugins js-->
        <script src="{{URL::asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
        <script src="{{URL::asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
        <script src="{{URL::asset('assets/libs/selectize/js/standalone/selectize.min.js')}}"></script>
        <!-- Dashboar 1 init js-->
        <script src="{{URL::asset('assets/js/pages/dashboard-1.init.js')}}"></script>
        <!-- Init js -->
        <script src="{{URL::asset('assets/js/pages/responsive-table.init.js')}}"></script>
        <!-- Datatables init -->
        <script src="{{URL::asset('assets/js/pages/customers.init.js')}}"></script>
        <!-- App js-->
        <script src="{{URL::asset('assets/js/app.min.js')}}"></script>
        @yield('js')
    </body>
</html>
