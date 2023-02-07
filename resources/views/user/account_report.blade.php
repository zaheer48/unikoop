@extends('layouts.app')
@section('title', 'Transaction Report | Unikoop')
@section('content')
@php
$user = Auth::user();
$business = DB::table('bussiness_address')
    ->where('register_id', $user->id)
    ->first();
$transactions = DB::table('transaction_histories')
    ->where('user_id', $user->id)
    ->get();
$labels = DB::table('bol_rec')
    ->select('*')
    ->join('bol_data', 'bol_data.bol_rec_id', '=', 'bol_rec.id')
    ->where('bol_rec.user_id', $user->id)
    ->get();
@endphp
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
    <style>
        .dataTables_wrapper {
            overflow-x: scroll !important;
        }

        .text_less_more {
            font-weight: 400;
            color: #337ab7;
            cursor: pointer;
            display: block;
            font-size: 12px;
        }

        .nav-tabs>li.active>a,
        .nav-tabs>li.active>a:hover,
        .nav-tabs>li.active>a:focus {
            color: #3266cc;
            border-bottom: #3266cc 3px solid;
        }
    </style>
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
                            <h4 class="page-title" style="color: blue">Transaction Report</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->



                <div class="col-lg-12 col-md-12 card middlecontainer">
                    <div class="panel panel-info">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 style="padding: 14px;">
                                    Transaction Report
                                </h3>
                                <hr style="margin: 0px;">
                                <div class="row" style="padding: 20px;">
                                    <div class="col-md-12">
                                        <ul class="nav nav-tabs" style="display: flex; margin-bottom: 1px;">

                                            <li class="active" style="display: contents;">
                                                <a href="#labels" data-toggle="tab">All Labels</a>
                                            </li>
                                            <li style="display: contents;">
                                                <a href="#dhl" data-toggle="tab">DHL Labels</a>
                                            </li>
                                            <li style="display: contents;">
                                                <a href="#dpd" data-toggle="tab">DPD Labels</a>
                                            </li>
                                            {{-- <li style="display: contents;"> --}}
                                            {{-- <a href="#custom" data-toggle="tab">Custom Labels</a> --}}
                                            {{-- </li> --}}
                                        </ul>
                                        <div class="tab-content">

                                            <div id="labels" class="tab-pane fade in active">
                                                <div class="row" style="padding: 30px;">
                                                    <div class="col-md-12">
                                                        <table class="table table-hover table-bordered" id="label_table">
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
                                                                @foreach ($labels as $label)
                                                                    <tr>
                                                                        <td>{{ $label->id }}</td>
                                                                        <td>
                                                                            <span
                                                                                id="all_{{ $label->id }}">{{ substr($label->producttitel, 0, 10) }}...</span>
                                                                            <span id="text_{{ $label->id }}"
                                                                                class="text_less_more"
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
                                                                            @if ($label->price_charged)
                                                                                &euro;{{ number_format($label->price_charged, 2) }}
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
                                            <div id="dhl" class="tab-pane fade">
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
                                                                @foreach ($labels->where('logistiek', 'DHL') as $label)
                                                                    <tr>
                                                                        <td>{{ $label->id }}</td>
                                                                        <td>
                                                                            <span
                                                                                id="dhl_{{ $label->id }}">{{ substr($label->producttitel, 0, 10) }}...</span>
                                                                            <span id="dhl_text_{{ $label->id }}"
                                                                                class="text_less_more"
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
                                                                            @if ($label->price_charged)
                                                                                &euro;{{ number_format($label->price_charged, 2) }}
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
                                                                @foreach ($labels->where('logistiek', 'DPD') as $label)
                                                                    <tr>
                                                                        <td>{{ $label->id }}</td>
                                                                        <td>
                                                                            <span
                                                                                id="dpd_{{ $label->id }}">{{ substr($label->producttitel, 0, 10) }}...</span>
                                                                            <span id="dpd_text_{{ $label->id }}"
                                                                                class="text_less_more"
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
                                                                            @if ($label->price_charged)
                                                                                &euro;{{ number_format($label->price_charged, 2) }}
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

    <script src="{{ asset('css/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#recharged_table').DataTable({
                responsive: true
            });
            $('#payment_table').DataTable({
                responsive: true
            });
            $('#label_table').DataTable({
                responsive: true
            });
            $('#dhl_table').DataTable({
                responsive: true
            });
            $('#dpd_table').DataTable({
                responsive: true
            });
            $('#custom_table').DataTable({
                responsive: true
            });
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
