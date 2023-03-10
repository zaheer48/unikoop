@extends('layouts/app')

@section('title','Track Order | Unikoop')
@section('sidebar')
    @include('layouts.user_side_bar')
@endsection
@section('content')
<style>
    .footer{
        left:0px;
    }
      .navbar-custom .button-menu-mobile{
        display: none;
    }
        .logo-box .logo {
        width: 65px;
        line-height: 70px;
    }
</style>
    <!-- Start Page Content here -->
    <div class="content-page m-auto mt-5">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="my-3">
                            <!-- <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                    <li class="breadcrumb-item active">Responsive Table</li>
                                </ol>
                            </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row justify-content-end">
                    <div class="col-10 mt-5">
                        <div class="card">


                            <div class="card-body mb-4">
                                <h4 class="page-title" style="color: blue";>Track Order</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-sm-3 ">
                                        <h5 class="text-end">Order Id</h5>
                                    </div>
                                    <div class="col-12 col-sm-9 col-md-7 col-lg-7">
                                        <form name="register" method="post" id="check_invoice_form2" action="" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="input-group text-start gap-2">
                                                <div class="form-outline ">
                                                    <input type="text" name="bestelnummer" id="bestelnummer" class="form-control" placeholder="bestelnummer" required="" value="">
                                                </div>
                                                <div class="d-flex gap-3">
                                                    <select class="col-lg col-md col-sm-2 form-select" name="platform" id="">
                                                        <option value="DHL">DHL</option>
                                                        <option value="DPD">DPD</option>
                                                    </select>
                                                </div>
                                                <input type="button" id="check_invoice" value="Fetch Info" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                <div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <br>
                                        <div class="row" id="tracker_result" style="display: none">
                                            <div class="col-md-12">
                                                <div id="new_template" style="height: auto !important; border: 1px solid #ccc; border-radius: 4px; padding: 20px;">


                                                    <div class="c-tracking-result--section">
                                                        <div class="c-tracking-result--code" id="tracker_code" aria-hidden="true">Tracking Code: </div>
                                                        <div class="">This shipment is handled by: <strong id="handled_by"></strong></div>
                                                        <!-- <a href="/pk-en/home/tracking/contact/express.html" target="_blank" rel="noopener noreferrer" class="c-tracking-result--contact-link c-tracking-result--info-link link link-external has-icon" style="display: none !important;">
                                                            Customer Service
                                                        </a>
                                                        <button class="base-button base-button--white c-tracking-result--print circle-button icon-print js--tracking-result--print">
                                                            <span>Download</span>
                                                        </button> -->
                                                    </div>
                                                    <div class="c-tracking-result--section">
                                                        <div class="c-tracking-result--status l-grid">
                                                            <h2 role="text" tabindex="-1" class="tracking-result-status" id="tracking-result-status" dir="ltr">
                                                            </h2>
                                                            <div class="c-tracking-result--status-copy-date" id="tracking-result-time" dir="ltr">
                                                            </div>
                                                        </div>
                                                        <!-- <span class="sr-only">Origin</span>
                                                        <p class="c-tracking-result--origin bold">
                                                            Service Area: QUEBEC SERVICE AREA, QC - CANADA
                                                        </p> -->
                                                        <!-- <div class="c-tracking-results--status-bar-container l-grid  ">
                                                            <div class="c-tracking-results-status-bar l-grid--w-33pc-s bar-1 bar-pretransit ">
                                                            </div>
                                                            <div class="c-tracking-results-status-bar l-grid--w-33pc-s bar-2 bar-pretransit ">
                                                            </div>
                                                            <div class="c-tracking-results-status-bar l-grid--w-33pc-s bar-3 bar-pretransit ">
                                                            </div>
                                                            <div class="c-tracking-result--status-icon pretransit">
                                                                <span class="c-tracking-result--icon has-icon c-tracking-result--status-shipment-pretransit"></span>
                                                            </div>
                                                        </div>
                                                        <span class="sr-only">Destination</span>
                                                        <p class="c-tracking-result--destination bold">
                                                            Service Area: BOGOTA - COLOMBIA
                                                        </p> -->
                                                    </div>
                                                    <!-- <div class="c-tracking-result--section">
                                                        <div class="c-tracking-result--checkpoints-dropdown js--accordion--type-default c-accordion--item js--accordion--item l-grid l-grid--left-s is-open is-latest">
                                                            <div class=" c-accordion--hitbox js--accordion--hitbox c-component-accordion--header js--accordion--header js--dropdown-checkpoints-open l-grid ">
                                                                <button id="c-tracking-result--checkpoints-dropdown-button" class="c-tracking-result--moredetails-dropdown-button js--dropdown-moredetails-toggle-btn js-tracking-result--checkpoints--toggle-btn has-icon" aria-expanded="true" aria-controls="c-tracking-result--checkpoints-dropdown-menu">
                                                                <h3 class="c-tracking-result--detail-label level4">All Shipment Updates</h3>
                                                                </button>
                                                            </div>
                                                            <div class="c-tracking-result--checkpoints-dropdown-menu c-accordion--content js--accordion--content" id="c-tracking-result--checkpoints-dropdown-menu" aria-labelledby="c-tracking-result--checkpoints-dropdown-button" style="display: block; height: auto; overflow: hidden;">
                                                                <div class="c-tracking-result--checkpoint l-grid  l-grid--left-s">
                                                                    <div class="c-tracking-result--checkpoint-info l-grid  ">
                                                                        <ul class="">
                                                                            <li class="l-grid">
                                                                                <div class="c-tracking-result--checkpoint-left  first">
                                                                                    <span class="c-tracking-result--checkpoint-weekday  ">Wednesday</span>
                                                                                    <span class="c-tracking-result--checkpoint-date level4" dir="ltr">November, 09 2022</span>
                                                                                    <span class="c-tracking-result--checkpoint-time" dir="ltr">
                                                                                    16:13 Local time
                                                                                    </span>
                                                                                </div>
                                                                                <div class="c-tracking-result--checkpoint-right has-icon">
                                                                                    <div class="c-tracking-result--checkpoint-dashedline"></div>
                                                                                    <div class="c-tracking-result--checkpoint-mobile">
                                                                                        <span class="c-tracking-result--checkpoint-weekday  ">Wednesday</span>
                                                                                        <span class="c-tracking-result--checkpoint-date level4">November, 09 2022</span>
                                                                                        <span class="c-tracking-result--checkpoint-time">
                                                                                        16:13 Local time
                                                                                        </span>
                                                                                    </div>
                                                                                    <p class="bold  first" dir="ltr">Shipment information received</p>
                                                                                    <span class="c-tracking-result--checkpoint--more">
                                                                                            Service Area: QUEBEC SERVICE AREA, QC - CANADA
                                                                                    </span>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

             
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    <!-- End Page content -->

