@extends('layouts/app')
@section('title','Create Invoice | Unikoop')
@section('sidebar')
    @include('bol::layouts.side_bar')
@endsection
@section('content')
    <div class="col-md-10 bg-blue middlecontainer">
        <p class="alert alert-info">
            You can set templates for 
            <!-- <a href="{{ route('invoice-templates.index') }}" style="text-decoration: underline;">Invoice</a>,  -->
            <a href="{{ route('email-templates.index') }}" style="text-decoration: underline;">Email</a>, 
            <a href="{{ route('packinglist-templates.index') }}" style="text-decoration: underline;">Packing List</a> by going to settings tab.
        </p>
        @if(Session::has('success'))
            <p class="alert alert-success">{{ Session::get('success') }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </p>
        @endif
        @if(Session::has('alert-warning'))
            <p class="alert alert-warning">{{ Session::get('alert-warning') }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </p>
        @endif
        @if(Session::has('danger'))
            <p class="alert alert-warning">{{ Session::get('danger') }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </p>
        @endif

        <div class="panel panel-info" style="padding: 20px; padding-bottom: 10px;">
            @if($default ?? '')
            <div class="row">
                <div class="col-md-12">
                    <h3>Create Invoice</h3>
                </div>
            </div>
            <hr style="margin-top: 0px;">
            <div class="row">
                <div class="col-md-3">
                    <label>Order ID</label>
                </div>
                <div class="col-md-4">
                    <div class="input-container">
                        <input type="text" name="bestelnummer" id="bestelnummer" class="form-control" placeholder="bestelnummer" required="" value="">
                        <input type="button" id="check_invoice" value="Fetch Info" class="btn btn-success icon" style="margin-left: 5px;">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form name="register" method="post" id="my_form" action="/bol/invoice_submit2"
                            enctype="multipart/form-data"
                            style="display:none;">
                        @csrf
                        <br>
                        <input type="hidden" value="2577628200" name="o_no" id="o_no">
                        <div class="row">
                            <div class="col-md-3">
                                <label>Email</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input style="margin-bottom: 5px;" type="email" name="email" id="or_email" value="" class="form-control">
                                    @if ($errors->has('email'))
                                        <small class="invalid-feedback" role="alert" style="color: red;">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="mb_margin">CC</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input style="margin-bottom: 5px;" type="text" name="cc" value=""
                                            class="form-control"
                                            placeholder="can enter multiple emails separated by comma">
                                    @if ($errors->has('cc'))
                                        <small class="invalid-feedback" role="alert" style="color: red;">
                                            <strong>{{ $errors->first('cc') }}</strong>
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Subject</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input style="margin-bottom: 5px;" type="text" name="subject" value="" id="subject"
                                            class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="hidden" name="finvoice_input" id="finvoice_input" value="">
                                    <input type="hidden" name="fpackinglist_input" id="fpackinglist_input" value="">
                                    <input type="hidden" name="sinvoice_input" id="sinvoice_input" value="">
                                    <input type="hidden" name="tpackinglist_input" id="tpackinglist_input" value="">
                                    <a style="display:none" href="" id="f_anchor">Invoice</a>
                                    <a style="display:none" href="" id="sf_anchor">Packing List</a>
                                    <a style="display:none" href="" id="second_anchor">Invoice</a>
                                    <a style="display:none" href="" id="third_anchor">Packing List</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label>File(s)</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input id="file_input" type="file" name="files[]" style="margin-bottom: 5px;"
                                            class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" id="s_email" style="padding: 9px;">
                                        Send Email
                                    </button>
                                </div>
                                <input type="hidden" name="content" id="content" value="{{ $default->email_body }}">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="new_template"
                                        style="height: auto !important; border: 1px solid #ccc; border-radius: 4px; padding: 20px;">
                                    {!! $default->email_body !!}
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div style="text-align:center; margin-bottom:20px">
                <form name="register" method="post" id="check_invoice_form2" action="" enctype="multipart/form-data"
                        style="display:none">
                    {{ csrf_field() }}
                    <input type="text" name="bestelnummer" id="bestelnummer2" class="form-control"
                            placeholder="bestelnummer" required="" value="">
                </form>
            </div>
                @else
                <p class="alert alert-danger">Please configure your email template in settings tab area</p>
            @endif
        </div>
        <div class="col-md-10 bg-blue middlecontainer"></div>
    </div>

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
            $data1 = $('#bestelnummer').val();
            $('#bestelnummer2').val($data1);
            var formdata = $("#check_invoice_form2").serialize();
            $.ajax({
                type: "post",
                url: "{{ route('check.invoice2') }}",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.message == 'No record found against this Order ID') {
                        alert('No record found against this Order ID');
                        $('#bestelnummer').val('');
                        $("#my_form").css("display", "none");
                    } else {
                        $("#my_form").css("display", "block");
                        $("#o_no").val(data.o_no);
                        $("#or_email").val(data.email);
                        var subject = data.name + ' ' + 'Invoice BOL bestelnummer' + ' ' + data.o_no;
                        $("#subject").val(subject);

                        if (data.check_invoice_message == '1') {
                            $("#second_anchor").css("display", "block");
                            var check_invoice_orderID = data.check_invoice_orderID;
                            // $("#second_anchor").attr("href", "/bol/create_invoice_2/" + check_invoice_orderID);
                            $("#second_anchor").attr("href", "/download-invoice-pdf/" + check_invoice_orderID);
                            $("#finvoice_input").attr("value", "");
                            $("#fpackinglist_input").attr("value", "");
                            $("#tpackinglist_input").attr("value", "");
                            $("#sinvoice_input").attr("value", "yes");
                        } else {
                            $("#second_anchor").css("display", "none");
                        }
                        if (data.check_invoice_message == '2') {
                            $("#third_anchor").css("display", "block");
                            var check_invoice_orderID = data.check_invoice_orderID;
                            // $("#third_anchor").attr("href", "/bol/create_packing_list/" + check_invoice_orderID);
                            $("#third_anchor").attr("href", "/download-packinglist-pdf/" + check_invoice_orderID);
                            $("#finvoice_input").attr("value", "");
                            $("#fpackinglist_input").attr("value", "");
                            $("#sinvoice_input").attr("value", "");
                            $("#tpackinglist_input").attr("value", "yes");
                        } else {
                            $("#third_anchor").css("display", "none");
                        }
                        if (data.check_invoice_message == '1-2') {
                            $("#f_anchor").css("display", "block");
                            $("#sf_anchor").css("display", "block");
                            var check_invoice_orderID = data.check_invoice_orderID;
                            // $("#f_anchor").attr("href", "/bol/create_invoice_2/" + check_invoice_orderID);
                            $("#f_anchor").attr("href", "/download-invoice-pdf/" + check_invoice_orderID);
                            $("#sf_anchor").attr("href", "/bol/download-packinglist-pdf/" + check_invoice_orderID);
                            $("#tpackinglist_input").attr("value", "");
                            $("#sinvoice_input").attr("value", "");
                            $("#finvoice_input").attr("value", "yes");
                            $("#fpackinglist_input").attr("value", "yes");
                            // $("#sf_anchor").attr("href", "/bol/create_packing_list/" + check_invoice_orderID);
                        } else {
                            $("#f_anchor").css("display", "none");
                            $("#sf_anchor").css("display", "none");
                        }
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