@extends('layouts.app')
@section('title', 'Pending Fetched | Unikoop')
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
                            <!-- <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                                <li class="breadcrumb-item active">Responsive Table</li>
                                            </ol>
                                        </div> -->
                            <?php
                            //$this->load->view($theme_path.'dhl/assets/sidebar');
                            ?>
                            <h4 class="page-title" style="color: blue">Pending Fetched</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <?php
                //$this->load->view($theme_path.'dhl/assets/sidebar');
                ?>
                <div class="col-md-12 card middlecontainer">
                    {{-- <h3> All Orders </h3> --}}
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

                                if ($smg != '') {
                                    echo '<div id="reg_ok" style="color:red;">' . $smg . '</div>';
                                }

                                ?>
                                <div class="d-flex mt-3 m-3">
                                    <div class="col-md-5 ">
                                        <select class="form-control" id="shipping_service_type"
                                            style="width: 80%; display: inline">
                                            <option value="">--Select--</option>
                                            <option value="dhl">DHL</option>
                                            <option value="dpd">DPD</option>
                                            <option value="dhl_today">DHL Today</option>
                                        </select>
                                        <button class="btn btn-primary " id="apply-btn"
                                            style="padding: 9px 15px; background-color: #fff; border-color: #fff; color: #004a9b;">
                                            Apply
                                        </button>
                                    </div>
                                    <div class="col-md-6 ">
                                        <button class="btn btn-block btn-primary text-end" id="next-btn"
                                            style="padding: 9px 15px; float: right;">
                                            Next
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">

                                                <div class="responsive-table-plugin">

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
                                                        <form name="all_data" action="{{ url('/bol/fetch/select/next') }}"
                                                            id="all_data" method="post">
                                                            {{-- <input type="hidden" name="all_checked" value=""/> --}}
                                                            <input type="hidden" name="bol_rec_id"
                                                                value="{{ $id }}" />

                                                            {{ csrf_field() }}

                                                            <input type="hidden" name="site"
                                                                value="<?php echo $bol_rec[0]->site; ?>" />
                                                            {{-- <div class="table-responsive"> --}}
                                                            <table id="tech-companies-1 " class="table table-striped mb-5">
                                                                <thead>
                                                                    <tr>

                                                                        <th>Id</th>
                                                                        <th>Product</th>
                                                                        <th>BestelNummer</th>
                                                                        <th>Postcode</th>
                                                                        <th>Voomaam</th>
                                                                        <th>Archternaam</th>
                                                                        <th>BestelDatum</th>
                                                                        <th>Orders</th>
                                                                        <th>Choose</th>
                                                                        <th>
                                                                            <div class="">
                                                                                {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
                                                                                <!-- select all boxes -->
                                                                                {{-- <input type="checkbox" name="select-all" id="select-all" /> --}}
                                                                                <input type="checkbox" id="checking"
                                                                                    onclick="check_all('click1');"
                                                                                    value="Get" />
                                                                            </div>
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <?php
                                                                if (!empty($rows)) {
                                                                    print_r($rows);
                                                                } else {
                                                                    echo '<tr>';
                                                                    echo '<td height="30" colspan="11"> No Record Found! </td>';
                                                                    echo '</tr>';
                                                                }
                                                                ?>
                                                                {{-- <tbody class="">
                                                                <tr>
                                                                    <!-- <th>GOOG <span class="co-name">Google Inc.</span></th> -->
                                                                    <td>62499</td>
                                                                    <td class='has-details'>
                                                                        EAN
                                                                        <span class="details">
                                                                        <p>    <b>EAN</b>:2345698765<br>
                                                                        <b>Prijs</b>:24.95</p>
                                                                        <b>Product</b>Homee Molton hoeslaken flanel<br> stretch wit 160/180*200/220+35cm<br> hygioene matrasbeschermer 210g.m</p>
                                                                        </span>
                                                                    </td>
                                                                    <td>6526484</td>
                                                                    <td>9620</td>
                                                                    <td>maaikee</td>
                                                                    <td>schepens</td>
                                                                    <td>November 4,22022, 9:43 am </td>
                                                                    <td>1</td>
                                                                    <td><form action="/action_page.php">
                                                                        <label for="cars"></label>
                                                                        <select name="cars" id="cars">
                                                                        <option value="opel">--Select--</option>
                                                                        <option value="DHL">DHL</option>
                                                                        <option value="DPD">DPD</option>
                                                                        <option value="DHL Today">DHL Today</option>
                                                                        </select>
                                                                        <!-- <input type="submit" value="Submit"> -->
                                                                    </form></td>
                                                                    <td>
                                                                        <div class="form-check">
                                                                            <input type="checkbox" class="form-check-input" id="customCheck2">
                                                                            <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                </tbody> --}}
                                                            </table>
                                                            {{-- </div> <!-- end table-responsive --> --}}
                                                        </form>
                                                    </div> <!-- end .table-rep-plugin-->
                                                </div> <!-- end .responsive-table-plugin-->
                                            </div>
                                        </div> <!-- end card -->
                                    </div> <!-- end col -->
                                </div>
                                <!-- end row -->

                            </div> <!-- container -->
                        </div> <!-- content -->

                    </div>
                    <!-- ============================================================== -->
                    <!-- End Page content -->
                    <!-- ============================================================== -->
                @endsection
                @section('js')

                    <script>
                        $(document).ready(function() {
                            $("#apply-btn").click(function() {
                                var type = $('#shipping_service_type').val();
                                if (type) {
                                    var products = [];
                                    var ids = [];
                                    $.each($("input[name='click1']:checked"), function() {
                                        var id = $(this).attr("id");
                                        $(this).prop('checked', false);
                                        $('#select_' + id + ' option[value=' + type + ']').prop('selected', true);
                                        // ids.push($(this).attr("id"));
                                        // products.push($(this).val());
                                    });
                                    $('#checking').prop('checked', false);
                                    $('#checkings').prop('checked', false);
                                } else {
                                    $.each($("input[name='click1']:checked"), function() {
                                        var id = $(this).attr("id");
                                        $('#select_' + id + ' option:contains("--Select--")').prop('selected',
                                        true);
                                        $('#' + id).prop('checked', false);
                                    });
                                    $('#checking').prop('checked', false);
                                    $('#checkings').prop('checked', false);
                                }
                            });

                            $("#next-btn").click(function(e) {
                                var status = false;
                                $("select option:selected").each(function() {
                                    var val = $(this).val();
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
                            $.each($("input[name='click1']:checked"), function() {
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

                    <script>
                        // Listen for click on toggle checkbox
                        $('#select-all').click(function(event) {
                            if (this.checked) {
                                // Iterate each checkbox
                                $(':checkbox').each(function() {
                                    this.checked = true;
                                });
                            } else {
                                $(':checkbox').each(function() {
                                    this.checked = false;
                                });
                            }
                        });
                    </script>

                @endsection
