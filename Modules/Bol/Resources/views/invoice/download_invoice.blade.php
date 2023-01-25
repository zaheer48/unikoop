@php

                                                                    
$bestelnummer = $record->bestelnummer;
$datas = DB::table('bol_data')
    ->select('id', 'EAN', 'aantal', 'producttitel', 'prijs', 'referentie')
    ->where('bestelnummer', $bestelnummer)
    ->get()
    ->toArray();
$bedrijfsnaam_verzending = $record->bedrijfsnaam_verzending;
$today_date = date('Y-m-d H:i:s');
$invoice_id = \DB::table('bol_data_invoice')->insertGetId([
    'date' => $today_date,
    'bestelnummer' => $bestelnummer,
]);
$emailadres = $record->emailadres;
$besteldt = $record->besteldatum;
$exp_datum = explode('T', $besteldt);
$dt = date('d-m-Y');
$besteldatum = $exp_datum[0];

$aanhef_verzending = $record->aanhef_verzending;

// first name
$voornaam_verzending = $record->voornaam_verzending;
// sur name
$achternaam_verzending = $record->achternaam_verzending;

// street name
$adres_verz_straat = $record->adres_verz_straat;

// house number
$adres_verz_huisnummer = $record->adres_verz_huisnummer;

// house extended number
$adres_verz_huisnummer_toevoeging = $record->adres_verz_huisnummer_toevoeging;

// extra addresss information
$adres_verz_toevoeging = $record->adres_verz_toevoeging;

// zipcode
$postcode_verzending = $record->postcode_verzending;

// city
$woonplaats_verzending = $record->woonplaats_verzending;

// landcode
$land_verzending = $record->land_verzending;
// trackerCode
// $trackerCode=$record->trackerCode;

$user_id = \Auth::id();
$address = \DB::table('bussiness_address')
    ->where('register_id', $user_id)
    ->first();
@endphp
<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <link rel="stylesheet" href="{{ asset('dhl/css/style_invoice.css') }}" media="all" />
    <style>
        tr.border_top th {
            padding: 7px !important;
            background-color: #B3E6FF;
        }

        header {
            position: fixed;
            top: 0px;
            left: 4%;
            right: 4%;
        }

        #firstDiv {
            position: relative;
            top: 98px;
        }

        #secondDiv {
            position: relative;
            top: 160px;
        }

        #thirdDiv {
            position: relative;
            top: 100px;
        }

        #forthDiv {
            position: relative;
            top: 100px;
        }

        #fifthDiv {
            position: relative;
            top: 100px;
        }

        footer {
            position: fixed;
            bottom: 44px;
            left: 4%;
            right: 4%;
        }

        body {
            margin-left: 4%;
            margin-right: 4%;
        }

    </style>
</head>

