@extends('layouts.app')
@section('title', 'Download Label | Unikoop')
@section('sidebar')
@include('bol::layouts.side_bar')
@endsection
@section('content')
<style type="text/css">
        span.img-text {
            text-decoration: none;
            outline: none;
            transition: all 0.4s ease;
            -webkit-transition: all 0.4s ease;
            -moz-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            cursor: pointer;
            width: 100%;
            font-size: 23px;
            display: block;
            text-transform: capitalize;
        }

        span.img-text:hover {
            color: #2caae1;
        }

        .input-container {
            display: -ms-flexbox;
            /* IE10 */
            display: flex;
            width: 100%;
            height: 39px;
            margin-bottom: 8px;

        }

        @media screen and (min-device-width: 320px) and (max-device-width: 450px) {
            .mb {
                padding: 0px !important;
            }
        span.img-text:hover {
            color: #2caae1;
        }

        .input-container {
            display: -ms-flexbox;
            /* IE10 */
            display: flex;
            width: 100%;
            height: 39px;
            margin-bottom: 8px;

        }

        @media screen and (min-device-width: 320px) and (max-device-width: 450px) {
            .mb {
                padding: 0px !important;
            }

        .mb_view {
            width: 92% !important;
        }



        .mb_size {
            height: 25px !important;
        }

</style>


<!-- Start Page Content here -->
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">

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
                                </form>--}}
                            </div>
                            <h4 class="page-title" style="color: blue">Download Label</h4>
                        </div>
                        <h4 class="page-title" style="color: blue">Download Label</h4>
                    </div>
                </div>
                <!-- end page title -->
                @if (Session::has('alert-danger'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('alert-danger') }}.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif



                    <div class="panel panel-info">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 style="padding: 20px; padding-bottom: 10px;">
                                    Download Label
                                </h3>
                                <hr style="margin-top: 0px;">
                                <form name="register" method="post" id="invoice_form" action="/bol/label_download"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row text-center">
                                        <div class="col-md-2 col-md-offset-1">
                                            <div class="form-group" style="text-align: center; margin-top: 8px;">
                                                <label for="">Search Order</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-container form-group">
                                                <input type="text" name="bestelnummer" id="bestelnummer"
                                                    class="form-control mb_view" placeholder="bestelnummer">
                                                <input type="submit" value="Search Order" class="btn btn-success"
                                                    id="" style="margin-left: 5px; padding: 0px 15px;">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br><br>
                        <div class="row text-center">
                            <div class="col-md-12" style="margin-left:-7%">
                                @if ($pdf_file ?? '')
                                    @if ($exists)
                                        <a href="{{ asset('pdf_files/' . $pdf_file) }}" download="{{ $pdf_file }}">
                                            <button class="btn btn-sm btn-primary mb_size" type="button"
                                                style="height: 47px;">
                                                <i class="fa fa-file-pdf-o"></i>&nbsp; Download PDF File
                                            </button>
                                        </a>
                                        @if ($bol_trackerCode)
                                            <span class="alert alert-success mb">
                                                Tracking Code is: &nbsp;{{ $bol_trackerCode }}
                                            </span>
                                        @endif
                                    @else
                                        <span class="alert alert-danger mb">No PDF found.</span>
                                        @if ($bol_trackerCode)
                                            <span class="alert alert-success mb">
                                                Tracking Code is:&nbsp; {{ $bol_trackerCode }}
                                            </span>
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div>
                        </div>
                        <div style="text-align:center; margin-bottom:20px">

                            @if (Session::has('check_invoice_message'))
                                @if (Session::get('check_invoice_message') == '1-2')
                                    <a href="/bol/create_invoice_2/{{ Session::get('check_invoice_orderID') }}">Invoice</a>
                                    - <a href="/bol/create_packing_list/{{ Session::get('check_invoice_orderID') }}">Packing
                                        List</a>
                                @endif
                                @if (Session::get('check_invoice_message') == '1')
                                    <a href="/bol/create_invoice_2/{{ Session::get('check_invoice_orderID') }}">Invoice</a>
                                @endif
                                @if (Session::get('check_invoice_message') == '2')
                                    <a href="/bol/create_packing_list/{{ Session::get('check_invoice_orderID') }}">Packing
                                        List</a>
                                @endif
                            @endif

                            @if (Session::has('print_invoice_message'))
                                @if (Session::get('print_invoice_message') == '1')
                                    <a href="/bol/create_invoice_3/{{ Session::get('print_invoice_orderID') }}">Invoice</a>
                                @endif
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-md-10 bg-blue middlecontainer"></div>
            </div>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ Session::get('alert-danger') }}.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                 @endif

    <div class="col-md-12 card middlecontainer">
        <div class="panel panel-info">
            <div class="row">
                <div class="col-md-12">
                    <h3  style="padding: 20px; padding-bottom: 10px;">
                        Download Label
                    </h3>
                    <hr style="margin-top: 0px;">
                    <form name="register" method="post" id="invoice_form" action="/bol/label_download"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row text-center">
                            <div class="col-md-2 col-md-offset-1">
                                <div class="form-group" style="text-align: center; margin-top: 8px;">
                                    <label for="">Search Order</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-container form-group">
                                    <input type="text" name="bestelnummer" id="bestelnummer" class="form-control mb_view" placeholder="bestelnummer">
                                    <input type="submit" value="Search Order" class="btn btn-success" id="" style="margin-left: 5px; padding: 0px 15px;">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end page title -->
            @if (Session::has('alert-danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('alert-danger') }}.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="col-md-12 card middlecontainer">
                <div class="panel panel-info">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 style="padding: 20px; padding-bottom: 10px;">
                                Download Label
                            </h3>
                            <hr style="margin-top: 0px;">
                            <form name="register" method="post" id="invoice_form" action="/bol/label_download"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row text-center">
                                    <div class="col-md-2 col-md-offset-1">
                                        <div class="form-group" style="text-align: center; margin-top: 8px;">
                                            <label for="">Search Order</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-container form-group">
                                            <input type="text" name="bestelnummer" id="bestelnummer"
                                                class="form-control mb_view" placeholder="bestelnummer">
                                            <input type="submit" value="Search Order" class="btn btn-success" id=""
                                                style="margin-left: 5px; padding: 0px 15px;">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br><br>
                    <div class="row text-center">
                        <div class="col-md-12" style="margin-left:-7%">
                            @if($pdf_file ?? '')
                            @if($exists)
                            <a href="{{ asset('pdf_files/'.$pdf_file) }}" download="{{$pdf_file}}">
                                <button class="btn btn-sm btn-primary mb_size" type="button" style="height: 47px;">
                                    <i class="fa fa-file-pdf-o"></i>&nbsp; Download PDF File
                                </button>
                            </a>
                            @if($bol_trackerCode)
                            <span class="alert alert-success mb">
                                Tracking Code is: &nbsp;{{$bol_trackerCode}}
                            </span>
                            @endif
                            @else
                            <span class="alert alert-danger mb">No PDF found.</span>
                            @if($bol_trackerCode)
                            <span class="alert alert-success mb">
                                Tracking Code is:&nbsp; {{$bol_trackerCode}}
                            </span>
                            @endif
                            @endif
                            @endif
                        </div>
                    </div>
                    <div>
                    </div>
                    <div style="text-align:center; margin-bottom:20px">

                        @if(Session::has('check_invoice_message'))
                        @if(Session::get('check_invoice_message') == '1-2')
                        <a href="/bol/create_invoice_2/{{Session::get('check_invoice_orderID')}}">Invoice</a> - <a
                            href="/bol/create_packing_list/{{Session::get('check_invoice_orderID')}}">Packing
                            List</a>
                        @endif
                        @if(Session::get('check_invoice_message') == '1')
                        <a href="/bol/create_invoice_2/{{Session::get('check_invoice_orderID')}}">Invoice</a>
                        @endif
                        @if(Session::get('check_invoice_message') == '2')
                        <a href="/bol/create_packing_list/{{Session::get('check_invoice_orderID')}}">Packing List</a>
                        @endif
                        @endif

                        @if(Session::has('print_invoice_message'))
                        @if(Session::get('print_invoice_message') == '1')
                        <a href="/bol/create_invoice_3/{{Session::get('print_invoice_orderID')}}">Invoice</a>
                        @endif
                        @endif

                    </div>
                </div>
            </div>
            <div class="col-md-10 bg-blue middlecontainer"></div>
        </div>
    </div>
</div>
@endsection
@section('js')
@endsection
<script>
$("#check_invoice").click(function() {

    $('#bestelnummer2').val($('#bestelnummer').val());

    $('#email2').val($('#email').val());

    $('#check_invoice_form').submit();

});
</script>

@endsection
