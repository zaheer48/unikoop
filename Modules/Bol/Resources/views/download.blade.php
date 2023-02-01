@extends('layouts.app')
@section('title','Download Label')
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
            display: -ms-flexbox; /* IE10 */
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
        }

    </style>
    <div class="col-md-10 bg-blue middlecontainer">
        @if(Session::has('alert-danger'))
            <p class="alert alert-warning">{{ Session::get('alert-danger') }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
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
            <br><br>
            <div class="row text-center">
                <div class="col-md-12">
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

@endsection
@section('js')

    <script>
        $("#check_invoice").click(function () {

            $('#bestelnummer2').val($('#bestelnummer').val());

            $('#email2').val($('#email').val());

            $('#check_invoice_form').submit();

        });
    </script>

@endsection