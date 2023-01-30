@extends('layouts.app')
@section('title','Payment History | Unikoop')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
@endsection
@section('content')


<div class="content-page">
    <div class="content">
          <!-- start page title -->
          <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form class="d-flex align-items-center mb-3">
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
                        </form>
                    </div>
                    <h4 class="page-title">Payment History</h4>
                </div>
            </div>
          </div>
        <!-- end page title -->

        <div class="col-md-10 card middlecontainer">
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
        </div>
    </div>
</div>
@endsection
@section('js')

    <script src="{{ asset('css/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>

@endsection
