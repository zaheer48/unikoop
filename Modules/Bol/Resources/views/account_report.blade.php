@extends('layouts.app')
{{-- @extends('layouts.service_dashboard') --}}
@section('title','Transaction Report')
@section('sidebar')
    @include('bol::layouts.side_bar')
@endsection
@section('content')
    <link rel="stylesheet" href="{{URL:: asset('assets/css/datatables.min.css') }}">

    {{-- <link rel="stylesheet" href="<?php echo url('/'); ?>/dhl/css/bootstrap.min.css"> --}}

    <link rel="stylesheet" href="{{URL::asset('dhl/css/bootstrap.min.css')}}">





    <style>

body {
    /* font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; */
    font-size: 14px;
    line-height: 1.42857143;
    color: #333;
    /* background-color: #f7f6f6; */
    background-color: rgba(var(--ct-body-bg-rgb));
}



           .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    color: var(--ct-form-check-input-checked-bg-color);
    border-bottom: var(--ct-form-check-input-checked-bg-color) 3px solid;
}
        a:hover{
            text-decoration: none;
        }
        html{
            font-size:17px;
        }
        .navbar-custom .app-search .app-search-box {
            display: none;
            vertical-align: middle;
            position: relative;
}
        .input-group-text{
            font-size: 17px;
        }
        .dataTables_wrapper {
            overflow-x: scroll !important;
        }

        .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
            z-index: 3;
            color: #fff;
            cursor: default;
            background-color:var(--ct-form-check-input-checked-bg-color);
            border-color:var(--ct-form-check-input-checked-bg-color);
}

        .text_less_more {
            font-weight: 400;
            color: var(--ct-form-check-input-checked-bg-color);;
            cursor: pointer;
            display: block;
            font-size: 12px;
        }
        .pagination>li>a, .pagination>li>span {
            color: var(--ct-form-check-input-checked-bg-color);
        }
        /* .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
            color: #3266cc;
            border-bottom: #3266cc 3px solid;
        } */
        .dataTables_wrapper .dataTables_filter input {
    margin-left: 0.5em;
    background-color: white;
    border-radius: 5px;
    /* outline: none; */
    border: 1px solid gainsboro;
    padding: 5px;
}

        div.dataTables_wrapper div.dataTables_info {
    padding-top: 0.85em;
    display: none;
}
div.dataTables_wrapper div.dataTables_paginate {
    margin: 0;
    white-space: nowrap;
    text-align: right;
    display: none;
}

    </style>

     <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page bg-body">
        <div class="content">


            <!-- Start Content-->
                  <!-- start page title -->
                  <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                {{-- <form class="d-flex align-items-center mb-3">
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
                                </form> --}}
                            </div>
                            <h3 class="page-title" style="color: blue"> Transaction Report</h3>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                    <div class="col-md-12 card middlecontainer">
                        <div class="panel">
                            <div class="row">
                                <div class="col-md-12">
                                    {{-- <h3 style="padding: 14px;">
                                        Transaction Report
                                    </h3> --}}
                                    {{-- <hr style="margin: 0px;"> --}}
                                    <div class="row" style="padding: 20px;">
                                        <div class="col-md-12">
                                            <ul class="nav nav-tabs gap-3" style="display: flex; margin-bottom: 1px;">

                                                <li class="active" style="display: contents;">
                                                    <a href="#labels" data-toggle="tab">All Labels</a>
                                                </li>
                                                <li style="display: contents;">
                                                    <a href="#dhl" data-toggle="tab">DHL Labels</a>
                                                </li>
                                                <li style="display: contents;">
                                                    <a href="#dpd" data-toggle="tab">DPD Labels</a>
                                                </li>
                                                {{--<li style="display: contents;">--}}
                                                    {{--<a href="#custom" data-toggle="tab">Custom Labels</a>--}}
                                                {{--</li>--}}
                                            </ul>
                                            <div class="tab-content">

                                                <div id="labels" class="tab-pane  in active">
                                                    <div class="row" style="padding: 30px;">
                                                        <div class="col-md-12">

                                                            <table class="table table-hover table-bordered texy-danger table-responsive" id="label_table">
                                                                <thead>
                                                                <tr>
                                                                    <th height="30">Id</th>
                                                                    <th height="30">Product</th>
                                                                    <th height="30">BestelNummer</th>
                                                                    <th height="30">Postcode</th>
                                                                    <th height="30">Voornaam</th>
                                                                    <th height="30">Achternaam</th>
                                                                    <th height="30">TrackerCode</th>
                                                                    <th height="30">Prijis</th>
                                                                    <th height="30">BestelDatum</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($labels as $label)
                                                                {{-- @php dd($label->id); @endphp --}}
                                                                    <tr>
                                                                        <td>{{ $label->id }}</td>
                                                                        <td>
                                                                            <span id="all_{{ $label->id }}">{{ substr($label->producttitel,0,10) }}...</span>
                                                                            <span id="text_{{ $label->id }}" class="text_less_more"
                                                                                onclick="showMoreAll('{{ $label->id }}','{{ $label->producttitel }}')">
                                                                        Show More
                                                                    </span>
                                                                        </td>
                                                                        <td>{{ $label->bestelnummer }}</td>
                                                                        <td>{{ $label->postcode_verzending }}</td>
                                                                        <td>{{ $label->voornaam_verzending }}</td>
                                                                        <td>{{ $label->achternaam_verzending }}</td>
                                                                        <td>{{ $label->trackerCode }}</td>
                                                                        <td>
                                                                            @if($label->price_charged)
                                                                            &euro;{{ number_format($label->price_charged,2) }}
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ $label->besteldatum }}</td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="text-end">
                                                                <ul class="pagination pagination-rounded justify-content-end">

                                                                    {{$labels->links()}}



                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="dhl" class="tab-pane fade ">
                                                    <div class="row" style="padding: 30px;">
                                                        <div class="col-md-12">
                                                            <table class="table table-hover table-bordered" id="dhl_table">
                                                                <thead>
                                                                <tr>
                                                                    <th height="30">Id</th>
                                                                    <th height="30">Product</th>
                                                                    <th height="30">BestelNummer</th>
                                                                    <th height="30">Postcode</th>
                                                                    <th height="30">Voornaam</th>
                                                                    <th height="30">Achternaam</th>
                                                                    <th height="30">TrackerCode</th>
                                                                    <th height="30">Prijis</th>
                                                                    <th height="30">BestelDatum</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($labels->where('logistiek','DHL') as $label)
                                                                    <tr>
                                                                        <td>{{ $label->id }}</td>
                                                                        <td>
                                                                            <span id="dhl_{{ $label->id }}">{{ substr($label->producttitel,0,10) }}...</span>
                                                                            <span id="dhl_text_{{ $label->id }}" class="text_less_more"
                                                                                onclick="showMoreDhl('{{ $label->id }}','{{ $label->producttitel }}')">
                                                                        Show More
                                                                    </span>
                                                                        </td>
                                                                        <td>{{ $label->bestelnummer }}</td>
                                                                        <td>{{ $label->postcode_verzending }}</td>
                                                                        <td>{{ $label->voornaam_verzending }}</td>
                                                                        <td>{{ $label->achternaam_verzending }}</td>
                                                                        <td>{{ $label->trackerCode }}</td>
                                                                        <td>
                                                                            @if($label->price_charged)
                                                                            &euro;{{ number_format($label->price_charged,2) }}
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ $label->besteldatum }}</td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="dpd" class="tab-pane fade">
                                                    <div class="row" style="padding: 30px;">
                                                        <div class="col-md-12">
                                                            <table class="table table-hover table-bordered" id="dpd_table">
                                                                <thead>
                                                                <tr>
                                                                    <th height="30">Id</th>
                                                                    <th height="30">Product</th>
                                                                    <th height="30">BestelNummer</th>
                                                                    <th height="30">Postcode</th>
                                                                    <th height="30">Voornaam</th>
                                                                    <th height="30">Achternaam</th>
                                                                    <th height="30">TrackerCode
                                                                    <th height="30">Prijis</th>
                                                                    <th height="30">BestelDatum</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($labels->where('logistiek','DPD') as $label)
                                                                    <tr>
                                                                        <td>{{ $label->id }}</td>
                                                                        <td>
                                                                            <span id="dpd_{{ $label->id }}">{{ substr($label->producttitel,0,10) }}...</span>
                                                                            <span id="dpd_text_{{ $label->id }}" class="text_less_more"
                                                                                onclick="showMoreDpd('{{ $label->id }}','{{ $label->producttitel }}')">
                                                                        Show More
                                                                    </span>
                                                                        </td>
                                                                        <td>{{ $label->bestelnummer }}</td>
                                                                        <td>{{ $label->postcode_verzending }}</td>
                                                                        <td>{{ $label->voornaam_verzending }}</td>
                                                                        <td>{{ $label->achternaam_verzending }}</td>
                                                                        <td>{{ $label->trackerCode }}</td>
                                                                        <td>
                                                                            @if($label->price_charged)
                                                                            &euro;{{ number_format($label->price_charged,2) }}
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ $label->besteldatum }}</td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>




                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>



      

