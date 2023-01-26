@php
    $bestelnummer = $record->bestelnummer;
    $datas = DB::table('bol_data')->select("id", "EAN", "aantal", "producttitel", "prijs", "referentie")->where('bestelnummer', $bestelnummer)->get()->toArray();
        $bedrijfsnaam_verzending = $record->bedrijfsnaam_verzending;
        $today_date = date("Y-m-d H:i:s");
        $invoice_id = \DB::table('bol_data_invoice')->insertGetId([
                'date' => $today_date,
                'bestelnummer' => $bestelnummer
            ]);

        $emailadres = $record->emailadres;
        $besteldt = $record->besteldatum;
        $exp_datum = explode("T", $besteldt);
        $dt = date("d-m-Y");
        $besteldatum = $exp_datum[0];

        $aanhef_verzending = $record->aanhef_verzending;

        // first name
        $voornaam_verzending=$record->voornaam_verzending;
                        // sur name
                        $achternaam_verzending=$record->achternaam_verzending;

                        // street name
                        $adres_verz_straat=$record->adres_verz_straat;

                        // house number
                        $adres_verz_huisnummer=$record->adres_verz_huisnummer;

                        // house extended number
                        $adres_verz_huisnummer_toevoeging=$record->adres_verz_huisnummer_toevoeging;

                        // extra addresss information
                        $adres_verz_toevoeging=$record->adres_verz_toevoeging;

                        // zipcode
                        $postcode_verzending=$record->postcode_verzending;

                        // city
                        $woonplaats_verzending=$record->woonplaats_verzending;

                        // landcode
                        $land_verzending=$record->land_verzending;

                        // trackerCode
                        $trackerCode=$record->trackerCode;
    $user_id = \Auth::id();
    $address = \DB::table('bussiness_address')->where('register_id',$user_id)->first();
@endphp
        <!DOCTYPE html>
<html>
<head>
    <title>packing list</title>
    <link rel="stylesheet" href="{{asset('dhl/css/pdfstyle.css')}}" media="all" />
    <style>
        tr.border_top th {
            padding: 7px !important;
            background-color: #B3E6FF;
        }
    </style>
</head>
<body>

@if ($preview->type == 'pp1')
    <header class="clearfix">
        <div id="logo">
            @if ($preview->logo_1)
                <img src="{{ asset('images/'.$preview->logo_1) }}" width="120px" style="margin-right:80px"/>
            @else
                <img src="{{ asset('dhl/images/Homee For your comforts-2.jpg') }}" width="120px"
                     style="margin-right:80px"/>
            @endif
        </div>
        <div style="float:left; padding-top:30px">
            <h2 class="" style="font-weight: bold; font-style: italic"> Bedankt voor je bestelling</h2>
        </div>
        <div id="logo2">
            @if ($preview->logo_2)
                <img src="{{ asset('images/'.$preview->logo_2) }}" width="150"/>
            @else
                <img src="{{ asset('dhl/images/bol_logo-2.png') }}" width="200"/>
            @endif
        </div>
    </header>
@elseif ($preview->type == 'pp2')
    <header class="clearfix">
        <div id="logo">
            @if ($preview->logo_1)
                <img src="{{ asset('images/'.$preview->logo_1) }}" width="120px" style="margin-right:80px"/>
            @else
                <img src="{{ asset('dhl/images/Homee For your comforts-2.jpg') }}" width="120px"
                     style="margin-right:80px"/>
            @endif
            <br>
            @if ($preview->logo_2)
                <img src="{{ asset('images/'.$preview->logo_2) }}" width="150"/>
            @else
                <img src="{{ asset('dhl/images/bol_logo-2.png') }}" width="200"/>
            @endif

        </div>
        <h1 class="title01"></h1>
        <div id="logo2">
            <h2 class="" style="font-weight: bold; font-style: italic"> Bedankt voor je bestelling</h2>
        </div>
    </header>
@elseif ($preview->type == 'pp3')
    <header class="clearfix">
        <div id="logo">
            <h2 class="" style="font-weight: bold; font-style: italic"> Bedankt voor je bestelling</h2>
        </div>
        <div id="logo2">
            @if ($preview->logo_1)
                <img src="{{ asset('images/'.$preview->logo_1) }}" width="120px" style="margin-right:80px"/>
            @else
                <img src="{{ asset('dhl/images/Homee For your comforts-2.jpg') }}" width="120px"
                     style="margin-right:80px"/>
            @endif
            <br>
            @if ($preview->logo_2)
                <img src="{{ asset('images/'.$preview->logo_2) }}" width="150"/>
            @else
                <img src="{{ asset('dhl/images/bol_logo-2.png') }}" width="200"/>
            @endif

        </div>
    </header>
@elseif ($preview->type == 'pp4')
    <header class="clearfix">
        <div id="logo">
            @if ($preview->logo_1)
                <img src="{{ asset('images/'.$preview->logo_1) }}" width="120px" style="margin-right:80px"/>
            @else
                <img src="{{ asset('dhl/images/Homee For your comforts-2.jpg') }}" width="120px"
                     style="margin-right:80px"/>
            @endif
        </div>
        <div id="logo2">
            @if ($preview->logo_2)
                <img src="{{ asset('images/'.$preview->logo_2) }}" width="150"/>
            @else
                <img src="{{ asset('dhl/images/bol_logo-2.png') }}" width="200"/>
            @endif
        </div>
    </header>
    <h2 class="" style="width: 480px; font-weight: bold; font-style: italic"> Bedankt voor je bestelling</h2>
