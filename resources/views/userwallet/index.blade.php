@extends('layouts.app')
@section('title', 'My Wallet | Unikoop')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
@endsection


@section('content')

    <div class="content-page">
        <div class="content">

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->



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
                                    </form> --}}
                                </div>
                                <h4 class="page-title" style="color: blue;">My Wallet</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    @if (Session::has('success'))

                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('success') }}.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                   @endif
                @if (Session::has('alert-warning'))
                    
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('alert-warning') }}.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                @endif
                @if ($errors->any())
                    <ul class="alert alert-warning"
                        style="background: #eb5a46; color: #fff; font-weight: 300; line-height: 1.7; font-size: 16px; list-style-type: circle;">
                        {!! implode('', $errors->all('<li>:message</li>')) !!}
                    </ul>
                @endif
                {{-- @if (Session::has('alert-warning'))
                    <p class="alert alert-warning">
                        {{ Session::get('alert-warning') }}
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </p>
                @endif --}}





                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body mt-5 text-center">
                                <h3> <i class="fe-dollar-sign " style="height:40px;"></i></h3>
                                <h4>&euro;{{ number_format(Auth::user()->credit_limit, 2) }}</h4>
                                <h4 style="color: red;">Wallet Balance</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body mt-5 text-center">


                                <!-- Button trigger modal -->

                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#signup-modal">
                                    <h3>
                                        <i class="fe-plus-square"></i>
                                    </h3>
                                </button>

                                </button>

                                <div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-body">
                                                <div class="mt-2 mb-4">
                                                    <div class="auth-logo">
                                                        <a href="index.html" class="logo logo-dark">
                                                            <span class="logo-lg">
                                                                <img src="assets/images/logo-dark.png" alt=""
                                                                    height="24">
                                                            </span>
                                                        </a>

                                                        <a href="index.html" class="logo logo-light">
                                                            <span class="logo-lg">
                                                                <img src="assets/images/logo-light.png" alt=""
                                                                    height="24">
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>



                                                <form action="{{ url('/recharge-wallet') }}" method="POST">
                                                    @csrf
                                                            <h5 class="text-primary ">Recharge Wallet</h5>
                                                    <div class="form-group text-start mt-3">
                                                        <label for="">Payment Method</label>
                                                        <small style="color: red;"> *</small>
                                                        <select name="payment_type" class="form-control" required>
                                                            <option value="mollie">Mollie</option>
                                                            <option value="bankTransfer">Bank Transfer</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group  text-start mt-3">
                                                        <label for="">Amount</label>
                                                        <small style="color: red;"> * Max amount limit per request:
                                                            &euro;999</small>
                                                        <input type="text" name="amount" placeholder="Amount" class="form-control"
                                                            required>
                                                    </div>
                                                    <div class="form-group  text-start mt-3">
                                                        <label for="">Description</label>
                                                        <textarea type="text" name="description" class="form-control" rows="2"></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Recharge
                                                            Wallet</button>
                                                    </div>


                                                </form>

                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>

                                <h4 style="color: red;">Recharge Wallet</h4>
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
                                            <div class="row mb-3">
                                                {{-- <div class="col-4  "></div>
                                                <div class="col-3  "></div> --}}
                                                <div class="col-lg-5 col-md-6">
                                                    <div class="input-group">
                                                        <div class="form-outline" >
                                                            <input type="search" id="form1" class="form-control" placeholder="Search" />

                                                        </div>
                                                        <button type="button" class="btn btn-primary"
                                                            style="float: right;">
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <table id="tech-companies-1" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Payment ID</th>
                                                        <th>Amount</th>
                                                        <th>Method</th>
                                                        <th width="30%">Discription</th>
                                                        <th>Paid at</th>
                                                        <th>Status</th>
                                                        <th>PDF</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $transactions = \DB::table('transaction_histories')
                                                            ->where('user_id', Auth::id())
                                                            ->where('type', 'Wallet')
                                                            ->get();
                                                    @endphp
                                                    @foreach ($transactions as $transaction)
                                                        @php
                                                            $summary = json_decode($transaction->summary);
                                                        @endphp


                                                        <tr>
                                                            <td>{{ isset($summary->payment_id) ? $summary->payment_id : '' }}
                                                            </td>

                                                            <td>{{ isset($summary->currency) ? $summary->currency : '' }}
                                                                {{ $transaction->amount }}</td>
                                                            <td>{{ isset($summary->payment_method) ? $summary->payment_method : '' }}
                                                            </td>
                                                            <td>{{ $transaction->description ?? '' }}</td>
                                                            <td>{{ isset($summary->paid_at) ? $summary->paid_at : '' }}
                                                            </td>
                                                            <td> @php
                                                                switch ($transaction->transaction_status) {
                                                                    case 0:
                                                                        echo 'N/A';
                                                                        break;
                                                                    case 1:
                                                                        echo 'Approved';
                                                                        break;
                                                                    case 2:
                                                                        echo 'Rejected';
                                                                        break;
                                                                }
                                                            @endphp
                                                            </td>

                                                            <td>

                                                                {{-- <button type="button" class="btn btn-primary"
                                                            aria-haspopup="true" aria-expanded="false"> PDF <i class="fe-file-plus"></i>
                                                        </button> --}}


                                                                <a href="{{ route('wallet.invoice', $transaction->id) }}"
                                                                    class="btn btn-sm btn-primary">
                                                                    <i class="fa-solid fa-file-pdf"></i>&nbsp; PDF
                                                                </a>


                                                            </td>


                                                        </tr>
                                                    @endforeach




                                                </tbody>
                                            </table>
                                        {{-- </div> <!-- end .table-responsive --> --}}

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
                                {{-- <span>
                                            {{$transactions->link()}}
                                        </span> --}}
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
                                            <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                                <span aria-hidden="true">»</span>
                                                <span class="visually-hidden">Next</span>
                                            </a>
                                        </li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div> <!-- container -->



            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
        </div>
    </div>

@endsection
@section('js')

    <script src="{{ asset('css/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

@endsection