@endsection
@section('js')


<!-- Bootstrap core JavaScript  -->
<script src="{{url('/dhl')}}/js/jquery.js"></script>
<script src="{{url('/dhl')}}/js/bootstrap.min.js"></script>


    <script src="{{URL:: asset('assets/js/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#recharged_table').DataTable({responsive: true});
            $('#payment_table').DataTable({responsive: true});
            $('#label_table').DataTable({responsive: true});
            $('#dhl_table').DataTable({responsive: true});
            $('#dpd_table').DataTable({responsive: true});
            $('#custom_table').DataTable({responsive: true});
        });

        function showMoreAll(id, title) {
            $('#text_' + id).attr('onclick', 'showLessAll("' + id + '","' + title + '")');
            $('#all_' + id).html(title);
            $('#text_' + id).html('Show Less');
        }

        function showLessAll(id, title) {
            $('#text_' + id).attr('onclick', 'showMoreAll("' + id + '","' + title + '")');
            var str = title.substring(0, 10);
            $('#all_' + id).html(str);
            $('#text_' + id).html('Show More');
        }

        function showMoreDhl(id, title) {
            $('#dhl_text_' + id).attr('onclick', 'showLessDhl("' + id + '","' + title + '")');
            $('#dhl_' + id).html(title);
            $('#dhl_text_' + id).html('Show Less');
        }

        function showLessDhl(id, title) {
            $('#dhl_text_' + id).attr('onclick', 'showMoreDhl("' + id + '","' + title + '")');
            var str = title.substring(0, 10);
            $('#dhl_' + id).html(str);
            $('#dhl_text_' + id).html('Show More');
        }

        function showMoreDpd(id, title) {
            $('#dpd_text_' + id).attr('onclick', 'showLessDpd("' + id + '","' + title + '")');
            $('#dpd_' + id).html(title);
            $('#dpd_text_' + id).html('Show Less');
        }

        function showLessDpd(id, title) {
            $('#dpd_text_' + id).attr('onclick', 'showMoreDpd("' + id + '","' + title + '")');
            var str = title.substring(0, 10);
            $('#dpd_' + id).html(str);
            $('#dpd_text_' + id).html('Show More');
        }

    </script>
@endsection
