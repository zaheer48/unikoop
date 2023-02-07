@extends('layouts.app')
@section('title', 'Order Emails | Unioop')
@section('sidebar')
    @include('bol::layouts.side_bar')
@endsection
@section('content')
    <style>
        .form-control {
            display: initial;
            width: auto;
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
                                    <!-- <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                            <li class="breadcrumb-item active">Responsive Table</li>
                                        </ol>
                                    </div> -->
                                    <h4 class="page-title" style="color: blue">Emails</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <?php
                                $smg = '';

                                if ($smg != '') {
                                    echo '<div id="reg_ok" style="color:red;">' . $smg . '</div>';
                                }

                                ?>
                                <div class="card">
                                    <div class="row m-3">

                                        <div class="col-lg-9 col-md-8 col-sm-12 search ">
                                            <!-- <form id="search-form"> -->
                                            <form action="" method="post" class="form-inline">
                                                <label>
                                                    <select class="form-control " name="category">
                                                        <?php
                                                                    foreach($fields as $field) {
                                                                    $fname=$field;
                                                                    if($fname!='id'&&$fname!='date_added'&&$fname!='bol_rec_id')
                                                                    {
                                                                ?>
                                                        <option value="<?= $field ?>"><?= $field ?></option>
                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                    </select>

                                                </label>

                                                <input type="text" class="form-control" value="Search..."
                                                    name="search" onfocus="this.value = '';"
                                                    onblur="if (this.value == '') {this.value = 'Search...';}"
                                                    required="">

                                                <!-- <input type="image" src="<?php echo url('/'); ?>/dhl/images/search.png" border="0" alt="Submit" /> -->
                                                <button type="submit" class="btn btn-info button-search ">
                                                    <span class="fa fa-search"></span>
                                                </button>


                                            </form>

                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 text-end">
                                            <button class="btn btn-primary" onclick="get_all_checked()">Send</button>
                                            Check all <input type="checkbox" id="checking"
                                                onclick="check_all('click1');" value="Get" />
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <form name="all_data" action="{{ url('/bol/orders_emails_send') }}" method="post">
                                            <input type="hidden" name="all_checked" value="" />

                                            {{ csrf_field() }}

                                            <input type="hidden" name="site" value="<?php echo $bol_rec[0]->site; ?>" />
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
                                                {{-- <div class="table-responsive"> --}}
                                                    <table id="tech-companies-1 " class="table table-striped mb-5" >
                                                        <thead>
                                                        <tr>

                                                            <th>Id</th>
                                                            <th > BestelNummer</th>
                                                            <th > BestelDatum</th>
                                                            <th > Orders</th>
                                                            <th > Naam </th>
                                                            <th >Bedrijfsnaam</th>
                                                            <th > E-mail ID</th>
                                                            <th >Sent</th>
                                                            <th >Ok </th>

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

                                                            </tr>

                                                        </tbody> --}}
                                                    </table >
                                                {{-- </div> <!-- end table-responsive --> --}}
                                            </div> <!-- end .table-rep-plugin-->
                                         </div> <!-- end .responsive-table-plugin-->
                                        </form>
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
                        document.getElementById('checking').checked = true;
                    }
                } else {
                    for (var i = 0; i < checkboxes.length; i++) {
                        checkboxes[i].checked = false;
                        document.getElementById('checking').checked = false;
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

    @endsection