@endif
<div id="details" class="clearfix">
    <div id="client" style="width: 60%; padding-top:10px"><br>
        Bestelnummer: {{ $bestelnummer }}<br/>
        Geadresseerde email: <br> {{ $emailadres }}<br/>
        <b>Verzenddatum: {{ date("d-m-Y", strtotime($besteldatum)) }}</b><br/>
    </div>
    <div id="invoice" style="width: 30%; float: left;"><br/>
        Aan: <h2 class="name3"> {{ $voornaam_verzending }} {{ $achternaam_verzending }}</h2>
        {{ $adres_verz_straat }} {{ $adres_verz_huisnummer }}<br/>
        @if($adres_verz_huisnummer_toevoeging && $adres_verz_toevoeging)
            {{ $adres_verz_huisnummer_toevoeging }}  {{ $adres_verz_toevoeging }}<br/>
        @endif
        {{ $adres_verz_huisnummer_toevoeging }} {{ $adres_verz_toevoeging }}
        {{ $postcode_verzending }} {{ $woonplaats_verzending }}<br/>
        {{ $land_verzending }}
    </div>
</div>
<h2 class="name2" style="padding-top:30px; padding-bottom:10px; margin-bottom: 10px;">Pakbon</h2>
<table cellspacing="0" cellpadding="0" style="margin-top:5px" class="packing_list">
    <thead>
    <tr class="border_top">

        <th class="unit" width="25%" style="text-align: left">EANcode | Artikelcode</th>
        <th class="unit" width="10%" style="text-align: left">Aantal</th>
        <th class="desc" width="50%" style="text-align: left">Productomschrijving</th>
        <th class="unit" width="12%" style="text-align: left; padding-left:20px">Reference</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($datas as $value) {
    $EAN = $value->EAN;
    $aantal = $value->aantal;
    $producttitel = $value->producttitel;
    $referentie = $value->referentie;
    ?>
    <tr>
        <td class="" width="25%" style="text-align: left">{{ $EAN }}</td>
        <td style="text-align: center" width="10%">{{ $aantal }}</td>
        <td class="" width="50%" style="text-align: left">{{ $producttitel }}</td>
        <td class="" width="12%" style="text-align: left; padding-left:20px">{{ $referentie }}</td>
    </tr>
    <?php
    }
    $tnt = count($datas);
    $totalheight = 340;
    $minheight = $tnt * 40;
    $fheight = $totalheight - $minheight;
    ?>
    </tbody>
</table>

<div style="height: 250px;"></div>

<div>{!! $preview->body_text !!}</div>

<table border="0" cellspacing="0" cellpadding="0" class="packing_list">
    <tr class="border_top">
        <th class="desc">Heb je gevonden wat je zocht?</th>
        <th class="desc"></th>
        <th class="desc" style="text-align:right"> homee.nl</th>
    </tr>
</table>

<div id="notices" style="padding-top:10px">

    <div class="notice">
        <div class="contactus" style="width:42%">
            <div class="name" style="color: blue;padding-bottom:3px">
                Unikoop HomeShopping B.V.
            </div>
            <div class="to">{{ $address->street }}</div>
            <div class="to">{{ $address->postcode }} {{ $address->city_town }} | {{ $address->country }}</div>
        </div>
        <div class="contactus" style="width:40%">
            <div class="to">T: {{ $address->phonenumber }}</div>
            <div class="to">F: {{ $address->workphone }}</div>
        </div>
        <div class="contactus">
            <div class="to">{{ $address->email_admin }}</div>
            <div class="to">{{ $address->email_sales }}</div>
        </div>
    </div>
</div>

<div style="clear:both;"></div>

<hr style="">
<table border="0" cellspacing="0" cellpadding="0" width="100%">
    <tr>
        @if ($preview->footer_logos)
            @php
                $logos = explode(",",$preview->footer_logos);
            @endphp
            @foreach ($logos as $record => $value)
                <th class="desc" width="20%">
                    <img src="{{ asset('images/'.$value) }}" width="120"/>
                </th>
            @endforeach
        @else
            <th class="desc" width="20%">
                <img src="{{ asset('dhl/images/homee_logo-2.jpg') }}" width="120"/>
            </th>
            <th class="desc" width="20%">
                <img src="{{ asset('dhl/images/Lalouchi SINCE 1986-2.jpg') }}" width="150"/>
            </th>
            <th width="20%" class="desc" style="text-align:center">
                <img src="{{ asset('dhl/images/organic-2.jpg') }}" width="120"/>
            </th>
            <th class="desc" width="20%">
                <img src="{{ asset('dhl/images/Ellaa Cosmetische Argon Olie-2.jpg') }}" width="120"/>
            </td>
            <th width="20%" class="desc">
                <img src="{{ asset('dhl/images/La Tulipe Noire-2.jpg') }}" width="200" height="50"/>
            </th>
        @endif
    </tr>
</table>
<div class="clear:both;"></div>
</body>
</html>