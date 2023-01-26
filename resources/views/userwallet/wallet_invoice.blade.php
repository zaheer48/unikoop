<!DOCTYPE html>
<html>
<head>
    @php
        $settings = \DB::table('website_settings')->first();
        $summary = json_decode($transaction->summary);
    @endphp
    <title>Wallet Recharge Invoice | {{$settings->site_title}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="{{ asset('dhl/css/bootstrap.min.css') }}">
    <link href="{{ asset('dhl/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dhl/font-awesome/css/font-awesome.min.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
          rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700'
          rel='stylesheet' type='text/css'>
</head>
<body style="background-color: #fff;">
<div class="container">
    <div class="panel">
        <div>
            <div class="row" style="margin-top: 8px;">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <img src="{{ asset('portal/'.$settings->site_logo) }}" style="width: 250px; margin-top: 20px;">
                    <div style="float: right; margin-right: 2%;">
                        <h2>{{ ($summary->description ?? '') }}</h2>
                        <p>Recharged
                            on: {{ ($summary->created_at ?? '') }}
                        </p>
                        <p>
                            @if($transaction->transaction_status == 0)
                                Status: N/A
                            @elseif ($transaction->transaction_status == 1)
                                Approved: {{ $transaction->updated_at }}
                            @elseif ($transaction->transaction_status == 2)
                                Rejected: {{ $transaction->updated_at }}
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <hr style="border-top: 3px solid #eee; display: block;">
                    <div style="float: left;">
                        <h5 style="font-weight: 700;">Transaction Details:</h5>
                        <p>
                            {{ ($summary->description ?? '') }} <br>
                            Payment ID: {{ ($summary->payment_id ?? '') }} <br>
                            Amount {{ ($summary->amount ?? '') }} <br>
                            Currency {{ ($summary->currency ?? '') }} <br>
                            Payment Method {{ ($summary->payment_method ?? '') }} <br>
                            Created at {{ ($summary->created_at ?? '') }} <br>
                        </p>
                    </div>
                    <div style="float: right; margin-right: 7%;">
                        <h5 style="font-weight: 700;">User Details:</h5>
                        <p>
                            Card Number {{ ($summary->card_number ?? '') }} <br>
                            Card Holder {{ ($summary->card_holder ?? '') }} <br>
                            Card Audience {{ ($summary->card_audience ?? '') }} <br>
                            Card Label {{ ($summary->card_label ?? '') }} <br>
                            Country Code {{ ($summary->country_code ?? '') }} <br>
                            Paid at {{ ($summary->paid_at ?? '') }} <br>
                        </p>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID#</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Description</th>
                            <th>Created</th>
                            <th>Updated</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ ($summary->payment_id ?? '') }}</td>
                            <td>{{ ($summary->currency ?? '') }} {{ $transaction->amount }}</td>
                            <td>{{ ($summary->payment_method ?? '') }}</td>
                            <td>{{ $transaction->description }}</td>
                            <td>{{ $transaction->created_at }}</td>
                            <td>{{ ($transaction->updated_at ?? 'N/A') }}</td>
                        </tr>
                        </tbody>
                        <tfoot style="background-color: #f2f2f2;">
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                Total: {{ ($summary->currency ?? '') }} {{ ($summary->amount ?? '') }}/-
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div style="border: 1px solid #f2f2f2; border-radius: 4px; padding: 10px; float: right; width: 40%;">
                        <h4>
                            <?php
                            switch ($transaction->transaction_status) {
                                case 1:
                                    echo 'Approved';
                                    break;
                                case 0:
                                    echo 'Pending';
                                    break;
                                case 2:
                                    echo 'Rejected';
                                    break;
                            }
                            ?>
                        </h4>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>