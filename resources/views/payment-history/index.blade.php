@extends('layouts.app')
@section('title','Payment History | Unikoop')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
@endsection
@section('content')
        {{-- <div class="col-md-10 card middlecontainer">
            <div class="panel panel-info">
                <div class="row" style="margin-top: 8px;">
                    <div class="col-md-12">
                        <div class="container">
                            <h3 style="padding: 20px;">Payment History</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default" id="main_section">
                                        <div class="panel-body">
                                            <table class="table table-hover table-bordered" id="myTable">
                                                <thead>
                                                <tr>
                                                    <th height="30">ID</th>
                                                    <th height="30">Amount</th>
                                                    <th height="30">Description</th>
                                                    <th height="30">Status</th>
                                                    <th height="30">Date</th>
                                                    <th height="30">PDF</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $transactions = \DB::table('transaction_histories')->where('user_id',Auth::id())->where('type','Label')->orWhere('type','Custom Label')->get();
                                                @endphp
                                                @foreach($transactions as $transaction)
                                                    <tr>
                                                        <td height="30">{{ $transaction->id }}</td>
                                                        <td height="30">
                                                            &euro;{{ number_format($transaction->amount,2) }}</td>
                                                        <td height="30">{{ $transaction->description }}</td>
                                                        <td height="30">Completed</td>
                                                        <td height="30">{{ $transaction->created_at }}</td>
                                                        <td height="30">
                                                            @if ($transaction->type == 'Label')
                                                                <a href="{{ route('payment.invoice',$transaction->id) }}"
                                                                class="btn btn-sm btn-primary">
                                                                    <i class="fa fa-file-pdf-o"></i>&nbsp; PDF
                                                                </a>
                                                            @else
                                                                <a href="{{ route('custom.payment.invoice',$transaction->id) }}"
                                                                class="btn btn-sm btn-primary">
                                                                    <i class="fa fa-file-pdf-o"></i>&nbsp; PDF
                                                                </a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        {{-- <form class="d-flex align-items-center mb-3">
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control border" id="dash-daterange">
                                                <span class="input-group-text card border-blue text-white">
                                                    <i class="mdi mdi-calendar-range"></i>
                                                </span>
                                            </div>
                                            <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-2">
                                                <i class="mdi mdi-autorenew"></i>
                                            </a>
                                            <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-1">
                                                <i class="mdi mdi-filter-variant"></i>
                                            </a>
                                        </form> --}}
                                    </div>
                                    <h4 class="page-title" style="color: blue">Payment History</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

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
                                    {{-- <h2 class="page-title" style="color: blue";>Payment History</h2> --}}
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
                                                <div class="table-responsive">
                                                    <div class="row" >
                                                        <div class="col-lg-4"></div>
                                                        <div class="col-lg-3"></div>
                                                        <div class="col-lg-5 col-md-6" >
                                                            <div class="input-group" >
                                                                <div class="form-outline" style="margin-left: 70px;">
                                                                  <input type="search" id="form1" class="form-control" />

                                                                </div>
                                                                <button type="button" class="btn btn-primary" style="float: right;">
                                                                  <i class="fas fa-search"></i>
                                                                </button>
                                                              </div>
                                                        </div>
                                                    </div>
                                                    <table id="tech-companies-1" class="table table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th> ID</th>
                                                            <th>Amount</th>
                                                            <th width="30%">Discription</th>
                                                            <th>Date</th>
                                                            <th >Status</th>
                                                            <th >PDF</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                            $transactions = \DB::table('transaction_histories')->where('user_id',Auth::id())->where('type','Label')->orWhere('type','Custom Label')->get();
                                                        @endphp
                                                        @foreach($transactions as $transaction)

                                                        <tr>
                                                            <td>{{ $transaction->id }}</td>
                                                            <td> &euro;{{ number_format($transaction->amount,2) }}</td>
                                                            <td>{{ $transaction->description }}</td>
                                                            <td>Completed</td>
                                                            <td>{{ $transaction->created_at }}</td>
                                                        <td>@if ($transaction->type == 'Label')
                                                            <a href="{{ route('payment.invoice',$transaction->id) }}"
                                                            class="btn btn-sm btn-primary">
                                                                <i class="fa fa-file-pdf-o"></i>&nbsp; PDF
                                                            </a>
                                                        @else
                                                            <a href="{{ route('custom.payment.invoice',$transaction->id) }}"
                                                            class="btn btn-sm btn-primary">
                                                                <i class="fa fa-file-pdf-o"></i>&nbsp; PDF
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div> <!-- end .table-responsive -->

                                            </div> <!-- end .table-rep-plugin-->
                                        </div> <!-- end .responsive-table-plugin-->
                                    </div>
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="text-end">
                                    <ul class="pagination pagination-rounded justify-content-end">
                                        {{-- <span>{{$transaction->links()}}</span> --}}
                                        <li class="page-item">
                                            <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                                <span aria-hidden="true">«</span>
                                                <span class="visually-hidden">Previous</span>
                                            </a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="javascript: void(0);">1</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                                <span aria-hidden="true">»</span>
                                                <span class="visually-hidden">Next</span>
                                            </a>
                                        </li>
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
@section('js')

    <script src="{{ URL::asset('css/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>

@endsection
