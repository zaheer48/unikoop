@extends('layouts.app')
@section('title','Order List | Unikoop')
@section('sidebar')
    @include('bol::layouts.side_bar')
@endsection
@section('content')
<style>
    .form-control{
        width:auto;
        display: initial;
    }


    </style>
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
                        <h4 class="page-title">All Orders </h4>
                    </div>
                </div>
            </div> --}}
            <!-- end page title -->
                <!-- order list start -->
                <div class="container mt-10">
                    <div class="row">

                        <?php
                        //$this->load->view($theme_path.'dhl/assets/sidebar');
                        ?>
                        <div class="col-md-12 card middlecontainer">
                            <h3 class="page-title" style="color:blue"> All Orders </h3>
                            <div class="row">
                            @if(session('success'))
                                <p class="alert alert-success"><strong>Success:</strong> {{ session('success') }}</p>
                            @endif
                            @if(session('danger'))
                                <p class="alert alert-danger"><strong>Failed:</strong> {{ session('danger') }}</p>
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

                                            <div class="col-lg-9 col-md-8 col-sm-12 search">
                                                <!-- <form id="search-form"> -->
                                                <form action="dhl/order_list/search" method="post" class="form-inline">
                                                    <label>
                                                        <select class="form-control " name="category">
                                                            <?php
                                                            foreach($fields as $field) {
                                                            $fname = $field;
                                                            if($fname != 'id' && $fname != 'date_added' && $fname != 'bol_rec_id')
                                                            {
                                                            ?>
                                                            <option value="<?=$field?>"><?=$field?></option>
                                                            <?php
                                                            }
                                                            }
                                                            ?>
                                                        </select>

                                                    </label>

                                                    <input type="text" class="form-control" value="Search..." name="search"
                                                        onfocus="this.value = '';"
                                                        onblur="if (this.value == '') {this.value = 'Search...';}" required="">

                                                <!-- <input type="image" src="<?php echo url('/'); ?>/dhl/images/search.png" border="0" alt="Submit" /> -->

                                                    <button type="submit" class="btn btn-info button-search">
                                                        <span class="fa fa-search"></span>
                                                    </button>
                                                </form>

                                            </div>
                                            <div class="col-lg-3 col-md-4 col-sm-12 text-end">
                                                <button class="btn btn-primary" onclick="get_all_checked()">Update</button>
                                                Checked all <input type="checkbox" id="checking" onclick="check_all('click1');"
                                                                value="Get"/>
                                            </div>


                                    </div>


                                        <br>
                                        {{-- <form name="all_data" action="{{url('/bol/update_orders')}}" method="post">
                                            <input type="hidden" name="all_checked" value=""/>

                                            {{ csrf_field() }}
                                            <input type="hidden" name="order_id" value="{{ $order_id }}">
                                            <input type="hidden" name="site" value="<?php echo $bol_rec[0]->site; ?>"/>

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

                                                                    <th height="30"> Uiterste Leverdatum</th>

                                                                    <th height="30"> TrackerCode</th>

                                                                    <th height="30"> Orders</th>
                                                                    <th height="30"> Update Status</th>

                                                                    <th height="30"> Action</th>
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
                                        </form> --}}





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

                                                   <form name="all_data" action="{{url('/bol/update_orders')}}" method="post">
                                                    <input type="hidden" name="all_checked" value=""/>

                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="order_id" value="{{ $order_id }}">
                                                    <input type="hidden" name="site" value="<?php echo $bol_rec[0]->site; ?>"/>
                                                   <div class="table-responsive">
                                                    <table id="tech-companies-1 " class="table table-striped mb-5" >
                                                        <thead>
                                                        <tr>

                                                            <th>Id</th>
                                                            <th >Product</th>
                                                            <th >BestelNummer</th>
                                                            <th >Postcode</th>
                                                            <th >Voomaam</th>
                                                            <th >Archternaam</th>
                                                            <th >BestelDatum</th>
                                                            <th > Uiterste Leverdatum</th>

                                                            <th > TrackerCode</th>

                                                            <th > Orders</th>
                                                            <th> Update Status</th>

                                                            <th> Action</th>
                                                            <th>
                                                                <div class="">
                                                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                                                            <!-- select all boxes -->
                                                            <input type="hidden"  id="checkings" onclick="check_all('click1');"
                                                            value="Get"/></th>
                                                        </tr>
                                                        </thead>

                                                        <tbody class="">
                                                            <?php
                                                            if (!empty($rows)) {

                                                                print_r($rows);

                                                            } else {
                                                                echo('<tr>');
                                                                echo('<td height="30" colspan="11"> No Record Found! </td>');
                                                                echo('</tr>');
                                                            }
                                                            ?>

                                                        </tbody>
                                                    </table >
                                                </div> <!-- end table-responsive -->
                                            </div> <!-- end .table-rep-plugin-->
                                        </div> <!-- end .responsive-table-plugin-->
                                    </div>
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->





        </div>



                                        {{-- <div class="text-right">
                                            <button class="btn btn-primary">Update</button>
                                            Checked all <input type="checkbox" id="checkings" onclick="check_all2('click1');"
                                                            value="Get"/>
                                        </div> --}}

                                    </div>

                                </div>

                                <!-- closing 10 -->
                            </div>
                        </div>

                    </div>
                </div>
                <!-- order list end -->

    </div>
</div>


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
@endsection
