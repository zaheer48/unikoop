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
<!-- Start Page Content here -->
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="my-3">
                        <!-- <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                    <li class="breadcrumb-item active">Responsive Table</li>
                                </ol>
                            </div> -->
                        <h4 class="page-title" style="color: blue">All Orders</h4>
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
                                    <ul class="nav nav-pills navtab-bg nav-justified mb-3">
                                        <div class="button-list">
                                            <a href="{{ route('apidata', 'nl') }}"
                                                class="btn btn-primary waves-effect waves-light"
                                                onclick="return confirm('Are you sure, you want to fetch the orders?')"
                                                class="btn btn-primary">
                                                Fetch Orders From Bol.com (NL)
                                            </a>
                                            <a href="{{ route('apidata', 'be') }}"
                                                class="btn btn-primary waves-effect waves-light"
                                                onclick="return confirm('Are you sure, you want to fetch the orders?')"
                                                class="btn btn-primary">
                                                Fetch Orders From Bol.com (BE)
                                            </a>
                                            <button type="button"
                                                class="btn btn-info rounded-pill waves-effect waves-light">
                                                Toal Records {{ $bol_rec->total() }}</button>
                                            <button type="button"
                                                class="btn btn-info rounded-pill waves-effect waves-light">
                                                Active Orders @if(isset($bol_update_status_count['Not Updated']))
                                                {{ $bol_update_status_count['Not Updated'] }} @else {{ 0 }} @endif
                                            </button>
                                            <button type="button"
                                                class="btn btn-info rounded-pill waves-effect waves-light">
                                                Pending Orders
                                                @if(isset($bol_update_status_count['PENDING'])){{ $bol_update_status_count['PENDING'] }}
                                                @else {{ 0 }} @endif
                                            </button>
                                            <button type="button"
                                                class="btn btn-danger rounded-pill waves-effect waves-light">
                                                Failure Orders
                                                @if(isset($bol_update_status_count['FAILURE'])){{ $bol_update_status_count['FAILURE'] }}
                                                @else {{ 0 }} @endif
                                            </button>
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
                                            foreach ($bol_rec as $bo_rec) {
                                                $bol_rec_id = $bo_rec->id;
                                                $bol_rec_id_sr = $bo_rec->s_no;

                                                $bol_rec_date = $bo_rec->date;

                                                $bol_rec_site = $bo_rec->site;
                                                //echo $bol_rec_id."<br/>";
                                                $bol_data = DB::table('bol_data')->select('logistiek')->where('bol_rec_id', $bol_rec_id)->get();
                                        ?>
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
                                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        Action <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ url('/bol/orders/' . $bol_rec_id) }}">
                                                            Bol Update
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('bolexport', $bol_rec_id) }}">
                                                            Pick List(Products)
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('Exportqty', $bol_rec_id) }}">
                                                            Pick List(Quantity)
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ url('/bol/dhl_csv/bol.com (NL)/' . $bol_rec_id) }}">
                                                            DHL CSV
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ url('/bol/packing_list/bol.com (NL)/' . $bol_rec_id) }}">
                                                            Packing List
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ url('/bol/create_invoice/bol.com (NL)/' . $bol_rec_id) }}">
                                                            Invoice
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ url('/bol/orders_emails/' . $bol_rec_id) }}">
                                                            <i class="fa-solid fa-arrow-right"></i> Emails
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ url('/bol/delete/bol.com (NL)/' . $bol_rec_id) }}"
                                                            onclick=" return dellcheck()">
                                                            Delete
                                                        </a>
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