<body>

    @if ($preview->type == 'IP1')
        <header class="clearfix">
            <div id="logo">
                @if ($preview->logo_1)
                    <img src="{{ asset('images/' . $preview->logo_1) }}" width="120px" style="margin-right:80px" />
                @else
                    <img src="{{ asset('dhl/images/Homee For your comforts-2.jpg') }}" width="120px"
                        style="margin-right:80px" />
                @endif
            </div>
            <h1 class="title01"> FACTUUR</h1>
            <div id="logo2">
                @if ($preview->logo_2)
                    <img src="{{ asset('images/' . $preview->logo_2) }}" width="150" />
                @else
                    <img src="{{ asset('dhl/images/bol_logo-2.png') }}" width="200" />
                @endif
            </div>
        </header>
    @elseif ($preview->type == 'IP2')
        <header class="clearfix">
            <div id="logo">
                @if ($preview->logo_1)
                    <img src="{{ asset('images/' . $preview->logo_1) }}" width="120px" style="margin-right:80px" />
                @else
                    <img src="{{ asset('dhl/images/Homee For your comforts-2.jpg') }}" width="120px"
                        style="margin-right:80px" />
                @endif
            </div>
            <h1 class="title01"></h1>
            <div id="logo2">
                @if ($preview->logo_2)
                    <img src="{{ asset('images/' . $preview->logo_2) }}" width="150" />
                @else
                    <img src="{{ asset('dhl/images/bol_logo-2.png') }}" width="200" />
                @endif
            </div>
        </header>
        <br>
        <h1 style="margin: 30px; text-align: center;">FACTUUR</h1>
    @elseif ($preview->type == 'IP3')
        <header class="clearfix">
            <div id="logo">
                @if ($preview->logo_1)
                    <img src="{{ asset('images/' . $preview->logo_1) }}" width="120px" style="margin-right:80px" />
                @else
                    <img src="{{ asset('dhl/images/Homee For your comforts-2.jpg') }}" width="120px"
                        style="margin-right:80px" />
                @endif
                <br>
                @if ($preview->logo_2)
                    <img src="{{ asset('images/' . $preview->logo_2) }}" width="150" />
                @else
                    <img src="{{ asset('dhl/images/bol_logo-2.png') }}" width="200" />
                @endif
            </div>
            <div id="logo2">
                <h1 class="title01"> FACTUUR</h1>
            </div>
        </header>
    @elseif ($preview->type == 'IP4')
        <header class="clearfix">
            <div id="logo">
                <h1 style="margin-left: 20px; margin-top: 20px;">FACTUUR</h1>
            </div>
            <div id="logo2">
                @if ($preview->logo_1)
                    <img src="{{ asset('images/' . $preview->logo_1) }}" width="120px" style="margin-right:80px" />
                @else
                    <img src="{{ asset('dhl/images/Homee For your comforts-2.jpg') }}" width="120px"
                        style="margin-right:80px" />
                @endif
                <br>
                @if ($preview->logo_2)
                    <img src="{{ asset('images/' . $preview->logo_2) }}" width="150" />
                @else
                    <img src="{{ asset('dhl/images/bol_logo-2.png') }}" width="200" />
                @endif
            </div>
        </header>
    @endif

    <footer>
        <table border="0" cellspacing="0" cellpadding="0" width="100%">
            <tr>
                @if ($preview->footer_logos)
                    @php
                        $logos = explode(',', $preview->footer_logos);
                    @endphp
                    @foreach ($logos as $record => $value)
                        <th class="desc" width="20%">
                            <img src="{{ asset('images/' . $value) }}" width="120" />
                        </th>
                    @endforeach
                @else
                    <th class="desc" width="20%">
                        <img src="{{ asset('dhl/images/homee_logo-2.jpg') }}" width="120" />
                    </th>
                    <th class="desc" width="20%">
                        <img src="{{ asset('dhl/images/Lalouchi SINCE 1986-2.jpg') }}" width="150" />
                    </th>
                    <th width="20%" class="desc" style="text-align:center">
                        <img src="{{ asset('dhl/images/organic-2.jpg') }}" width="120" />
                    </th>
                    <th class="desc" width="20%">
                        <img src="{{ asset('dhl/images/Ellaa Cosmetische Argon Olie-2.jpg') }}" width="120" />
                        </td>
                    <th width="20%" class="desc">
                        <img src="{{ asset('dhl/images/La Tulipe Noire-2.jpg') }}" width="200" height="50" />
                    </th>
                @endif
            </tr>
        </table>
    </footer>

    <div id="firstDiv">
        <div id="client" style=" width:50% ; margin-top:30px;">
            <span class="inv_list">Factuurnummmer: </span><span class="inv_list">{{ $invoice_id }}</span> <br />
            <span class="inv_list">Klantnummer: </span><span class="inv_list"> </span><br />
            <span class="inv_list">Bestelnummer: </span><span class="inv_list">{{ $bestelnummer }}</span><br />
            {{-- <span class="inv_list">Geleverd door:</span><span class="inv_list"> {{ $record->logistiek }} Parcel  </span><br/> --}}
            {{-- <span class="inv_list">Track & Tracé:</span><span class="inv_list">{{ $trackerCode }}</span> <br/> --}}
            <span class="inv_list">Datum :</span><span
                class="inv_list">{{ date('d-m-Y', strtotime($besteldatum)) }}</span>
            <br />
        </div>
        <div id="invoice">
            @if ($bedrijfsnaam_verzending)
                {{ $bedrijfsnaam_verzending }}<br>
            @endif
            {{ $voornaam_verzending }} <br>
            {{ $achternaam_verzending }}<br>
            {{ $adres_verz_straat }} {{ $adres_verz_huisnummer }}<br>
            @if ($adres_verz_huisnummer_toevoeging && $adres_verz_toevoeging)
                {{ $adres_verz_huisnummer_toevoeging }} {{ $adres_verz_toevoeging }}<br>
            @endif
            {{ $postcode_verzending }} {{ $woonplaats_verzending }}<br>
            {{ $land_verzending }}
        </div>
    </div>
    <br>
    <div style="margin-top: 150px;" id="secondDiv">
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr class="border_top">
                    <th class="unit" width="12%" style="text-align:left">Artikelcode</th>
                    <th class="desc" width="42%" style="text-align:left">Omschrijving</th>
                    <th class="unit" width="7%" style="text-align:left">Aantal</th>
                    <th class="unit" width="7%" style="text-align:left">Stukprijs</th>
                    <th class="unit" width="7%">Totaal</th>
                    <th class="unit" width="5%">Btw</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_btw_all = 0;
                $stukprijs_tot_btw_all = 0;
                $stukprijs_tot_all = 0;
                $height = 0;

                foreach ($datas as $value) {
                $height += 29.6;
                $EAN = $value->EAN;
                $aantal = $value->aantal;
                $producttitel = $value->producttitel;
                $referentie = $value->referentie;
                $prijs_with_btw = $value->prijs;
                $prijs_with_btw = $prijs_with_btw / $aantal;
                $per_121 = 121 / 100;
                $per_21 = 21 / 100;
                // single price (total price / 121%)
                $stukprijs = $prijs_with_btw / $per_121;
                // single price 21% (single price * 21%)
                $single_btw = $stukprijs * $per_21;

                $stukprijs_tot = $stukprijs * $aantal;
                $stukprijs_tot_all += $stukprijs * $aantal;

                $total_btw = $stukprijs_tot * $per_21;
                $total_btw_all += $stukprijs_tot * $per_21;
                $stukprijs_tot_btw = $stukprijs_tot + $total_btw;
                $stukprijs_tot_btw_all += $stukprijs_tot + $total_btw;

                setlocale(LC_MONETARY, 'nl_NL.UTF-8');
                $stukprijs2 = \AppHelper::instance()->money_format2('%(#1n', $stukprijs);

                setlocale(LC_MONETARY, 'nl_NL.UTF-8');
                $stukprijs_tot2 = \AppHelper::instance()->money_format2('%(#1n', $stukprijs_tot);
                ?>
                <tr>
                    <td class="unit" width="12%" style="vertical-align: top;text-align:left">{{ $EAN }}</td>
                    <td class="desc" width="42%" style="vertical-align: top;text-align:left">{{ $producttitel }}</td>
                    <td class="unit" width="7%" style="vertical-align: top;">{{ $aantal }}</td>
                    <td class="unit" width="7%" style="vertical-align: top;">{{ $stukprijs2 }}</td>
                    <td class="unit" width="7%" style="vertical-align: top;">{{ $stukprijs_tot2 }}</td>
                    <td width="5%" class="unit" style="vertical-align: top;">2</td>
                </tr>
                <?php
                }
                $bar_image_value = number_format((float) $stukprijs_tot_btw_all, 2, '.', '');
                $data = 'data:image/png;base64,' . DNS1D::getBarcodePNG($bar_image_value, 'C128');
                [$type, $data] = explode(';', $data);
                [, $data] = explode(',', $data);
                $data = base64_decode($data);
                file_put_contents(public_path() . '/' . 'barcode_image/' . $invoice_id . '.png', $data);
                $tnt = count($datas);
                $totalheight = 525;
                $minheight = $tnt * 40;
                $fheight = $totalheight - $minheight;
                ?>
            </tbody>
        </table>
    </div>
    <?php
        $height = 529.6 - $height;
    ?>
    <div style="height: <?=$height;?>px;"></div>
    <table border="0" cellspacing="0" cellpadding="0" id="thirdDiv">
        <tbody>
            <tr>
                <th style="padding-top:20px; padding-bottom:20px" colspan="4">
                    <h2 style="float: left">
                        Gaarne bij vermelden: 51919/{{ $invoice_id }}
                    </h2>
                </th>
                <th style="padding-top:10px; padding-bottom:10px" colspan="2">
                    <img src="{{ asset('barcode_image/' . $invoice_id . '.png') }}" width="130"
                        style="float:right; margin-right: 4px" />
                </th>
            </tr>
            <tr>
                <th class="desc">btw &nbsp; &nbsp; %</th>
                <th class="desc">btw &nbsp; Grondslag</th>
                <th class="desc">BTW bedrag</th>
                <td class="desc"></td>
                <td class="desc" style="width: 150px !important;">Excl. BTW voor korting</td>
                <td class="desc" style="text-align:right;">{{ number_format((float) $stukprijs_tot_all, 2, '.', '') }}
                </td>
            </tr>
            <tr>
                <td class="desc">0 &nbsp; &nbsp; 0,000</td>
                <td class="desc">0,000</td>
                <td class="desc">00,00</td>
                <td class="desc"></td>
                <td class="desc">Factuurkorting %</td>
                <td class="desc" style="text-align:right;"> 00,00<br>
                    <hr style="border-color:grey">
                </td>
            </tr>
            <tr>
                <td class="desc">1 &nbsp; &nbsp; 0,000</td>
                <td class="desc">0,000</td>
                <td class="desc">00,00</td>
                <td class="desc"></td>
                <td class="desc">Excl. BTW na korting</td>
                <td class="desc" style="text-align:right;">{{ number_format((float) $stukprijs_tot_all, 2, '.', '') }}
                </td>
            </tr>
            <tr>
                <td class="desc">2 &nbsp; &nbsp; 21,00</td>
                <td class="desc">{{ number_format((float) $stukprijs_tot_all, 2, '.', '') }}</td>
                <td class="desc">{{ number_format((float) $total_btw_all, 2, '.', '') }}</td>
                <td class="desc"></td>
                <td class="desc">Totaal BTW</td>
                <td class="desc" style="text-align:right;">{{ number_format((float) $total_btw_all, 2, '.', '') }}<br>
                    <hr style="border-color:grey">
                </td>
            </tr>
        </tbody>
    </table>
    <div id="forthDiv">
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th class="desc" style="color:blue" width="66%">Unikoop HomeShopping B.V.
                    </td>
                <th class="desc" width="29%">Te betalen</th>
                <th class="desc" style="text-align:right;">
                    €{{ number_format((float) $stukprijs_tot_btw_all, 2, '.', '') }}</th>
            </tr>
        </table>
        <hr style="margin-top:-10px">
    </div>
    <div id="fifthDiv">
        <table border="0" cellspacing="0" cellpadding="0" width="100%" style="font-size:8px;">
            <tr>
                <td width="105px !important">
                    <div><b>Westpoort 2727</b></div>
                    <div>{{ $address->street }} {{ $address->h_b_number }}</div>
                    <div>{{ $address->postcode }} {{ $address->city_town }} | {{ $address->country }}</div>
                </td>
                <td width="85px !important">
                    <div><br></div>
                    <div>T: {{ $address->phonenumber }}</div>
                    <div> &nbsp; </div>
                   
                </td>
                <td width="75px !important">
                    <div><br></div>
                    <div>{{ $address->email_sales }}</div>
                    <div>www.unikoop.nl</div>
                </td>
                <td width="120px !important">
                    <div><br></div>
                    <div class="to">KvK 34.15.98.32 to Amsterdam</div>
                    <div class="to">BTW nr. NL 81.02.24.574 B01</div>
                </td>
                @if ($servicebanks === null)
                    <td width="130px !important">
                        <div><b>Bank Name: NOt Set </b></div>
                        <div class="to">IBAN: Not Set</div>
                        <div class="to">BIC: Not Set</div>

                    </td>

                    <td width="105px !important">
                        <div><b>Bank Name: NOt Set </b></div>
                        <div class="to">IBAN: Not Set</div>
                        <div class="to">BIC: Not Set</div>
                    </td>
                @else
                    <td width="130px !important">

                        @if ($servicebanks->bank_name == null)
                            *************
                        @else
                            <div><b> {{ $servicebanks->bank_name }} </b></div>
                        @endif
                        @if (!$servicebanks->iban)
                            Not set
                        @else
                            <div class="to">IBAN: {{ $servicebanks->iban }}</div>
                        @endif
                        @if (!$servicebanks->bic)
                            Not set
                        @else
                            <div class="to">BIC: {{ $servicebanks->bic }}</div>
                        @endif

                    </td>
                    <td width="105px !important">

                        @if ($servicebanks->bank_name == null)
                            *************
                        @else
                            <div class="name"><b>{{ $servicebanks->bank_name_2 }}</b></div>
                        @endif
                        @if (!$servicebanks->iban)
                            Not set
                        @else
                            <div class="to">IBAN: {{ $servicebanks->iban_2 }}</div>
                        @endif
                        @if (!$servicebanks->bic_2)
                            Not set
                        @else
                            <div class="to">BIC: {{ $servicebanks->bic_2 }}</div>
                        @endif
                    </td>
                @endif
            </tr>
        </table>
        <hr>
    </div>

</body>
</html>