@endsection

@section('js')

<script>
    $('#template_id').on('change', function () {
        var body = $("#template_id").val();
        $("#content").val(body);
        $('#new_template').html(body);
    });
</script>
<script src="{{url('/dhl')}}/js/jquery.multifile.js"></script>
<script>
    $("#check_invoice").click(function () {
        $('#tracker_result').css('display', 'none');
        var formdata = $("#check_invoice_form2").serialize();
        $.ajax({
            type: "post",
            url: "{{ route('check.order') }}",
            data: formdata,
            dataType: "json",
            success: function (data) {
                if (data.message == 'redirect') {
                    window.location.replace(data.route);
                } else if (data.message == 'failure'){
                    $('#tracker_result').css('display', 'block');
                    $('#tracker_code').html('Tracking Code: ' + data.tracking_code);
                    $('#handled_by').html('');
                    $('#tracking-result-time').html('');
                    $('#tracking-result-status').html(data.response);
                } else if (data.message == 'success' && data.response == "No parcel found for the given key(s)"){
                    $('#tracker_result').css('display', 'block');
                    $('#tracker_code').html('Tracking Code: ' + data.tracking_code);
                    $('#tracking-result-status').html(data.response);
                } else if (data.message == 'success'){
                    var api_response = JSON.parse(data.response);
                    $('#tracker_result').css('display', 'block');
                    api_response.forEach(obj => {
                        $('#tracker_code').html('Tracking Code: ' + obj.barcode);
                        if(data.handled_by = 'DHL'){
                            $('#handled_by').html('DHL Express');
                        }
                        obj.events.forEach(eventsObj => {
                            if(eventsObj.category == 'DATA_RECEIVED' && eventsObj.status == 'DATA_RECEIVED_WITH_PREFIX_LABEL'){
                                $('#tracking-result-status').html('Shipment information received');
                                var separate_timestamp = eventsObj.timestamp.split('T');
                                var separate_time = separate_timestamp[1].split('Z');
                                $('#tracking-result-time').html(separate_timestamp[0] + ' '+ separate_time[0]);
                            }
                        });
                    });
                }
            }
        });
    });

</script>

<script type="text/javascript">
    jQuery(function () {
        $('#file_input').multifile();
    });
</script>

@endsection
