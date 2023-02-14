@extends('layouts.app')
@section('title','User Report')
@section('sidebar')
    @include('layouts.admin_side_bar')
@endsection
@section('content')
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
    <style>
        .dataTables_wrapper {
            overflow-x: scroll !important;
        }
        .text_less_more {
            font-weight: 400; 
            color: #337ab7;
            cursor: pointer;
            display: block;
            font-size: 12px;
        }
    </style>
    <div class="content-page">
        <div class="content">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>User Report</h3>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs">
                                <li class="active" style="display: contents;">
                                    <a href="#profile" data-toggle="tab">Profile</a>
                                </li>
                                <li style="display: contents;">
                                    <a href="#business" data-toggle="tab">Business Info</a>
                                </li>
                                <li style="display: contents;">
                                    <a href="#recharged" data-toggle="tab">Recharged History</a>
                                </li>
                                <li style="display: contents;">
                                    <a href="#payment" data-toggle="tab">Payment History</a>
                                </li>
                                <li style="display: contents;">
                                    <a href="#labels" data-toggle="tab">All Labels</a>
                                </li>
                                <li style="display: contents;">
                                    <a href="#dhl" data-toggle="tab">DHL Labels</a>
                                </li>
                                <li style="display: contents;">
                                    <a href="#dpd" data-toggle="tab">DPD Labels</a>
                                </li>
                                <li style="display: contents;">
                                    <a href="#custom" data-toggle="tab">Custom Labels</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="profile" class="tab-pane fade in active">
                                    <div class="row" style="padding: 30px;">
                                        <div class="col-md-12">
                                            <p>Account Status: <strong>
                                                    <mark>{{ ($user->is_active) ? 'Active' : 'De-active' }}</mark>
                                                </strong></p>
                                            <p>Username: <strong>{{ $user->username }}</strong></p>
                                            <p>E-Mail: <strong>{{ $user->email }}</strong></p>
                                            <p>Password: <strong>{{ $user->password_hint }}</strong></p>
                                            <p>Credit Limit: <strong>&euro;{{ number_format($user->credit_limit,2) }}</strong></p>
                                            <p>Bol Client ID (NL): <strong>{{ $user->bol_client_id }}</strong></p>
                                            <p>Bol Client Secret (NL): <strong>{{ $user->bol_client_secret }}</strong></p>
                                            <p>Bol Client ID (BE): <strong>{{ $user->bol_be_client_id }}</strong></p>
                                            <p>Bol Client Secret (BE): <strong>{{ $user->bol_be_client_secret }}</strong></p>
                                            <p>Price Per DHL Label: <strong>&euro;{{ number_format($user->price_per_label,2) }}</strong></p>
                                            <p>Price Per DPD Label: <strong>&euro;{{ number_format($user->price_per_label_dpd,2) }}</strong></p>
                                        @php
                                        $username = \App\Models\User::select('username')->where('id', $user->create_by)->first();
                                        @endphp
                                            <p>Added On: <strong>{{ ($user->created_at) ? $user->created_at->toFormattedDateString() : '' }}</strong></p>
                                            <p>Created By: <strong>{{ isset($username->username) ? $username->username : 'unknown'  }}</strong></p>
                                        </div>
                                    </div>
                                </div>
                                <div id="business" class="tab-pane fade">
                                    <div class="row" style="padding: 30px;">
                                        <div class="col-md-12">
                                            @if ($business)
                                                <p>House No: <strong>{{ $business->h_b_number }}</strong></p>
                                                <p>Street: <strong>{{ $business->street }}</strong></p>
                                                <p>City Town: <strong>{{ $business->city_town }}</strong></p>
                                                <p>County: <strong>{{ $business->county }}</strong></p>
                                                <p>Country: <strong>{{ $business->country }}</strong></p>
                                                <p>Postcode: <strong>{{ $business->postcode }}</strong></p>
                                                <p>Phone Number: <strong>{{ $business->phonenumber }}</strong></p>
                                                <p>Work Phone: <strong>{{ $business->workphone }}</strong></p>
                                                <p>Mobile Phone: <strong>{{ $business->mobilephone }}</strong></p>
                                                <p>Admin E-mail: <strong>{{ $business->email_admin }}</strong></p>
                                                <p>Sales E-mail: <strong>{{ $business->email_sales }}</strong></p>
                                            @else
                                                <p>No record found.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div id="recharged" class="tab-pane fade">
                                    <div class="row" style="padding: 30px;">
                                        <div class="col-md-12">
                                            <table class="table table-hover table-bordered" id="recharged_table">
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
                                                @foreach($transactions->where('type','Wallet') as $transaction)
                                                    @php
                                                        $summary = json_decode($transaction->summary)
                                                    @endphp
                                                    <tr>
                                                        <td height="30">{{ ($summary->payment_id ?? '') }}</td>
                                                        <td height="30">{{ ($summary->currency ?? '') }} {{ $transaction->amount }}</td>
                                                        <td height="30">{{ ($summary->payment_method ?? '') }}</td>
                                                        <td height="30">{{ $transaction->description }}</td>
                                                        <td height="30">{{ ($summary->paid_at ?? '') }}</td>
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
                                                            <a href="{{ url('/wallet-invoice',$transaction->id) }}"
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
                                <div id="payment" class="tab-pane fade">
                                    <div class="row" style="padding: 30px;">
                                        <div class="col-md-12">
                                            <table class="table table-hover table-bordered" id="payment_table">
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
                                                @foreach($transactions->where('type','Label') as $transaction)
                                                    <tr>
                                                        <td height="30">{{ $transaction->id }}</td>
                                                        <td height="30">&euro;{{ number_format($transaction->amount,2) }}</td>
                                                        <td height="30">{{ $transaction->description }}</td>
                                                        <td height="30">Completed</td>
                                                        <td height="30">{{ $transaction->created_at }}</td>
                                                        <td height="30">
                                                            <a href="{{ url('/payment-invoice',$transaction->id) }}"
                                                            class="btn btn-sm btn-primary">
                                                                <i class="fa fa-file-pdf-o"></i>&nbsp; PDF
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @foreach($transactions->where('type','Custom Label') as $transaction)
                                                    <tr>
                                                        <td height="30">{{ $transaction->id }}</td>
                                                        <td height="30">
                                                            &euro;{{ number_format($transaction->amount,2) }}</td>
                                                        <td height="30">{{ $transaction->description }}</td>
                                                        <td height="30">Completed</td>
                                                        <td height="30">{{ $transaction->created_at }}</td>
                                                        <td height="30">
                                                            <a href="{{ url('/custom-payment-invoice',$transaction->id) }}"
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
                                <div id="labels" class="tab-pane fade">
                                    <div class="row" style="padding: 30px;">
                                        <div class="col-md-12">
                                            <table class="table table-hover table-bordered" id="label_table">
                                                <thead>
                                                <tr>
                                                    <th height="30">Id</th>
                                                    <th height="30">Product</th>
                                                    <th height="30">BestelNummer</th>
                                                    <th height="30">Postcode</th>
                                                    <th height="30">Voornaam</th>
                                                    <th height="30">Achternaam</th>
                                                    <th height="30">TrackerCode</th>
                                                    <th height="30">Prijis</th>
                                                    <th height="30">BestelDatum</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($labels as $label)
                                                    <tr>
                                                        <td>{{ $label->id }}</td>
                                                        <td>
                                                            <span id="all_{{ $label->id }}">{{ substr($label->producttitel,0,10) }}...</span>
                                                            <span id="text_{{ $label->id }}" class="text_less_more" onclick="showMoreAll('{{ $label->id }}','{{ $label->producttitel }}')">
                                                                Show More
                                                            </span>
                                                        </td>
                                                        <td>{{ $label->bestelnummer }}</td>
                                                        <td>{{ $label->postcode_verzending }}</td>
                                                        <td>{{ $label->voornaam_verzending }}</td>
                                                        <td>{{ $label->achternaam_verzending }}</td>
                                                        <td>{{ $label->trackerCode }}</td>
                                                        <td>
                                                            @if($label->price_charged)
                                                            &euro;{{ number_format($label->price_charged,2) }}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>{{ $label->besteldatum }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="dhl" class="tab-pane fade">
                                    <div class="row" style="padding: 30px;">
                                        <div class="col-md-12">
                                            <table class="table table-hover table-bordered" id="dhl_table">
                                                <thead>
                                                <tr>
                                                    <th height="30">Id</th>
                                                    <th height="30">Product</th>
                                                    <th height="30">BestelNummer</th>
                                                    <th height="30">Postcode</th>
                                                    <th height="30">Voornaam</th>
                                                    <th height="30">Achternaam</th>
                                                    <th height="30">TrackerCode</th>
                                                    <th height="30">Prijis</th>
                                                    <th height="30">BestelDatum</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($labels->where('logistiek','DHL') as $label)
                                                    <tr>
                                                        <td>{{ $label->id }}</td>
                                                        <td>
                                                            <span id="dhl_{{ $label->id }}">{{ substr($label->producttitel,0,10) }}...</span>
                                                            <span id="dhl_text_{{ $label->id }}" class="text_less_more" onclick="showMoreDhl('{{ $label->id }}','{{ $label->producttitel }}')">
                                                                Show More
                                                            </span>
                                                        </td>
                                                        <td>{{ $label->bestelnummer }}</td>
                                                        <td>{{ $label->postcode_verzending }}</td>
                                                        <td>{{ $label->voornaam_verzending }}</td>
                                                        <td>{{ $label->achternaam_verzending }}</td>
                                                        <td>{{ $label->trackerCode }}</td>
                                                        <td>
                                                            @if($label->price_charged)
                                                            &euro;{{ number_format($label->price_charged,2) }}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>{{ $label->besteldatum }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="dpd" class="tab-pane fade">
                                    <div class="row" style="padding: 30px;">
                                        <div class="col-md-12">
                                            <table class="table table-hover table-bordered" id="dpd_table">
                                                <thead>
                                                <tr>
                                                    <th height="30">Id</th>
                                                    <th height="30">Product</th>
                                                    <th height="30">BestelNummer</th>
                                                    <th height="30">Postcode</th>
                                                    <th height="30">Voornaam</th>
                                                    <th height="30">Achternaam</th>
                                                    <th height="30">TrackerCode</th>
                                                    <th height="30">Prijis</th>
                                                    <th height="30">BestelDatum</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($labels->where('logistiek','DPD') as $label)
                                                    <tr>
                                                        <td>{{ $label->id }}</td>
                                                        <td>
                                                            <span id="dpd_{{ $label->id }}">{{ substr($label->producttitel,0,10) }}...</span>
                                                            <span id="dpd_text_{{ $label->id }}" class="text_less_more" onclick="showMoreDpd('{{ $label->id }}','{{ $label->producttitel }}')">
                                                                Show More
                                                            </span>
                                                        </td>
                                                        <td>{{ $label->bestelnummer }}</td>
                                                        <td>{{ $label->postcode_verzending }}</td>
                                                        <td>{{ $label->voornaam_verzending }}</td>
                                                        <td>{{ $label->achternaam_verzending }}</td>
                                                        <td>{{ $label->trackerCode }}</td>
                                                        <td>
                                                            @if($label->price_charged)
                                                            &euro;{{ number_format($label->price_charged,2) }}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>{{ $label->besteldatum }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="custom" class="tab-pane fade">
                                    <div class="row" style="padding: 30px;">
                                        <div class="col-md-12">
                                            <table class="table table-hover table-bordered" id="custom_table">
                                                <thead>
                                                <tr>
                                                    <th height="30">EAN</th>
                                                    <th height="30">BestelNummer</th>
                                                    <th height="30">Voornaam</th>
                                                    <th height="30">Achternaam</th>
                                                    <th height="30">Logistiek</th>
                                                    <th height="30">TrackerCode
                                                    <th height="30">Prijis</th>
                                                    <th height="30">PDF</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $orders = \App\Models\CustomOrder::where('user_id',$user->id)->where('logistics', '!=', null)->get();
                                                @endphp
                                                @foreach($orders as $label)
                                                    <tr>
                                                        <td>{{ $label->ean }}</td>
                                                        <td>{{ $label->bestel_nummer }}</td>
                                                        <td>{{ $label->first_name }}</td>
                                                        <td>{{ $label->last_name }}</td>
                                                        <td>{{ $label->logistics }}</td>
                                                        <td>{{ $label->trackerCode }}</td>
                                                        <td>
                                                            @if($label->price_charged)
                                                            &euro;{{ number_format($label->price_charged,2) }}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td><a href="{{ asset('pdf_files/'.$label->lable_pdf) }}"
                                                            class="btn btn-sm btn-primary">
                                                                <i class="fa fa-file-pdf-o"></i> PDF
                                                            </a></td>
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
                    <br>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="{{ asset('css/datatables.min.js') }}"></script>
    <script>

        $(document).ready(function () {
            $('#recharged_table').DataTable({responsive: true});
            $('#payment_table').DataTable({responsive: true});
            $('#label_table').DataTable({responsive: true});
            $('#dhl_table').DataTable({responsive: true});
            $('#dpd_table').DataTable({responsive: true});
            $('#custom_table').DataTable({responsive: true});
        });

        function showMoreAll(id,title) {
            $('#text_'+id).attr('onclick', 'showLessAll("'+id+'","'+title+'")');
            $('#all_'+id).html(title);
            $('#text_'+id).html('Show Less');
        }

        function showLessAll(id,title) {
            $('#text_'+id).attr('onclick', 'showMoreAll("'+id+'","'+title+'")');
            var str = title.substring(0,10);
            $('#all_'+id).html(str);
            $('#text_'+id).html('Show More');
        }

        function showMoreDhl(id,title) {
            $('#dhl_text_'+id).attr('onclick', 'showLessDhl("'+id+'","'+title+'")');
            $('#dhl_'+id).html(title);
            $('#dhl_text_'+id).html('Show Less');
        }
        function showLessDhl(id,title) {
            $('#dhl_text_'+id).attr('onclick', 'showMoreDhl("'+id+'","'+title+'")');
            var str = title.substring(0,10);
            $('#dhl_'+id).html(str);
            $('#dhl_text_'+id).html('Show More');
        }

        function showMoreDpd(id,title) {
            $('#dpd_text_'+id).attr('onclick', 'showLessDpd("'+id+'","'+title+'")');
            $('#dpd_'+id).html(title);
            $('#dpd_text_'+id).html('Show Less');
        }

        function showLessDpd(id,title) {
            $('#dpd_text_'+id).attr('onclick', 'showMoreDpd("'+id+'","'+title+'")');
            var str = title.substring(0,10);
            $('#dpd_'+id).html(str);
            $('#dpd_text_'+id).html('Show More');
        }

    </script>
@endsection