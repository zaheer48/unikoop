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
{{-- <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            {{-- <div class="page-title-right">
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
                            <h3 class="page-title" style="color: blue"> All Orders</h3>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <!-- order list start -->
                <div class="container mt-10">
                    <div class="row">

                        <?php
                        //$this->load->view($theme_path.'dhl/assets/sidebar');
                        ?>
                        <div class="col-md-12 card middlecontainer">
                            <div class="row">




                                <div id="admin_page_form">
                                    <?php
                                    $smg = '';

                                    if ($smg != '') {
                                        echo '<div id="reg_ok" style="color:red;">' . $smg . '</div>';
                                    }

                                    ?>

                                    <div id="show_file_table" class=" panel-body panel-body-multi">
                                        <div class="row my-3">

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



                                        <br>
                                        <form name="all_data" action="{{ url('/bol/orders_emails_send') }}"
method="post">
<input type="hidden" name="all_checked" value="" />

{{ csrf_field() }}

<input type="hidden" name="site" value="<?php echo $bol_rec[0]->site; ?>" />

<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="table-responsive">

                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th height="30"> id </th>

                            <th height="30"> BestelNummer </th>

                            <th height="30"> BestelDatum </th>

                            <th height="30"> Orders </th>

                            <th height="30"> Naam </th>

                            <th height="30"> Bedrijfsnaam </th>

                            <th height="30"> E-mail ID </th>

                            <th height="30"> Sent </th>

                            <th height="30"> Ok </th>
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
                </table>
            </div>
        </div>

    </div>
</div>
</form>

<!--<div class="text-right">
                                    <button class="btn btn-primary">Update</button>
                                    Send all <input type="checkbox" id="checkings" onclick="check_all2('click1');" value="Get" />
                                </div>-->

</div>

</div>

<!-- closing 10 -->
</div>
</div>

</div>
</div>
</div>
</div>


<!-- order list end -->
</div> --}}
<!-- Start Page Content here -->
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
                                    <input type="text" class="form-control" value="Search..." name="search"
                                        onfocus="this.value = '';"
                                        onblur="if (this.value == '') {this.value = 'Search...';}" required="">

                                    <!-- <input type="image" src="<?php echo url('/'); ?>/dhl/images/search.png" border="0" alt="Submit" /> -->
                                    <button type="submit" class="btn btn-info button-search ">
                                        <span class="fa fa-search"></span>
                                    </button>
                                </form>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12 text-end">
                                <button class="btn btn-primary" onclick="get_all_checked()">Send</button>
                                Check all <input type="checkbox" id="checking" onclick="check_all('click1');"
                                    value="Get" />
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
                                        <table id="tech-companies-1 " class="table table-striped mb-5">
                                            <thead>
                                                <tr>

                                                    <th>Id</th>
                                                    <th> BestelNummer</th>
                                                    <th> BestelDatum</th>
                                                    <th> Orders</th>
                                                    <th> Naam </th>
                                                    <th>Bedrijfsnaam</th>
                                                    <th> E-mail ID</th>
                                                    <th>Sent</th>
                                                    <th>Ok </th>

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
                                        </table>
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
<!-- End Page content -->
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