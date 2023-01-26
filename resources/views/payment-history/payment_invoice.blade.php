<!DOCTYPE html>
<html>
<head>
    @php
        $settings = \DB::table('website_settings')->first();
    @endphp
    <title>Payment Invoice | {{$settings->site_title}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="{{ asset('dhl/css/bootstrap.min.css') }}">
    <link href="{{ asset('dhl/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dhl/font-awesome/css/font-awesome.min.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700' rel='stylesheet' type='text/css'>
</head>
<body style="background-color: #fff;">
<div class="container">
    <div class="panel">
        <div>
            <div class="row" style="margin-top: 8px;">
                <div class="col-md-12">
                    <img src="{{ asset('portal/'.$settings->site_logo) }}" style="width: 250px; margin-top: 20px;">
                    <div style="float: right;">
                        <h2>
                            Transaction #{{ $transaction->id }}
                        </h2>
                        <p>Created: {{ \Carbon\Carbon::make($transaction->created_at)->toFormattedDateString() }}</p>
                    </div>
                </div>
            </div>
            <hr style="border-top: 3px solid #eee;">
            <div class="row">
                <div class="col-md-12">
                    <h5 style="font-weight: 700;">
                        User Details:
                    </h5>
                    <p>
                        {{ Auth::user()->username }} <br>
                        {{ Auth::user()->email }} <br>
                        {{ Auth::user()->contact_info }} <br>
                    </p>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th height="30">ID#</th>
                            <th height="30">BestelNummer</th>
                            <th height="30">Voornaam</th>
                            <th height="30">Achternaam</th>
                            <th height="30">Tracker Code</th>
                            <th height="30">Logistiek</th>
                            <th height="30">Prijis</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $orders = explode(",",$transaction->orders);
                            $labels = \DB::table('bol_data')
                            ->select('id','producttitel','bestelnummer','voornaam_verzending','achternaam_verzending','trackerCode','logistiek','price_charged')
                            ->WhereIn('id',$orders)
                            ->get();
                        @endphp
                        @foreach ($labels as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->bestelnummer }}</td>
                                <td>{{ $order->voornaam_verzending }}</td>
                                <td>{{ $order->achternaam_verzending }}</td>
                                <td>{{ $order->trackerCode }}</td>
                                <td>{{ $order->logistiek }}</td>
                                <td>
                                    @if($order->price_charged)
                                    &euro;{{ number_format($order->price_charged,2) }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr class="text-center">
                            <td colspan="7">
                                Total: &euro;{{ number_format($transaction->amount,2) }}/-
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>