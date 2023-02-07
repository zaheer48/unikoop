@extends('layouts.app')
@section('title', 'Orders List | Unikoop')
@section('content')

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">


            <!-- Start Content-->
            <div class="container-fluid">
                <!-- start page title -->
                {{-- <div class="row">
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
                            <h4 class="page-title">Add Product</h4>
                        </div>
                    </div>
                </div> --}}
                <!-- end page title -->


                <script language="javascript">
                    function dellcheck() {
                        if (confirm("Are you sure want to delete record")) {
                            return true;
                        } else {
                            return false;
                        }
                    }

                    function blockcheck() {
                        if (confirm("Are you sure want to change block status")) {
                            return true;
                        } else {
                            return false;
                        }
                    }

                    function confirm_fetch() {
                        if (confirm("Are you sure want to fetch records from bol.com?")) {
                            return true;
                        } else {
                            return false;
                        }
                    }

                    function get_all_checked() {
                        var checkboxes = document.getElementsByName('click1');
                        var selected = "";
                        for (var i = 0; i < checkboxes.length; i++) {
                            if (checkboxes[i].checked) {
                                if (selected == "") {
                                    selected += checkboxes[i].value;
                                } else {
                                    selected += "," + checkboxes[i].value;
                                }


                            }
                        }
                        // alert(selected);
                        document.all_data.all_checked.value = selected;
                        document.all_data.submit();

                    }

                    function check_all(click1) {

                        var checkboxes = document.getElementsByName('click1');
                        var selected = [];


                        if (document.getElementById('checking').checked) {
                            for (var i = 0; i < checkboxes.length; i++) {
                                checkboxes[i].checked = true;
                                document.getElementById('checkings').checked = true;
                            }
                        } else {
                            for (var i = 0; i < checkboxes.length; i++) {
                                checkboxes[i].checked = false;
                                document.getElementById('checkings').checked = false;
                            }
                        }


                    }

                    function check_all2(click1) {

                        var checkboxes = document.getElementsByName('click1');
                        var selected = [];

                        if (document.getElementById('checkings').checked) {
                            for (var i = 0; i < checkboxes.length; i++) {
                                checkboxes[i].checked = true;
                                document.getElementById('checking').checked = true;
                            }
                        } else {
                            for (var i = 0; i < checkboxes.length; i++) {
                                checkboxes[i].checked = false;
                                document.getElementById('checking').checked = false;
                            }
                        }

                    }
                </script>



                <div class="col-xl-12">

                    @if (session()->has('warning'))
                        <div class="alert alert-dismissable alert-warning">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>Warning</strong>
                            {!! session()->get('warning') !!}
                        </div>
                    @endif
                    <div class="panel panel-default">
                        <form action="{{ url('/bol/fetch', $bol) }}" id="fetch-form" method="POST"
                            onsubmit="return loginLoadingBtn(this)">
                            @csrf
                            @php
                                $dhl_price = $dhl->is_active == 'Unikoop' ? $dhl->dhl_unikoop_price : $dhl->dhl_discount_price;
                                $dpd_price = $dpd->is_active == 'Unikoop' ? $dpd->dpd_unikoop_price : $dpd->dpd_discount_price;
                                $dhl_total_price = Auth::user()->price_per_label ? Auth::user()->price_per_label : $dhl_price;
                                $dpd_total_price = Auth::user()->price_per_label ? Auth::user()->price_per_label_dpd : $dpd_price;
                            @endphp
                            <input type="hidden" name="dhl_price" value="{{ $dhl_total_price }}">
                            <input type="hidden" name="dpd_price" value="{{ $dpd_total_price }}">
                            @foreach ($request_arr as $key => $value)
                                @if ($value == 'dhl')
                                    <input type="hidden" value="{{ $key }}" name="dhl_orders[]">
                                @elseif ($value == 'dpd')
                                    <input type="hidden" value="{{ $key }}" name="dpd_orders[]">
                                @elseif ($value == 'dhl_today')
                                    <input type="hidden" value="{{ $key }}" name="dhl_today_orders[]">
                                @endif
                            @endforeach

                            <div class="card">

                                <div class="card-body">
                            <h3 class="page-title mb-3 mt-0" style="color: blue">Order List</h3>

                                   

                                    <div
                                        style="background-color:  var(--ct-form-check-input-checked-bg-color) ; padding: 20px; margin-bottom: 6px; color: #fff;">
                                        <style>
                                            .span-txt-nl {
                                                margin-right: 40px;
                                                float: right;
                                            }
                                        </style>
                                        <div>
                                            <span class="span-txt-nl">Pakket NL</span>
                                            <span class="span-txt-nl">Pakket BE</span>
                                            <span class="span-txt-nl">Brievenbus NL</span>
                                        </div>
                                        <br>
                                    </div>
                                    <p>
                                        DPD ondervindt momenteel technische problemen, kies een andere vervoerder of
                                        probeer het later nog een keer.
                                    </p>

                                    {{-- <div class="table-responsive"> --}}
                                        <table class="table table-borderless table-nowrap table-hover table-centered m-0">

                                            <thead class="table-light">
                                                <tr>
                                                    <th>Service</th>
                                                    <th>Size/Delivery</th>
                                                    <th>Original Price</th>
                                                    <th>Unikoop Price</th>
                                                    <th>Discounted Price</th>
                                                    <th>Summary</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><img src="{{ asset('dpd_logo.svg') }}" alt=""
                                                            style="width: 134px;"></td>
                                                    <td>
                                                        <span>
                                                            <i class="fa fa-arrows-alt"></i> {{ $dpd->box_size }}
                                                        </span><br>
                                                        <span>
                                                            <i class="fa fa-truck"></i> Levering: {{ $dpd->delivery }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>&euro;{{ $dpd->dpd_original_price }}*</span>
                                                    </td>
                                                    <td>
                                                        <span>&euro;{{ $dpd->dpd_unikoop_price }}*</span>
                                                    </td>
                                                    <td style="font-size: 17px;">
                                                        &euro;{{ $dpd_total_price }}*
                                                    </td>
                                                    <td>
                                                        <span
                                                            style="background-color: transparent; color: #023567; font-weight: 500; padding: 13px 15px; font-size: 14px;">
                                                            Selected: {{ $counts['dpd'] ?? 0 }} /
                                                            Total:
                                                            &euro;{{ ($counts['dpd'] ?? 0) * (int) $dpd_total_price }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img src="{{ asset('dhl_logo.gif') }}" alt=""></td>
                                                    <td>
                                                        <span>
                                                            <i class="fa fa-arrows-alt"></i> {{ $dhl->box_size }}
                                                        </span><br>
                                                        <span>
                                                            <i class="fa fa-truck"></i> Levering: {{ $dhl->delivery }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>&euro;{{ $dhl->dhl_original_price }}*</span>
                                                    </td>
                                                    <td>
                                                        <span>&euro;{{ $dhl->dhl_unikoop_price }}*</span>
                                                    </td>
                                                    <td style="font-size: 17px;">
                                                        &euro;{{ $dhl_total_price }}*
                                                    </td>
                                                    <td>
                                                        <span
                                                            style="background-color: transparent; color: #023567; font-weight: 500; padding: 13px 15px; font-size: 14px;">
                                                            Selected: {{ $counts['dhl'] ?? 0 }} /
                                                            Total: &euro;{{ ($counts['dhl'] ?? 0) * $dhl_total_price }}

                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img src="{{ asset('dhl-today.png') }}" alt=""></td>
                                                    <td>
                                                        <span>
                                                            <i class="fa fa-arrows-alt"></i> {{ $dhl->box_size }}
                                                        </span><br>
                                                        <span>
                                                            <i class="fa fa-truck"></i> Levering: {{ $dhl->delivery }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>&euro;{{ $dhl->dhl_original_price }}*</span>
                                                    </td>
                                                    <td>
                                                        <span>&euro;{{ $dhl->dhl_unikoop_price }}*</span>
                                                    </td>
                                                    <td style="font-size: 17px;">
                                                        &euro;{{ $dhl_total_price }}*
                                                    </td>
                                                    <td>
                                                        <span
                                                            style="background-color: transparent; color: #023567; font-weight: 500; padding: 13px 15px; font-size: 14px;">
                                                            Selected: {{ $counts['dhl_today'] ?? 0 }} /
                                                            Total:
                                                            &euro;{{ ($counts['dhl_today'] ?? 0) * $dhl_total_price }}

                                                        </span>
                                                    </td>
                                                </tr>




                                            </tbody>
                                        </table>


                                    {{-- </div> <!-- end .table-responsive--> --}}
                                    <div class="card">
                                        <hr>
                                        <p>DPD: * {{ $dpd->dpd_discount_note }}</p>
                                        <p>DHL: * {{ $dhl->dhl_discount_note }}</p>
                                        <p>
                                            De Zegelkosten verrekenen we automatisch met je oporengst.
                                        </p>
                                        <div class="form-group my-2" id="loading-btn">
                                            @if (isset($counts['dhl']) || isset($counts['dpd']) || isset($counts['dhl_today']))
                                                <button type="submit" class="btn btn-primary btn-lg mr-3">
                                                    Fetch
                                                </button>
                                            @else
                                                <a href="#" class="btn btn-primary btn-lg mr-3">
                                                    Nothing Selected
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div> <!-- end card-->
                </div> <!-- end col -->

                {{-- <div class="container mt-10">
                    <div class="row">
                        <div class="col-md-12 card middlecontainer">
                            <h3>
                                Order List
                            </h3><br>
                            <div class="row">
                                <div class="col-md-12">
                                    @if (session()->has('warning'))
                                        <div class="alert alert-dismissable alert-warning">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <strong>Warning</strong>
                                            {!! session()->get('warning') !!}
                                        </div>
                                    @endif
                                    <div class="panel panel-default">
                                        <form action="{{ url('/bol/fetch', $bol) }}" id="fetch-form" method="POST"
                                            onsubmit="return loginLoadingBtn(this)">
                                            @csrf
                                            @php
                                                $dhl_price = $dhl->is_active == 'Unikoop' ? $dhl->dhl_unikoop_price : $dhl->dhl_discount_price;
                                                $dpd_price = $dpd->is_active == 'Unikoop' ? $dpd->dpd_unikoop_price : $dpd->dpd_discount_price;
                                                $dhl_total_price = Auth::user()->price_per_label ? Auth::user()->price_per_label : $dhl_price;
                                                $dpd_total_price = Auth::user()->price_per_label ? Auth::user()->price_per_label_dpd : $dpd_price;
                                            @endphp
                                            <input type="hidden" name="dhl_price" value="{{ $dhl_total_price }}">
                                            <input type="hidden" name="dpd_price" value="{{ $dpd_total_price }}">
                                            @foreach ($request_arr as $key => $value)
                                                @if ($value == 'dhl')
                                                    <input type="hidden" value="{{ $key }}" name="dhl_orders[]">
                                                @elseif ($value == 'dpd')
                                                    <input type="hidden" value="{{ $key }}" name="dpd_orders[]">
                                                @elseif ($value == 'dhl_today')
                                                    <input type="hidden" value="{{ $key }}"
                                                        name="dhl_today_orders[]">
                                                @endif
                                            @endforeach
                                            <div class="panel-body">

                                                <div
                                                    style="background-color:  var(--ct-form-check-input-checked-bg-color) ; padding: 20px; margin-bottom: 6px; color: #fff;">
                                                    <style>
                                                        .span-txt-nl {
                                                            margin-right: 40px;
                                                            float: right;
                                                        }
                                                    </style>
                                                    <div>
                                                        <span class="span-txt-nl">Pakket NL</span>
                                                        <span class="span-txt-nl">Pakket BE</span>
                                                        <span class="span-txt-nl">Brievenbus NL</span>
                                                    </div>
                                                    <br>
                                                </div>
                                                <p>
                                                    DPD ondervindt momenteel technische problemen, kies een andere
                                                    vervoerder of
                                                    probeer het later nog een keer.
                                                </p>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <style>
                                                            table>tbody>tr>td>span {
                                                                font-weight: 500;
                                                                font-size: 17px;
                                                            }

                                                            .table>tbody>tr>td {
                                                                vertical-align: middle !important;
                                                                padding: 15px !important;
                                                                text-align: center !important;
                                                            }

                                                            .table>tbody>tr>th {
                                                                text-align: center !important;
                                                                vertical-align: middle !important;
                                                                padding: 15px !important;
                                                            }
                                                        </style>


                                                        <table class="table text-center">
                                                            <tbody>
                                                                <tr>
                                                                    <th>Service</th>
                                                                    <th>Size/Delivery</th>
                                                                    <th>Original Price</th>
                                                                    <th>Unikoop Price</th>
                                                                    <th>Discounted Price</th>
                                                                    <th>Summary</th>
                                                                </tr>
                                                                <tr>
                                                                    <td><img src="{{ asset('dpd_logo.svg') }}"
                                                                            alt="" style="width: 134px;"></td>
                                                                    <td>
                                                                        <span>
                                                                            <i class="fa fa-arrows-alt"></i>
                                                                            {{ $dpd->box_size }}
                                                                        </span><br>
                                                                        <span>
                                                                            <i class="fa fa-truck"></i> Levering:
                                                                            {{ $dpd->delivery }}
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        <span>&euro;{{ $dpd->dpd_original_price }}*</span>
                                                                    </td>
                                                                    <td>
                                                                        <span>&euro;{{ $dpd->dpd_unikoop_price }}*</span>
                                                                    </td>
                                                                    <td style="font-size: 17px;">
                                                                        &euro;{{ $dpd_total_price }}*
                                                                    </td>
                                                                    <td>
                                                                        <span
                                                                            style="background-color: transparent; color: #023567; font-weight: 500; padding: 13px 15px; font-size: 14px;">
                                                                            Selected: {{ $counts['dpd'] ?? 0 }} /
                                                                            Total:
                                                                            &euro;{{ ($counts['dpd'] ?? 0) * (int) $dpd_total_price }}
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><img src="{{ asset('dhl_logo.gif') }}"
                                                                            alt=""></td>
                                                                    <td>
                                                                        <span>
                                                                            <i class="fa fa-arrows-alt"></i>
                                                                            {{ $dhl->box_size }}
                                                                        </span><br>
                                                                        <span>
                                                                            <i class="fa fa-truck"></i> Levering:
                                                                            {{ $dhl->delivery }}
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        <span>&euro;{{ $dhl->dhl_original_price }}*</span>
                                                                    </td>
                                                                    <td>
                                                                        <span>&euro;{{ $dhl->dhl_unikoop_price }}*</span>
                                                                    </td>
                                                                    <td style="font-size: 17px;">
                                                                        &euro;{{ $dhl_total_price }}*
                                                                    </td>
                                                                    <td>
                                                                        <span
                                                                            style="background-color: transparent; color: #023567; font-weight: 500; padding: 13px 15px; font-size: 14px;">
                                                                            Selected: {{ $counts['dhl'] ?? 0 }} /
                                                                            Total:
                                                                            &euro;{{ ($counts['dhl'] ?? 0) * $dhl_total_price }}

                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><img src="{{ asset('dhl-today.png') }}"
                                                                            alt=""></td>
                                                                    <td>
                                                                        <span>
                                                                            <i class="fa fa-arrows-alt"></i>
                                                                            {{ $dhl->box_size }}
                                                                        </span><br>
                                                                        <span>
                                                                            <i class="fa fa-truck"></i> Levering:
                                                                            {{ $dhl->delivery }}
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        <span>&euro;{{ $dhl->dhl_original_price }}*</span>
                                                                    </td>
                                                                    <td>
                                                                        <span>&euro;{{ $dhl->dhl_unikoop_price }}*</span>
                                                                    </td>
                                                                    <td style="font-size: 17px;">
                                                                        &euro;{{ $dhl_total_price }}*
                                                                    </td>
                                                                    <td>
                                                                        <span
                                                                            style="background-color: transparent; color: #023567; font-weight: 500; padding: 13px 15px; font-size: 14px;">
                                                                            Selected: {{ $counts['dhl_today'] ?? 0 }} /
                                                                            Total:
                                                                            &euro;{{ ($counts['dhl_today'] ?? 0) * $dhl_total_price }}

                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>


                                                        <hr>
                                                        <p>DPD: * {{ $dpd->dpd_discount_note }}</p>
                                                        <p>DHL: * {{ $dhl->dhl_discount_note }}</p>
                                                        <p>
                                                            De Zegelkosten verrekenen we automatisch met je oporengst.
                                                        </p>
                                                        <div class="form-group my-2" id="loading-btn">
                                                            @if (isset($counts['dhl']) || isset($counts['dpd']) || isset($counts['dhl_today']))
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-lg mr-3">
                                                                    Fetch
                                                                </button>
                                                            @else
                                                                <a href="#" class="btn btn-primary btn-lg mr-3">
                                                                    Nothing Selected
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

@endsection
@section('js')

    <script type="text/javascript">
        function loginLoadingBtn() {
            document.getElementById('loading-btn').innerHTML =
                '<button class="btn btn-primary btn-lg disabled">Fetching <svg xmlns="http://www.w3.org/2000/svg" width="24" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin ml-2"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg></button>';
            return true;

        }
    </script>

@endsection
