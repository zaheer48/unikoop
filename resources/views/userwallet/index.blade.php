@extends('layouts.service_dashboard')
@section('title','My Wallet | Unikoop')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
@endsection
@section('content')

<div class="col-md-10 bg-blue middlecontainer">

    @if(Session::has('success'))
    <p class="alert alert-success">
        {{ Session::get('success') }}
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </p>
    @endif
        @if($errors->any())
            <ul class="alert alert-warning"
                style="background: #eb5a46; color: #fff; font-weight: 300; line-height: 1.7; font-size: 16px; list-style-type: circle;">
                {!! implode('', $errors->all('<li>:message</li>')) !!}
            </ul>
        @endif
    @if(Session::has('alert-warning'))
    <p class="alert alert-warning">
        {{ Session::get('alert-warning') }}
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </p>
    @endif
    <div class="panel panel-info">
        <div class="row" style="margin-top: 8px;">
            <div class="col-md-12">
                <div class="container">
                    <h3 style="padding: 20px;">My Wallet</h3>
                    <div class="row">
                        <div class="col-6 col-sm-12 col-lg-6">
                            <div class="card text-center">
                                <div class="card-body" style="padding:23px">
                                    <h4 class="card-title"><i style="background: lightgrey;padding: 6px;"
                                                              class="fa fa-dollar"></i></h4>
                                    <h5 class="card-subtitle mb-2">&euro;{{ number_format(Auth::user()->credit_limit,2) }}</h5>
                                    <h5 class="card-link text-danger">
                                        Wallet Balance
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-12 col-lg-6">
                            <div class="card text-center">
                                <div class="card-body" style="padding:33px; cursor: pointer;">
                                    <h4 class="card-title">
                                        <button type="button" class="btn btn-primary" style="padding: 0px;"
                                                data-toggle="modal" data-target="#exampleModal">
                                            <i style="background: #004a9b;padding: 6px;font-size: 27px;"
                                               class="fa fa-plus"></i>
                                        </button>
                                    </h4>
                                    <h5 class="card-link text-danger">
                                        Recharge Wallet
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default" id="main_section">
                                <div class="panel-body">
                                    <table class="table table-hover table-bordered" id="myTable">
                                        <thead>
                                        <tr>
                                            <th height="30">Payment ID</th>
                                            <th height="30">Amount</th>
                                            <th height="30">Method</th>
                                            <th height="30">Description</th>
                                            <th height="30">Paid at</th>
                                            <th height="30">Status</th>
                                            <th height="30">PDF</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $transactions = \DB::table('transaction_histories')->where('user_id',Auth::id())->where('type','Wallet')->get();
                                        @endphp
                                        @foreach($transactions as $transaction)
                                            @php
                                                $summary = json_decode($transaction->summary)
                                            @endphp
                                            <tr>
                                                <td height="30">{{ isset($summary->payment_id) ? $summary->payment_id : '' }}</td>
                                                <td height="30">{{ isset($summary->currency) ? $summary->currency : '' }} {{ $transaction->amount }}</td>
                                                <td height="30">{{ isset($summary->payment_method) ? $summary->payment_method : '' }}</td>
                                                <td height="30">{{ $transaction->description ?? '' }}</td>
                                                <td height="30">{{ isset($summary->paid_at) ? $summary->paid_at : '' }}</td>
                                                <td height="30">
                                                    @php
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
                                                <td height="30">
                                                    <a href="{{ route('wallet.invoice', $transaction->id) }}"
                                                       class="btn btn-sm btn-primary">
                                                        <i class="fa fa-file-pdf-o"></i>&nbsp; PDF
                                                    </a>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Recharge Wallet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="argin-top: -20px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/recharge-wallet') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Payment Method</label>
                        <small style="color: red;"> *</small>
                        <select name="payment_type" class="form-control" required>
                            <option value="mollie">Mollie</option>
                          <option value="bankTransfer">Bank Transfer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Amount</label>
                        <small style="color: red;"> * Max amount limit per request: &euro;999</small>
                        <input type="text" name="amount" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea type="text" name="description" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Recharge Wallet</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('js')

    <script src="{{ asset('css/datatables.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>

@endsection