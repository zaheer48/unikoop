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
                                                {{--<li class="active" style="display: contents;">--}}
                                                {{--<a href="#profile" data-toggle="tab">Profile</a>--}}
                                                {{--</li>--}}
                                                {{--<li style="display: contents;">--}}
                                                {{--<a href="#business" data-toggle="tab">Business Info</a>--}}
                                                {{--</li>--}}
                                                {{--<li style="display: contents;">--}}
                                                    {{--<a href="#recharged" data-toggle="tab">Wallet History</a>--}}
                                                {{--</li>--}}
                                                {{--<li style="display: contents;">--}}
                                                    {{--<a href="#payment" data-toggle="tab">Payment History</a>--}}
                                                {{--</li>--}}
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
                                                {{--<div id="profile" class="">--}}
                                                {{--<div class="row" style="padding: 30px;">--}}
                                                {{--<div class="col-md-12">--}}
                                                {{--<p>Account Status: <strong>--}}
                                                {{--<mark>{{ ($user->is_active) ? 'Active' : 'De-active' }}</mark>--}}
                                                {{--</strong></p>--}}
                                                {{--<p>Username: <strong>{{ $user->username }}</strong></p>--}}
                                                {{--<p>E-Mail: <strong>{{ $user->email }}</strong></p>--}}
                                                {{--<p>Password: <strong>{{ $user->password_hint }}</strong></p>--}}
                                                {{--<p>Contact Info: <strong>{{ $user->contact_info }}</strong></p>--}}
                                                {{--<p>Country: <strong>{{ $user->country }}</strong></p>--}}
                                                {{--<p>Credit Limit: <strong>&euro;{{ number_format($user->credit_limit,2) }}</strong></p>--}}
                                                {{--<p>Bol Client ID (NL): <strong>{{ $user->bol_client_id }}</strong></p>--}}
                                                {{--<p>Bol Client Secret (NL): <strong>{{ $user->bol_client_secret }}</strong></p>--}}
                                                {{--<p>Bol Client ID (BE): <strong>{{ $user->bol_be_client_id }}</strong></p>--}}
                                                {{--<p>Bol Client Secret (BE): <strong>{{ $user->bol_be_client_secret }}</strong></p>--}}
                                                {{--<p>Logistiek: <strong>{{ $user->logistiek }} {{ $user->dpd_logistiek }}</strong></p>--}}
                                                {{--<p>Price Per DHL Label: <strong>&euro;{{ number_format($user->price_per_label,2) }}</strong></p>--}}
                                                {{--<p>Price Per DPD Label: <strong>&euro;{{ number_format($user->price_per_label_dpd,2) }}</strong></p>--}}
                                                {{--<p>Added On: <strong>{{ $user->created_at->toFormattedDateString() }}</strong></p>--}}
                                                {{--<p>Created By: <strong>{{ $user->create_by }}</strong></p>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div id="business" class="tab-pane fade">--}}
                                                {{--<div class="row" style="padding: 30px;">--}}
                                                {{--<div class="col-md-12">--}}
                                                {{--@if ($business)--}}
                                                {{--<p>House No: <strong>{{ $business->h_b_number }}</strong></p>--}}
                                                {{--<p>Street: <strong>{{ $business->street }}</strong></p>--}}
                                                {{--<p>City Town: <strong>{{ $business->city_town }}</strong></p>--}}
                                                {{--<p>County: <strong>{{ $business->county }}</strong></p>--}}
                                                {{--<p>Country: <strong>{{ $business->country }}</strong></p>--}}
                                                {{--<p>Postcode: <strong>{{ $business->postcode }}</strong></p>--}}
                                                {{--<p>Phone Number: <strong>{{ $business->phonenumber }}</strong></p>--}}
                                                {{--<p>Work Phone: <strong>{{ $business->workphone }}</strong></p>--}}
                                                {{--<p>Mobile Phone: <strong>{{ $business->mobilephone }}</strong></p>--}}
                                                {{--<p>Admin E-mail: <strong>{{ $business->email_admin }}</strong></p>--}}
                                                {{--<p>Sales E-mail: <strong>{{ $business->email_sales }}</strong></p>--}}
                                                {{--@else--}}
                                                {{--<p>No record found.</p>--}}
                                                {{--@endif--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div id="recharged" class="tab-pane fade">--}}
                                                    {{--<div class="row" style="padding: 30px;">--}}
                                                        {{--<div class="col-md-12">--}}
                                                            {{--<table class="table table-hover table-bordered" id="recharged_table">--}}
                                                                {{--<thead>--}}
                                                                {{--<tr>--}}
                                                                    {{--<th height="30">Payment ID</th>--}}
                                                                    {{--<th height="30">Amount</th>--}}
                                                                    {{--<th height="30">Method</th>--}}
                                                                    {{--<th height="30">Description</th>--}}
                                                                    {{--<th height="30">Paid at</th>--}}
                                                                    {{--<th height="30">Status</th>--}}
                                                                    {{--<th height="30">PDF</th>--}}
                                                                {{--</tr>--}}
                                                                {{--</thead>--}}
                                                                {{--<tbody>--}}
                                                                {{--@foreach($transactions->where('type','Wallet') as $transaction)--}}
                                                                    {{--@php--}}
                                                                        {{--$summary = json_decode($transaction->summary)--}}
                                                                    {{--@endphp--}}
                                                                    {{--<tr>--}}
                                                                        {{--<td height="30">{{ ($summary->payment_id ?? '') }}</td>--}}
                                                                        {{--<td height="30">{{ ($summary->currency ?? '') }} {{ $transaction->amount }}</td>--}}
                                                                        {{--<td height="30">{{ ($summary->payment_method ?? '') }}</td>--}}
                                                                        {{--<td height="30">{{ $transaction->description }}</td>--}}
                                                                        {{--<td height="30">{{ ($summary->paid_at ?? '') }}</td>--}}
                                                                        {{--<td height="30">--}}
                                                                            {{--@php--}}
                                                                                {{--switch ($transaction->transaction_status) {--}}
                                                                                    {{--case 0:--}}
                                                                                    {{--echo 'N/A';--}}
                                                                                    {{--break;--}}
                                                                                    {{--case 1:--}}
                                                                                    {{--echo 'Approved';--}}
                                                                                    {{--break;--}}
                                                                                    {{--case 2:--}}
                                                                                    {{--echo 'Rejected';--}}
                                                                                    {{--break;--}}
                                                                                {{--}--}}
                                                                            {{--@endphp--}}
                                                                        {{--</td>--}}
                                                                        {{--<td height="30">--}}
                                                                            {{--<a href="{{ url('/wallet-invoice',$transaction->id) }}"--}}
                                                                            {{--class="btn btn-sm btn-primary">--}}
                                                                                {{--<i class="fa fa-file-pdf-o"></i>&nbsp; PDF--}}
                                                                            {{--</a>--}}
                                                                        {{--</td>--}}
                                                                    {{--</tr>--}}
                                                                {{--@endforeach--}}
                                                                {{--</tbody>--}}
                                                            {{--</table>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div id="payment" class="tab-pane fade">--}}
                                                    {{--<div class="row" style="padding: 30px;">--}}
                                                        {{--<div class="col-md-12">--}}
                                                            {{--<table class="table table-hover table-bordered" id="payment_table">--}}
                                                                {{--<thead>--}}
                                                                {{--<tr>--}}
                                                                    {{--<th height="30">ID</th>--}}
                                                                    {{--<th height="30">Amount</th>--}}
                                                                    {{--<th height="30">Description</th>--}}
                                                                    {{--<th height="30">Status</th>--}}
                                                                    {{--<th height="30">Date</th>--}}
                                                                    {{--<th height="30">PDF</th>--}}
                                                                {{--</tr>--}}
                                                                {{--</thead>--}}
                                                                {{--<tbody>--}}
                                                                {{--@foreach($transactions->where('type','Label') as $transaction)--}}
                                                                    {{--<tr>--}}
                                                                        {{--<td height="30">{{ $transaction->id }}</td>--}}
                                                                        {{--<td height="30">--}}
                                                                            {{--&euro;{{ number_format($transaction->amount,2) }}</td>--}}
                                                                        {{--<td height="30">{{ $transaction->description }}</td>--}}
                                                                        {{--<td height="30">Completed</td>--}}
                                                                        {{--<td height="30">{{ $transaction->created_at }}</td>--}}
                                                                        {{--<td height="30">--}}
                                                                            {{--<a href="{{ url('/payment-invoice',$transaction->id) }}"--}}
                                                                            {{--class="btn btn-sm btn-primary">--}}
                                                                                {{--<i class="fa fa-file-pdf-o"></i>&nbsp; PDF--}}
                                                                            {{--</a>--}}
                                                                        {{--</td>--}}
                                                                    {{--</tr>--}}
                                                                {{--@endforeach--}}
                                                                {{--@foreach($transactions->where('type','Custom Label') as $transaction)--}}
                                                                    {{--<tr>--}}
                                                                        {{--<td height="30">{{ $transaction->id }}</td>--}}
                                                                        {{--<td height="30">--}}
                                                                            {{--&euro;{{ number_format($transaction->amount,2) }}</td>--}}
                                                                        {{--<td height="30">{{ $transaction->description }}</td>--}}
                                                                        {{--<td height="30">Completed</td>--}}
                                                                        {{--<td height="30">{{ $transaction->created_at }}</td>--}}
                                                                        {{--<td height="30">--}}
                                                                            {{--<a href="{{ url('/custom-payment-invoice',$transaction->id) }}"--}}
                                                                            {{--class="btn btn-sm btn-primary">--}}
                                                                                {{--<i class="fa fa-file-pdf-o"></i>&nbsp; PDF--}}
                                                                            {{--</a>--}}
                                                                        {{--</td>--}}
                                                                    {{--</tr>--}}
                                                                {{--@endforeach--}}
                                                                {{--</tbody>--}}
                                                            {{--</table>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
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
                                                                                          {{-- <li class="page-item">
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
                                                                                            <a class="page-link " href="javascript: void(0);" aria-label="Next">

                                                                                                <span aria-hidden="true">»</span>
                                                                                                <span class="visually-hidden">Next</span>
                                                                                            </a>
                                                                                          </li> --}}
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


                                                {{--<div id="custom" class="tab-pane fade">--}}
                                                    {{--<div class="row" style="padding: 30px;">--}}
                                                        {{--<div class="col-md-12">--}}
                                                            {{--<table class="table table-hover table-bordered" id="custom_table">--}}
                                                                {{--<thead>--}}
                                                                {{--<tr>--}}
                                                                    {{--<th height="30">EAN</th>--}}
                                                                    {{--<th height="30">BestelNummer</th>--}}
                                                                    {{--<th height="30">Voornaam</th>--}}
                                                                    {{--<th height="30">Achternaam</th>--}}
                                                                    {{--<th height="30">Logistiek</th>--}}
                                                                    {{--<th height="30">TrackerCode--}}
                                                                    {{--<th height="30">Prijis</th>--}}
                                                                    {{--<th height="30">PDF</th>--}}
                                                                {{--</tr>--}}
                                                                {{--</thead>--}}
                                                                {{--<tbody>--}}
                                                                {{--@php--}}
                                                                    {{--$orders = \App\CustomOrder::where('user_id',Auth::id())->where('logistics', '!=', null)->get();--}}
                                                                {{--@endphp--}}
                                                                {{--@foreach($orders as $label)--}}
                                                                    {{--<tr>--}}
                                                                        {{--<td>{{ $label->ean }}</td>--}}
                                                                        {{--<td>{{ $label->bestel_nummer }}</td>--}}
                                                                        {{--<td>{{ $label->first_name }}</td>--}}
                                                                        {{--<td>{{ $label->last_name }}</td>--}}
                                                                        {{--<td>{{ $label->logistics }}</td>--}}
                                                                        {{--<td>{{ $label->trackerCode }}</td>--}}
                                                                        {{--<td>--}}
                                                                            {{--@if($label->price_charged)--}}
                                                                            {{--&euro;{{ number_format($label->price_charged,2) }}--}}
                                                                            {{--@else--}}
                                                                                {{-----}}
                                                                            {{--@endif--}}
                                                                        {{--</td>--}}
                                                                        {{--<td><a href="{{ asset('pdf_files/'.$label->lable_pdf) }}"--}}
                                                                            {{--class="btn btn-sm btn-primary">--}}
                                                                                {{--<i class="fa fa-file-pdf-o"></i> PDF--}}
                                                                            {{--</a></td>--}}
                                                                    {{--</tr>--}}
                                                                {{--@endforeach--}}
                                                                {{--</tbody>--}}
                                                            {{--</table>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}

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



      <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
{{--
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
                                    <h4 class="page-title" style="color: blue">All Orders</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <ul class="nav nav-tabs gap-5" style="display: flex; margin-bottom: 1px;">

                                            <li class="active" style="display: contents;">
                                                <a href="#labels" data-toggle="tab">All Labels</a>
                                            </li>
                                            <li style="display: contents;">
                                                <a href="#dhl" data-toggle="tab">DHL Labels</a>
                                            </li>
                                            <li style="display: contents;">
                                                <a href="#dpd" data-toggle="tab">DPD Labels</a>
                                            </li>

                                        </ul>
                                        <div class="row mt-2">
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-5 col-md-6" >
                                                <div class="input-group" >
                                                    <div class="form-outline" style="margin-left: 70px;">
                                                      <input type="search" id="label_table" placeholder="Search" class="form-control" />

                                                    </div>
                                                    <button type="button" class="btn btn-primary" style="float: right;">
                                                      <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="responsive-table-plugin" id="labels">

                                            <div class="table-rep-plugin">
                                                <!-- <div class="row">
                                                    <div class="col-md-7"></div>
                                                    <div class="col-md-4">
                                                        <select class="form-select">
                                                            <option selected>Open this select menu</option>
                                                            <option value="1">DHL</option>
                                                            <option value="2">DPD</option>
                                                            <option value="3">DHL Today</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-1">
                                                        <button type="button" class="btn btn-primary width-xs waves-effect waves-light">Next</button>

                                                    </div>
                                                   </div> -->
                                                <div class="table-responsive" id="labels" class="tab-pane in active">
                                                    <table id="tech-companies-1 " class="table table-striped mb-5"  id="label_table">
                                                        <thead>
                                                        <tr>

                                                            <th>Id</th>
                                                            <th >Product</th>
                                                            <th >BestelNummer</th>
                                                            <th >Postcode</th>
                                                            <th >Voomaam</th>
                                                            <th >Archternaam</th>
                                                            <th>TrackerCode
                                                            <th>Prijis</th>
                                                            <th>BestelDatum</th>



                                                        </tr>
                                                        </thead>
                                                        <tbody class="">
                                                            @foreach($labels as $label)
                                                        <tr>
                                                            <!-- <th>GOOG <span class="co-name">Google Inc.</span></th> -->
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
                                                    </table >
                                                </div> <!-- end table-responsive -->
                                            {{-- </div> <!-- end .table-rep-plugin--> --}}
                                        </div> <!-- end .responsive-table-plugin-->
                                        <div class="responsive-table-plugin tab-pane fade" id="dhl" >

                                            <div class="table-rep-plugin">

                                                    <table id="tech-companies-1 " class="table table-striped mb-5" id="dhl_table" >
                                                        <thead>
                                                        <tr>

                                                            <th >Id</th>
                                                            <th >Product</th>
                                                            <th >BestelNummer</th>
                                                            <th >Postcode</th>
                                                            <th >Voornaam</th>
                                                            <th >Achternaam</th>
                                                            <th >TrackerCode</th>
                                                            <th >Prijis</th>
                                                            <th >BestelDatum</th>



                                                        </tr>
                                                        </thead>
                                                        <tbody class="">
                                                            @foreach($labels->where('logistiek','DHL') as $label)
                                                        <tr>
                                                            <!-- <th>GOOG <span class="co-name">Google Inc.</span></th> -->
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
                                                   </table >
                                                {{-- </div> <!-- end table-responsive --> --}}
                                            {{-- </div> <!-- end .table-rep-plugin--> --}}
                                        </div> <!-- end .responsive-table-plugin-->
                                        <div class="responsive-table-plugin tab-pane fade" id="dpd" >

                                            <div class="table-rep-plugin">

                                                    <table id="dpd_table" class="table table-striped mb-5">
                                                        <thead>
                                                        <tr>

                                                            <th>Id</th>
                                                            <th>Product</th>
                                                            <th>BestelNummer</th>
                                                            <th>Postcode</th>
                                                            <th>Voornaam</th>
                                                            <th>Achternaam</th>
                                                            <th>TrackerCode
                                                            <th>Prijis</th>
                                                            <th>BestelDatum</th>



                                                        </tr>
                                                        </thead>
                                                        <tbody class="">
                                                            @foreach($labels->where('logistiek','DPD') as $label)
                                                        <tr>
                                                            <!-- <th>GOOG <span class="co-name">Google Inc.</span></th> -->
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
                                                   </table >
                                                {{-- </div> <!-- end table-responsive --> --}}
                                            {{-- </div> <!-- end .table-rep-plugin--> --}}
                                        </div> <!-- end .responsive-table-plugin-->
                                    </div>
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->
                </div> <!-- content -->

          {{-- </div> --}} --}}
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

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
