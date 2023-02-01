@extends('layouts.service_dashboard')
@section('title','All Orders | Unikoop')
@section('content')

    <!-- order list start -->
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
    <div class="container mt-10">
        <div class="row">

            <?php
            //$this->load->view($theme_path.'dhl/assets/sidebar');
            ?>
            <div class="col-md-10 bg-blue middlecontainer">
                <h3> All Orders </h3>
                <div class="row">
                    <div class="col-md-12">
                        @if (session()->has('warning'))
                            <div class="alert alert-dismissable alert-warning">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>
                                    {!! session()->get('warning') !!}
                                </strong>
                            </div>
                        @endif
                        <div id="admin_page_form">
                            <?php
                            $smg = '';

                            if ($smg != "") {
                                echo('<div id="reg_ok" style="color:red;">' . $smg . '</div>');
                            }

                            ?>

                            <div id="show_file_table" class=" panel-body panel-body-multi">
                                <div class="row">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-5">
                                        <select class="form-control" id="shipping_service_type"
                                                style="width: 80%; display: inline">
                                            <option value="">--Select--</option>
                                            <option value="dhl">DHL</option>
                                            <option value="dpd">DPD</option>
                                            <option value="dhl_today">DHL Today</option>
                                        </select>
                                        <button class="btn btn-primary" id="apply-btn"
                                                style="padding: 9px 15px; background-color: #fff; border-color: #fff; color: #004a9b;">
                                            Apply
                                        </button>
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn btn-block btn-primary" id="next-btn"
                                                style="padding: 9px 15px; float: right;">
                                            Next
                                        </button>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form name="all_data" action="{{ url('/bol/fetch/select/next') }}"
                                              id="all_data" method="post">
                                            {{--<input type="hidden" name="all_checked" value=""/>--}}
                                            <input type="hidden" name="bol_rec_id" value="{{ $id }}"/>

                                            {{ csrf_field() }}

                                            <input type="hidden" name="site"
                                                   value="<?php echo $bol_rec[0]->site; ?>"/>

                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="table-responsive">

                                                            <table class="table table-hover table-bordered">
                                                                <thead>
                                                                <tr>
                                                                    <th height="30"> id</th>
                                                                    <th height="30"> Product</th>
                                                                    <th height="30"> BestelNummer</th>
                                                                    <th height="30"> Postcode</th>
                                                                    <th height="30"> Voornaam</th>
                                                                    <th height="30"> Achternaam</th>
                                                                    <th height="30"> BestelDatum</th>
                                                                    <th height="30"> Orders</th>
                                                                    <th height="30"> Choose</th>
                                                                    <th height="30">
                                                                        <input type="checkbox" id="checking"
                                                                               onclick="check_all('click1');"
                                                                               value="Get"/>
                                                                    </th>
                                                                </tr>
                                                                </thead>
                                                                <?php
                                                                if (!empty($rows)) {

                                                                    print_r($rows);

                                                                } else {
                                                                    echo('<tr>');
                                                                    echo('<td height="30" colspan="11"> No Record Found! </td>');
                                                                    echo('</tr>');
                                                                }
                                                                ?>
                                                            </table>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </form>
                                        <div class="text-right">
                                            Check All <input type="checkbox" id="checkings"
                                                             onclick="check_all2('click1');" value="Get"/>
                                            <button class="btn btn-primary" id="next-btn"
                                                    style="padding: 9px 15px;">
                                                Next
                                            </button>
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
    <!-- order list end -->

@endsection
@section('js')

    <script>

        $(document).ready(function () {
            $("#apply-btn").click(function () {
                var type = $('#shipping_service_type').val();
                if (type) {
                    var products = [];
                    var ids = [];
                    $.each($("input[name='click1']:checked"), function () {
                        var id = $(this).attr("id");
                        $(this).prop('checked', false);
                        $('#select_' + id + ' option[value=' + type + ']').prop('selected', true);
                        // ids.push($(this).attr("id"));
                        // products.push($(this).val());
                    });
                    $('#checking').prop('checked', false);
                    $('#checkings').prop('checked', false);
                } else {
                    $.each($("input[name='click1']:checked"), function () {
                        var id = $(this).attr("id");
                        $('#select_' + id + ' option:contains("--Select--")').prop('selected', true);
                        $('#' + id).prop('checked', false);
                    });
                    $('#checking').prop('checked', false);
                    $('#checkings').prop('checked', false);
                }
            });

            $("#next-btn").click(function (e) {
                var status = false;
                $( "select option:selected" ).each(function() {
                    var val = $( this ).val();
                    if (val) {
                        status = true;
                        return false;
                    }
                });

                if (status == false) {
                    alert('Please choose any service');
                    e.preventDefault();
                    e.stopPropagation();
                    return false;
                } else {
                    $('form#all_data').submit();
                }
            });

        });

        function unCheckCheckAll() {
            $('#checking').prop('checked', false);

        }

        function shippingServiceType() {
            var type = $('#shipping_service_type').val();
            // var len = $('.order_products:checked').length;
            // alert('Selected products are: ' + len);
            var products = [];
            var ids = [];
            $.each($("input[name='click1']:checked"), function () {
                products.push($(this).val());
                ids.push($(this).attr("id"));
            });
            // alert("Products are: " + products.join(", "));
            // alert("Ids are: " + ids.join(", "));
            for (var i = 0; i <= ids.length; i++) {
                $('#select_' + ids[i] + ' option[value=' + type + ']').prop('selected', true);
            }
        }

        function checkSelect(id) {
            var option = $('#select_' + id).val();
            if (option != '') {
                $('#select_' + id).css('border', '1px solid #777');
                $('#' + id).prop('checked', 'checked');
            } else {
                $('#' + id).prop('checked', false);
            }
        }

        function checkCheckbox(id) {
            if ($('#shipping_service_type').val()) {
                var type = $('#shipping_service_type').val();
                if ($("#" + id).is(":checked")) {
                    $('#select_' + id + ' option[value=' + type + ']').attr('selected', 'selected');
                } else {
                    $('#select_' + id + ' option:contains("--Select--")').prop('selected', true);
                }
            } else {
                $('#select_' + id).css('border', '1px solid #e02b27');
            }

        }

    </script>

@endsection
