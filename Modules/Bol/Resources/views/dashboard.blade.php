@extends('layouts.app')
@section('title', 'All Orders | Unikoop')
@section('sidebar')
    @include('bol::layouts.side_bar')
@endsection
@section('content')
    <style>

        .w-5 {
            display: none;
        }
    </style>
    {{-- <style>
        .lds-ring {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }

        .lds-ring div {
            box-sizing: border-box;
            display: block;
            position: absolute;
            width: 64px;
            height: 64px;
            margin: 8px;
            border: 8px solid #fff;
            border-radius: 50%;
            animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
            border-color: #004a9b transparent transparent transparent;
        }

        .lds-ring div:nth-child(1) {
            animation-delay: -0.45s;
        }

        .lds-ring div:nth-child(2) {
            animation-delay: -0.3s;
        }

        .lds-ring div:nth-child(3) {
            animation-delay: -0.15s;
        }

        @keyframes lds-ring {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
     <div class="content-page">
        <div class="content">
                <div class="col-md-10 bg-blue middlecontainer">
                        <h3> All Lists </h3>
                        @if (session()->has('success'))
                        <div class="alert alert-dismissable alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>Success</strong>
                            {!! session()->get('success') !!}
                        </div>
                        @endif
                        <div class="btn-group">
                            <a href="{{ route('apidata', 'nl') }}" onclick="return confirm('Are you sure, you want to fetch the orders?')" class="btn btn-primary">
                                Fetch Orders From Bol.com (NL)
                            </a>
                            <a href="{{ route('apidata', 'be') }}" onclick="return confirm('Are you sure, you want to fetch the orders?')" class="btn btn-primary">
                                Fetch Orders From Bol.com (BE)
                            </a>
                        </div>
                        <div class="btn-group">
                        <span class="text_16 badge badge-primary">
                            Total Orders {{ $bol_rec->total() }}</span>
                            <span class="text_16 badge badge-primary">
                            Active Orders 1696</span>
                            <span class="text_16 badge badge-primary">
                            Pending Orders 3446</span>
                            <span class="text_16 badge badge-danger">
                            Failure Orders 10</span>
                        </div>
                        <div id='result-element'></div>
                        <div class="panel panel-default" id="main_section">
                            <div class="panel-body">

                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th height="30"> ID</th>
                                            <th height="30"> Date</th>
                                            <th> Orders</td>
                                            <th height="30"> Site</th>
                                            <th height="30"> Lable</th>
                                            <th height="30"> Action</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    // $userId = ;
                                    // $bol_rec = DB::table('bol_rec')->where('user_id', $userId)->orderBy('id', 'DESC')->get();

                                    //print_r($bol_rec);

                                    foreach ($bol_rec as $bo_rec) {
                                        $bol_rec_id = $bo_rec->id;
                                        $bol_rec_id_sr = $bo_rec->s_no;

                                        $bol_rec_date = $bo_rec->date;

                                        $bol_rec_site = $bo_rec->site;
                                        //echo $bol_rec_id."<br/>";
                                        $bol_data = DB::table('bol_data')->select('logistiek')->where('bol_rec_id', $bol_rec_id)->get();
                                    ?>
                                    <tr>
                                        <td height="30"> <?= $bol_rec_id_sr
                                                            //
                                                            ?> </td>
                                        <td height="30"> <?= date('d-m-Y H:i:s', strtotime($bol_rec_date)) ?> </td>
                                        <td height="30"> <?= $bol_data->count() ?> </td>
                                        <td height="30"> <?= $bol_rec_site ?> </td>
                                        <td height="30">
                                        <?php
                                            $lable_pdf_file = $bo_rec->lable_pdf_file;

                                            if ($lable_pdf_file != "") {
                                                echo '<a href="{{ url("/bol/fetched/labels",$bol_rec_id) }}" class="download-btn" style="cursor: pointer;">All Fetched Labels</a><br>';
                                                echo '<a href="/pdf_zip/' . $lable_pdf_file . '" rel="nofollow" target="_new">Print Labels</a>';
                                            } else {
                                                $dhl = $bol_data->where('logistiek','DHL')->count();
                                                $dpd = $bol_data->where('logistiek','DPD')->count();
                                                $dhl_today = $bol_data->where('logistiek','DHL Today')->count();
                                                $pending = $bol_data->where('logistiek',null)->count();
                                        ?>
                                                @if ($dhl > 0 || $dpd > 0 || $dhl_today > 0)
                                                    <a href="{{ route('fetched.labels',$bol_rec_id) }}" class="download-btn" style="cursor: pointer;">All Fetched Labels</a><br>
                                                @endif
                                                @if ($dhl > 0)
                                                    <a href="{{ route('download.pdf.order', ['type' => 'DHL', 'id' => $bol_rec_id]) }}" target="_blank" class="download-btn"
                                                    style="cursor: pointer;">Download: DHL Labels ({{ $dhl }})</a><br>
                                                @endif

                                                @if ($dpd > 0)
                                                    <a href="{{ route('download.pdf.order', ['type' => 'DPD', 'id' => $bol_rec_id]) }}" target="_blank" class="download-btn"
                                                    style="cursor: pointer;">Download: DPD Labels ({{ $dpd }})</a><br>
                                                @endif

                                                @if ($dhl_today > 0)
                                                    <a href="{{ route('download.pdf.order', ['type' => 'DHL-Today', 'id' => $bol_rec_id]) }}" target="_blank" class="download-btn"
                                                    style="cursor: pointer;">Download: DHL Today Labels ({{ $dhl_today }})</a><br>
                                                @endif
                                        <?php
                                                if ($pending > 0)
                                                    echo '<a href="' . url('/') . '/bol/fetch/select/' . $bol_rec_id . '"  style="cursor: pointer;">Pending: Fetch ('.$pending.')</a>';
                                            }
                                        ?>
                                        </td>
                                        <td height="30">
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button"
                                                        data-toggle="dropdown">Action
                                                    <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{url('/bol/orders/'.$bol_rec_id)}}">Bol Update</a></li>
                                                    <li><a href="{{ route('bolexport', $bol_rec_id) }}">Pick List (Products)</a>
                                                    </li>
                                                    <li><a href="{{ route('Exportqty', $bol_rec_id) }}">Pick List (Quantity)</a>
                                                    </li>
                                                    <li><a href="{{url('/bol/dhl_csv/bol.com (NL)/'.$bol_rec_id)}}">DHL CSV </a>
                                                    </li>
                                                    <li><a href="{{url('/bol/packing_list/bol.com (NL)/'.$bol_rec_id)}}"> Packing
                                                            list </a></li>
                                                    <li><a href="{{url('/bol/create_invoice/bol.com (NL)/'.$bol_rec_id)}}">
                                                            Invoice </a>
                                                        <ul class="">
                                                            <li><a href="{{url('/bol/orders_emails/'.$bol_rec_id)}}">Emails</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="{{url('/bol/delete/bol.com (NL)/'.$bol_rec_id)}}"
                                                        onclick=" return dellcheck()">Delete </a></li>
                                                </ul>
                                            </div>
                                        </td>
                                        </td>
                                    </tr>
                                    <?php  }
                                    ?>
                                </table>                                
                                {{ $bol_rec->links() }}
                            </div>
                        </div>
                </div>
                <div class="modal fade" id="downLabels" tabindex="-1" role="dialog" aria-labelledby="basicModal"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Downloading Labels</h4>
                        </div>
                        <div class="modal-body text-center">
                        <!-- <p>Merging can take more time, please wait...</p> -->
                        <p>Please wait, mergin may take some time...</p>
                            <div class="lds-ring">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div> --}}

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
                        <div class="">
                            <!-- <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                                <li class="breadcrumb-item active">Responsive Table</li>
                                            </ol>
                                        </div> -->
                            <h4 class="page-title">All Orders</h4>
                        </div>

                        @if (session()->has('success'))
                            <div class="alert alert-dismissable alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Success</strong>
                                {!! session()->get('success') !!}
                            </div>
                        @endif
                        <div data-simplebar class="h-100">
                            <!-- Nav tabs -->
                            <!-- Tab panes -->
                            <div class="tab-content pt-0">
                                <div class="tab-pane" id="chat-tab" role="tabpanel">
                                </div>
                                <div class="tab-pane" id="tasks-tab" role="tabpanel">
                                </div>
                                <div class="tab-pane active" id="settings-tab" role="tabpanel">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="responsive-table-plugin">
                                    <div class="table-rep-plugin">
                                        {{-- <div class="table-responsive"> --}}
                                            <ul class="nav nav-pills navtab-bg nav-justified">
                                                <div class="button-list">
                                                    <a href="{{ route('apidata', 'nl') }}"
                                                        class="btn btn-primary waves-effect waves-light"
                                                        onclick="return confirm('Are you sure, you want to fetch the orders?')"
                                                        class="btn btn-primary">
                                                        Fetch Orders From Bol.com (NL)
                                                    </a>
                                                    {{-- <button type="button" class="btn btn-primary waves-effect waves-light">Fetch Order From Bol.com(BE)</button> --}}
                                                    <a href="{{ route('apidata', 'be') }}"
                                                        class="btn btn-primary waves-effect waves-light"
                                                        onclick="return confirm('Are you sure, you want to fetch the orders?')"
                                                        class="btn btn-primary">
                                                        Fetch Orders From Bol.com (BE)
                                                    </a>
                                                    <button type="button"
                                                        class="btn btn-info rounded-pill waves-effect waves-light">Toal
                                                        Records {{ $totalRecords }}</button>

                                                    <button type="button"
                                                        class="btn btn-info rounded-pill waves-effect waves-light">Active
                                                        Orders 1696 </button>



                                                    <button type="button"
                                                        class="btn btn-info rounded-pill waves-effect waves-light">Pending
                                                        Orders 3446</button>



                                                    <button type="button"
                                                        class="btn btn-danger rounded-pill waves-effect waves-light">Failure
                                                        Orders 10</button>


                                                </div>
                                            </ul>
                                            <table id="tech-companies-1" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Date</th>
                                                        <th>Orders</th>
                                                        <th>Site</th>
                                                        <th>Label</th>

                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <?php
                                                        // $userId = ;
                                                        // $bol_rec = DB::table('bol_rec')->where('user_id', $userId)->orderBy('id', 'DESC')->get();

                                                        //print_r($bol_rec);

                                                        foreach ($bol_rec as $bo_rec) {
                                                            $bol_rec_id = $bo_rec->id;
                                                            $bol_rec_id_sr = $bo_rec->s_no;

                                                            $bol_rec_date = $bo_rec->date;

                                                            $bol_rec_site = $bo_rec->site;
                                                            //echo $bol_rec_id."<br/>";
                                                            $bol_data = DB::table('bol_data')->select('logistiek')->where('bol_rec_id', $bol_rec_id)->get();
                                                        ?>
                                                {{-- <tbody> --}}
                                                    <tr>
                                                        <td> <?= $bol_rec_id_sr?> </td>
                                                        <td><?= date('d-m-Y H:i:s', strtotime($bol_rec_date)) ?></td>
                                                        <td><?= $bol_data->count() ?></td>
                                                        <td><?= $bol_rec_site ?></td>
                                                        <td>

                                                            <?php
                                                                    $lable_pdf_file = $bo_rec->lable_pdf_file;

                                                                    if ($lable_pdf_file != "") {
                                                                        echo '<a href="{{ url("/bol/fetched/labels",$bol_rec_id) }}" class="download-btn" style="cursor: pointer;">All Fetched Labels</a><br>';
                                                                        echo '<a href="/pdf_zip/' . $lable_pdf_file . '" rel="nofollow" target="_new">Print Labels</a>';
                                                                    } else {
                                                                        $dhl = $bol_data->where('logistiek','DHL')->count();
                                                                        $dpd = $bol_data->where('logistiek','DPD')->count();
                                                                        $dhl_today = $bol_data->where('logistiek','DHL Today')->count();
                                                                        $pending = $bol_data->where('logistiek',null)->count();
                                                                ?>
                                                            @if ($dhl > 0 || $dpd > 0 || $dhl_today > 0)
                                                                <a href="{{ route('fetched.labels', $bol_rec_id) }}"
                                                                    class="download-btn" style="cursor: pointer;">All
                                                                    Fetched Labels</a><br>
                                                            @endif
                                                            @if ($dhl > 0)
                                                                <a href="{{ route('download.pdf.order', ['type' => 'DHL', 'id' => $bol_rec_id]) }}"
                                                                    target="_blank" class="download-btn"
                                                                    style="cursor: pointer;">Download: DHL Labels
                                                                    ({{ $dhl }})</a><br>
                                                            @endif

                                                            @if ($dpd > 0)
                                                                <a href="{{ route('download.pdf.order', ['type' => 'DPD', 'id' => $bol_rec_id]) }}"
                                                                    target="_blank" class="download-btn"
                                                                    style="cursor: pointer;">Download: DPD Labels
                                                                    ({{ $dpd }})</a><br>
                                                            @endif

                                                            @if ($dhl_today > 0)
                                                                <a href="{{ route('download.pdf.order', ['type' => 'DHL-Today', 'id' => $bol_rec_id]) }}"
                                                                    target="_blank" class="download-btn"
                                                                    style="cursor: pointer;">Download: DHL Today Labels
                                                                    ({{ $dhl_today }})</a><br>
                                                            @endif
                                                            <?php
                                                                        if ($pending > 0)
                                                                            echo '<a href="' . url('/') . '/bol/fetch/select/' . $bol_rec_id . '"  style="cursor: pointer;">Pending: Fetch ('.$pending.')</a>';
                                                                    }
                                                                ?>

                                                        </td>

                                                        <td>
                                                            <div class="btn-group mb-2">
                                                                <button type="button"
                                                                    class="btn btn-primary dropdown-toggle"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">Action <i
                                                                        class="mdi mdi-chevron-down"></i></button>

                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('/bol/orders/' . $bol_rec_id) }}">Bol
                                                                        Update</a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('bolexport', $bol_rec_id) }}">Pick
                                                                        List(Products)</a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('Exportqty', $bol_rec_id) }}">Pick
                                                                        List(Quantity)</a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('/bol/dhl_csv/bol.com (NL)/' . $bol_rec_id) }}">DHL
                                                                        CSV</a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('/bol/packing_list/bol.com (NL)/' . $bol_rec_id) }}">Packing
                                                                        List</a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('/bol/create_invoice/bol.com (NL)/' . $bol_rec_id) }}">Invoice</a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('/bol/orders_emails/' . $bol_rec_id) }}">Emails</a>

                                                                    <a class="dropdown-item"
                                                                        href="{{ url('/bol/delete/bol.com (NL)/' . $bol_rec_id) }}"
                                                                        onclick=" return dellcheck()">Delete</a>

                                                                </div>
                                                        </td>
                                                    </tr>
                                                    <?php  }
                                                            ?>


                                                    <!-- Repeat -->
                                                {{-- </tbody> --}}
                                            </table>
                                        {{-- </div> <!-- end .table-responsive --> --}}

                                    </div> <!-- end .table-rep-plugin-->
                                </div> <!-- end .responsive-table-plugin-->


                                </span>
                            </div>
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-12">
                        <div class="text-end">
                            <ul class="pagination pagination-rounded justify-content-end">
                                <span>{{ $bol_rec->links() }}

                                    {{-- <li class="page-item">
                                            <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                                <span aria-hidden="true">«</span>
                                                <span class="visually-hidden">Previous</span>
                                            </a>
                                        </li> --}}
                                    {{-- <li class="page-item active"><a class="page-link" href="javascript: void(0);">1</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                                        <li class="page-item">
                                            <a class="page-link " href="javascript: void(0);" aria-label="Next">

                                                <span aria-hidden="true">»</span>
                                                <span class="visually-hidden">Next</span>
                                            </a>
                                        </li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div> <!-- container -->

        </div> <!-- content -->



    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

@endsection
