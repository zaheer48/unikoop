{{-- @extends('layouts.app')
@section('title', 'Preview Product  | Unikoop')
@section('content') --}}
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Preview | Unikoop</title>
        <style>
            .alert-info {
                color: #31708f;
                background-color: #d9edf7;
                border-color: #bce8f1;
            }

            .alert {
                padding: 15px;
                margin-bottom: 20px;
                border: 1px solid transparent;
                border-radius: 4px;
            }
        </style>
    </head>
    <body>




                @if($preview->as_complete != 1)
                    <p class="alert alert-info">
                        You are viewing default template design please configure your own by editing template.
                    </p>
                    @else
                    <p class="alert alert-info">
                        You are viewing configured template design.
                    </p>
                @endif
            @if ($preview->type == 'IP1')
                <!-- Preview 1 -->
                <header class="clearfix">
                    <div id="logo">
                        @if ($preview->logo_1)
                            <img src="{{ asset('images/'.$preview->logo_1) }}" width="120px" style="margin-right:80px"/>
                        @else
                            <img src="{{ asset('dhl/images/Homee For your comforts-2.jpg') }}" width="120px"/>
                        @endif
                    </div>
                    <h1 class="title01"> FACTUUR</h1>
                    <div id="logo2">
                        @if ($preview->logo_2)
                            <img src="{{ asset('images/'.$preview->logo_2) }}" width="150"/>
                        @else
                            <img src="{{ asset('dhl/images/bol_logo-2.png') }}" width="200"/>
                        @endif
                    </div>
                </header>
                <div id="details" class="clearfix">
                    <div id="client" style=" width:50% ; float:left;  margin-top:62px">
                        <span class="inv_list">Factuurnummmer: </span><span class="inv_list">00000000</span> <br/>
                        <span class="inv_list">Klantnummer: </span><span class="inv_list">0000000000</span><br/>
                        <span class="inv_list">Bestelnummer: </span><span class="inv_list"></span><br/>
                        <span class="inv_list">Geleverd door:</span><span class="inv_list">Parcel</span><br/>
                        <span class="inv_list">Track & Tracé:</span><span class="inv_list">3251322980500000</span><br/>
                        <span class="inv_list">Datum :</span><span class="inv_list">03-10-2019</span> <br/>
                    </div>
                    <div id="invoice" style="float:left;">
                    </div>
                </div>
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
                    <tr>
                        <td class="unit" width="12%" style="vertical-align: top;text-align:left">8718047</td>
                        <td class="desc" width="42%" style="vertical-align: top;text-align:left">Homéé - Waszak</td>
                        <td class="unit" width="7%" style="vertical-align: top;">2</td>
                        <td class="unit" width="7%" style="vertical-align: top;">16.49</td>
                        <td class="unit" width="7%" style="vertical-align: top;">32.98</td>
                        <td width="5%" class="unit" style="vertical-align: top;">2</td>
                    </tr>
                    @php
                        $bar_image_value=number_format((float)2500, 2, '.', '');
                        $data="data:image/png;base64," . DNS1D::getBarcodePNG($bar_image_value, "C128");
                    @endphp
                    </tbody>
                </table>
                <div style="height: 100px;"></div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr>
                        <th style="padding-top:20px; padding-bottom:20px" colspan="4">
                            <h2 style="margin-left: auto; float: left;">Gaarne bij vermelden: 51919/</h2></th>
                        <th style="padding-top:10px; padding-bottom:10px" colspan="2">
                            <img src="{{ $data }}" width="130" style="float:right; margin-right: 4px"/>
                        </th>
                    </tr>
                    <tr>
                        <th class="desc">btw &nbsp; &nbsp; %</th>
                        <th class="desc">btw &nbsp; Grondslag</th>
                        <th class="desc">BTW bedrag</th>
                        <td class="desc"></td>
                        <td class="desc" style="width:150px !imported;">Excl. BTW voor korting</td>
                        <td class="desc" style="text-align:right;">0.00</td>

                    </tr>
                    <tr>
                        <td class="desc">1 &nbsp; &nbsp; 0,000</td>
                        <td class="desc">0.00</td>
                        <td class="desc">0.00</td>
                        <td class="desc"></td>
                        <td class="desc">Factuurkorting %</td>
                        <td class="desc" style="text-align:right;"> 00,00<br>
                            <hr style="border-color:grey">
                        </td>
                    </tr>
                    <tr>
                        <td class="desc">1 &nbsp; &nbsp; 0,000</td>
                        <td class="desc">0.00</td>
                        <td class="desc">0.00</td>
                        <td class="desc"></td>
                        <td class="desc">Excl. BTW na korting</td>
                        <td class="desc" style="text-align:right;">0.00</td>
                    </tr>
                    <tr>
                        <td class="desc">2 &nbsp; &nbsp; 21,00</td>
                        <td class="desc">25.00</td>
                        <td class="desc">25.00</td>
                        <td class="desc"></td>
                        <td class="desc">Totaal BTW</td>
                        <td class="desc" style="text-align:right;">25.00<br>
                            <hr style="border-color:grey">
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table border="0" cellspacing="0" cellpadding="0" class="my-3">
                    <tr>
                        <th class="desc" style="color:blue" width="66%">Unikoop HomeShopping B.V.
                        </td>
                        <th class="desc" width="29%">Te betalen €</th>
                        <th class="desc" style="text-align:right;">25.00</th>
                    </tr>
                </table>
                <hr style="margin-top:-10px">
                <table border="0" cellspacing="0" cellpadding="0" width="100%" style="font-size:8px;">
                    <tr>
                        <td width="105px !important">
                            <div><b>Westpoort 2727</b></div>
                            <div>Schakelstraat 13/15</div>
                            <div>1014 AW AMSTERDAM | NL</div>
                        </td>
                        <td width="85px !important">
                            <div><br></div>
                            <div>T: +31 20 303 88 50</div>
                            <div>F: +31 20 684 10 73</div>
                        </td>
                        <td width="75px !important">
                            <div><br></div>
                            <div>info@unikoop.com</div>
                            <div>www.unikoop.com</div>
                        </td>
                        <td width="120px !important">
                            <div><br></div>
                            <div class="to">KvK 34.15.98.32 to Amsterdam</div>
                            <div class="to">BTW nr. NL 81.02.24.574 B01</div>
                        </td>
                        <td width="130px !important">
                            <div><b> ABN-AMRO Bank </b></div>
                            <div class="to">IBAN: NL 77 ABNA 0623 3875 22</div>
                            <div class="to">BIC: ABNANL2A</div>
                        </td>
                        <td width="105px !important">
                            <div class="name"><b>ING Bank</b></div>
                            <div class="to">IBAN: NL23 INGB 0008 3554 77</div>
                            <div class="to">BIC: INGBNL2A</div>
                        </td>

                    </tr>
                </table>
                <div class="clear:both;"></div>
                <hr style="">
                <table border="0" cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                        @if ($preview->footer_logos)
                            @php
                                $logos = explode(",",$preview->footer_logos);
                            @endphp
                            @foreach ($logos as $key => $value)
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

            @elseif (($preview->type == 'IP2'))
                <!-- Preview 2 -->
                <header class="clearfix">
                    <div id="logo">
                        @if ($preview->logo_1)
                            <img src="{{ asset('images/'.$preview->logo_1) }}" width="120px" style="margin-right:80px"/>
                        @else
                            <img src="{{ asset('dhl/images/Homee For your comforts-2.jpg') }}" width="120px"
                                style="margin-right:80px"/>
                        @endif
                    </div>
                    <h1 class="title01"></h1>
                    <div id="logo2">
                        @if ($preview->logo_2)
                            <img src="{{ asset('images/'.$preview->logo_2) }}" width="150"/>
                        @else
                            <img src="{{ asset('dhl/images/bol_logo-2.png') }}" width="200"/>
                        @endif
                    </div>
                </header>
                <br>
                <h1 style="margin: 30px; text-align: center;">FACTUUR</h1>
                <div id="details" class="clearfix">
                    <div id="client" style=" width:50% ; float:left;  margin-top:62px">
                        <span class="inv_list">Factuurnummmer: </span><span class="inv_list">00000000</span> <br/>
                        <span class="inv_list">Klantnummer: </span><span class="inv_list">0000000000</span><br/>
                        <span class="inv_list">Bestelnummer: </span><span class="inv_list"></span><br/>
                        <span class="inv_list">Geleverd door:</span><span class="inv_list">Parcel</span><br/>
                        <span class="inv_list">Track & Tracé:</span><span class="inv_list">3251322980500000</span><br/>
                        <span class="inv_list">Datum :</span><span class="inv_list">03-10-2019</span> <br/>
                    </div>
                    <div id="invoice" style="float:left;">
                    </div>
                </div>
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
                    <tr>
                        <td class="unit" width="12%" style="vertical-align: top;text-align:left">8718047</td>
                        <td class="desc" width="42%" style="vertical-align: top;text-align:left">Homéé - Waszak</td>
                        <td class="unit" width="7%" style="vertical-align: top;">2</td>
                        <td class="unit" width="7%" style="vertical-align: top;">16.49</td>
                        <td class="unit" width="7%" style="vertical-align: top;">32.98</td>
                        <td width="5%" class="unit" style="vertical-align: top;">2</td>
                    </tr>
                    @php
                        $bar_image_value=number_format((float)2500, 2, '.', '');
                        $data="data:image/png;base64," . DNS1D::getBarcodePNG($bar_image_value, "C128");
                    @endphp
                    </tbody>
                </table>
                <div style="height: 100px;"></div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr>
                        <th style="padding-top:20px; padding-bottom:20px" colspan="4">
                            <h2 style="margin-left: auto; float: left;">Gaarne bij vermelden: 51919/</h2></th>
                        <th style="padding-top:10px; padding-bottom:10px" colspan="2">
                            <img src="{{ $data }}" width="130" style="float:right; margin-right: 4px"/>
                        </th>
                    </tr>
                    <tr>
                        <th class="desc">btw &nbsp; &nbsp; %</th>
                        <th class="desc">btw &nbsp; Grondslag</th>
                        <th class="desc">BTW bedrag</th>
                        <td class="desc"></td>
                        <td class="desc" style="width:150px !important;">Excl. BTW voor korting</td>
                        <td class="desc" style="text-align:right;">0.00</td>

                    </tr>
                    <tr>
                        <td class="desc">1 &nbsp; &nbsp; 0,000</td>
                        <td class="desc">0.00</td>
                        <td class="desc">0.00</td>
                        <td class="desc"></td>
                        <td class="desc">Factuurkorting %</td>
                        <td class="desc" style="text-align:right;"> 00,00<br>
                            <hr style="border-color:grey">
                        </td>
                    </tr>
                    <tr>
                        <td class="desc">1 &nbsp; &nbsp; 0,000</td>
                        <td class="desc">0.00</td>
                        <td class="desc">0.00</td>
                        <td class="desc"></td>
                        <td class="desc">Excl. BTW na korting</td>
                        <td class="desc" style="text-align:right;">0.00</td>
                    </tr>
                    <tr>
                        <td class="desc">2 &nbsp; &nbsp; 21,00</td>
                        <td class="desc">25.00</td>
                        <td class="desc">25.00</td>
                        <td class="desc"></td>
                        <td class="desc">Totaal BTW</td>
                        <td class="desc" style="text-align:right;">25.00<br>
                            <hr style="border-color:grey">
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <th class="desc" style="color:blue" width="66%">Unikoop HomeShopping B.V.
                        </td>
                        <th class="desc" width="29%">Te betalen €</th>
                        <th class="desc" style="text-align:right;">25.00</th>
                    </tr>
                </table>
                <hr style="margin-top:-10px">
                <table border="0" cellspacing="0" cellpadding="0" width="100%" style="font-size:8px;">
                    <tr>
                        <td width="105px !important">
                            <div><b>Westpoort 2727</b></div>
                            <div>Schakelstraat 13/15</div>
                            <div>1014 AW AMSTERDAM | NL</div>
                        </td>
                        <td width="85px !important">
                            <div><br></div>
                            <div>T: +31 20 303 88 50</div>
                            <div>F: +31 20 684 10 73</div>
                        </td>
                        <td width="75px !important">
                            <div><br></div>
                            <div>info@unikoop.com</div>
                            <div>www.unikoop.com</div>
                        </td>
                        <td width="120px !important">
                            <div><br></div>
                            <div class="to">KvK 34.15.98.32 to Amsterdam</div>
                            <div class="to">BTW nr. NL 81.02.24.574 B01</div>
                        </td>
                        <td width="130px !important">
                            <div><b> ABN-AMRO Bank </b></div>
                            <div class="to">IBAN: NL 77 ABNA 0623 3875 22</div>
                            <div class="to">BIC: ABNANL2A</div>
                        </td>
                        <td width="105px !important">
                            <div class="name"><b>ING Bank</b></div>
                            <div class="to">IBAN: NL23 INGB 0008 3554 77</div>
                            <div class="to">BIC: INGBNL2A</div>
                        </td>

                    </tr>
                </table>
                <div class="clear:both;"></div>
                <hr style="">
                <table border="0" cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                        @if ($preview->footer_logos)
                            @php
                                $logos = explode(",",$preview->footer_logos);
                            @endphp
                            @foreach ($logos as $key => $value)
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

            @elseif($preview->type == 'IP3')
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
                    <div id="logo2">
                        <h1 class="title01"> FACTUUR</h1>
                    </div>
                </header>
                <div id="details" class="clearfix">
                    <div id="client" style=" width:50% ; float:left;  margin-top:62px">
                        <span class="inv_list">Factuurnummmer: </span><span class="inv_list">00000000</span> <br/>
                        <span class="inv_list">Klantnummer: </span><span class="inv_list">0000000000</span><br/>
                        <span class="inv_list">Bestelnummer: </span><span class="inv_list"></span><br/>
                        <span class="inv_list">Geleverd door:</span><span class="inv_list">Parcel</span><br/>
                        <span class="inv_list">Track & Tracé:</span><span class="inv_list">3251322980500000</span><br/>
                        <span class="inv_list">Datum :</span><span class="inv_list">03-10-2019</span> <br/>
                    </div>
                    <div id="invoice" style="float:left;">
                    </div>
                </div>
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
                    <tr>
                        <td class="unit" width="12%" style="vertical-align: top;text-align:left">8718047</td>
                        <td class="desc" width="42%" style="vertical-align: top;text-align:left">Homéé - Waszak</td>
                        <td class="unit" width="7%" style="vertical-align: top;">2</td>
                        <td class="unit" width="7%" style="vertical-align: top;">16.49</td>
                        <td class="unit" width="7%" style="vertical-align: top;">32.98</td>
                        <td width="5%" class="unit" style="vertical-align: top;">2</td>
                    </tr>
                    @php
                        $bar_image_value=number_format((float)2500, 2, '.', '');
                        $data="data:image/png;base64," . DNS1D::getBarcodePNG($bar_image_value, "C128");
                    @endphp
                    </tbody>
                </table>
                <div style="height: 100px;"></div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr>
                        <th style="padding-top:20px; padding-bottom:20px" colspan="4">
                            <h2 style="margin-left: auto; float: left;">Gaarne bij vermelden: 51919/</h2></th>
                        <th style="padding-top:10px; padding-bottom:10px" colspan="2">
                            <img src="{{ $data }}" width="130" style="float:right; margin-right: 4px"/>
                        </th>
                    </tr>

                    <tr>
                        <th class="desc">btw &nbsp; &nbsp; %</th>
                        <th class="desc">btw &nbsp; Grondslag</th>
                        <th class="desc">BTW bedrag</th>
                        <td class="desc"></td>
                        <td class="desc" style="width:150px !imported;">Excl. BTW voor korting</td>
                        <td class="desc" style="text-align:right;">0.00</td>

                    </tr>

                    <tr>
                        <td class="desc">1 &nbsp; &nbsp; 0,000</td>
                        <td class="desc">0.00</td>
                        <td class="desc">0.00</td>
                        <td class="desc"></td>
                        <td class="desc">Factuurkorting %</td>
                        <td class="desc" style="text-align:right;"> 00,00<br>
                            <hr style="border-color:grey">
                        </td>
                    </tr>
                    <tr>
                        <td class="desc">1 &nbsp; &nbsp; 0,000</td>
                        <td class="desc">0.00</td>
                        <td class="desc">0.00</td>
                        <td class="desc"></td>
                        <td class="desc">Excl. BTW na korting</td>
                        <td class="desc" style="text-align:right;">0.00</td>
                    </tr>
                    <tr>
                        <td class="desc">2 &nbsp; &nbsp; 21,00</td>
                        <td class="desc">25.00</td>
                        <td class="desc">25.00</td>
                        <td class="desc"></td>
                        <td class="desc">Totaal BTW</td>
                        <td class="desc" style="text-align:right;">25.00<br>
                            <hr style="border-color:grey">
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <th class="desc" style="color:blue" width="66%">Unikoop HomeShopping B.V.
                        </td>
                        <th class="desc" width="29%">Te betalen €</th>
                        <th class="desc" style="text-align:right;">25.00</th>
                    </tr>
                </table>
                <hr style="margin-top:-10px">
                <table border="0" cellspacing="0" cellpadding="0" width="100%" style="font-size:8px;">
                    <tr>
                        <td width="105px !important">
                            <div><b>Westpoort 2727</b></div>
                            <div>Schakelstraat 13/15</div>
                            <div>1014 AW AMSTERDAM | NL</div>
                        </td>
                        <td width="85px !important">
                            <div><br></div>
                            <div>T: +31 20 303 88 50</div>
                            <div>F: +31 20 684 10 73</div>
                        </td>
                        <td width="75px !important">
                            <div><br></div>
                            <div>info@unikoop.com</div>
                            <div>www.unikoop.com</div>
                        </td>
                        <td width="120px !important">
                            <div><br></div>
                            <div class="to">KvK 34.15.98.32 to Amsterdam</div>
                            <div class="to">BTW nr. NL 81.02.24.574 B01</div>
                        </td>
                        <td width="130px !important">
                            <div><b> ABN-AMRO Bank </b></div>
                            <div class="to">IBAN: NL 77 ABNA 0623 3875 22</div>
                            <div class="to">BIC: ABNANL2A</div>
                        </td>
                        <td width="105px !important">
                            <div class="name"><b>ING Bank</b></div>
                            <div class="to">IBAN: NL23 INGB 0008 3554 77</div>
                            <div class="to">BIC: INGBNL2A</div>
                        </td>

                    </tr>
                </table>
                <div class="clear:both;"></div>
                <hr style="">
                <table border="0" cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                        @if ($preview->footer_logos)
                            @php
                                $logos = explode(",",$preview->footer_logos);
                            @endphp
                            @foreach ($logos as $key => $value)
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

            @elseif ($preview->type == 'IP4')
                <header class="clearfix">
                    <div id="logo">
                        <h1 style="margin-left: 20px; margin-top: 20px;">FACTUUR</h1>
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
                <div id="details" class="clearfix">
                    <div id="client" style=" width:50% ; float:left;  margin-top:62px">
                        <span class="inv_list">Factuurnummmer: </span><span class="inv_list">00000000</span> <br/>
                        <span class="inv_list">Klantnummer: </span><span class="inv_list">0000000000</span><br/>
                        <span class="inv_list">Bestelnummer: </span><span class="inv_list"></span><br/>
                        <span class="inv_list">Geleverd door:</span><span class="inv_list">Parcel</span><br/>
                        <span class="inv_list">Track & Tracé:</span><span class="inv_list">3251322980500000</span><br/>
                        <span class="inv_list">Datum :</span><span class="inv_list">03-10-2019</span> <br/>
                    </div>
                    <div id="invoice" style="float:left;">
                    </div>
                </div>
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
                    <tr>
                        <td class="unit" width="12%" style="vertical-align: top;text-align:left">8718047</td>
                        <td class="desc" width="42%" style="vertical-align: top;text-align:left">Homéé - Waszak</td>
                        <td class="unit" width="7%" style="vertical-align: top;">2</td>
                        <td class="unit" width="7%" style="vertical-align: top;">16.49</td>
                        <td class="unit" width="7%" style="vertical-align: top;">32.98</td>
                        <td width="5%" class="unit" style="vertical-align: top;">2</td>
                    </tr>
                    @php
                        $bar_image_value=number_format((float)2500, 2, '.', '');
                        $data="data:image/png;base64," . DNS1D::getBarcodePNG($bar_image_value, "C128");
                    @endphp
                    </tbody>
                </table>
                <div style="height: 100px;"></div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr>
                        <th style="padding-top:20px; padding-bottom:20px" colspan="4">
                            <h2 style="margin-left: auto; float: left;">Gaarne bij vermelden: 51919/</h2></th>
                        <th style="padding-top:10px; padding-bottom:10px" colspan="2">
                            <img src="{{ $data }}" width="130" style="float:right; margin-right: 4px"/>
                        </th>
                    </tr>
                    <tr>
                        <th class="desc">btw &nbsp; &nbsp; %</th>
                        <th class="desc">btw &nbsp; Grondslag</th>
                        <th class="desc">BTW bedrag</th>
                        <td class="desc"></td>
                        <td class="desc" style="width:150px !imported;">Excl. BTW voor korting</td>
                        <td class="desc" style="text-align:right;">0.00</td>

                    </tr>
                    <tr>
                        <td class="desc">1 &nbsp; &nbsp; 0,000</td>
                        <td class="desc">0.00</td>
                        <td class="desc">0.00</td>
                        <td class="desc"></td>
                        <td class="desc">Factuurkorting %</td>
                        <td class="desc" style="text-align:right;"> 00,00<br>
                            <hr style="border-color:grey">
                        </td>
                    </tr>
                    <tr>
                        <td class="desc">1 &nbsp; &nbsp; 0,000</td>
                        <td class="desc">0.00</td>
                        <td class="desc">0.00</td>
                        <td class="desc"></td>
                        <td class="desc">Excl. BTW na korting</td>
                        <td class="desc" style="text-align:right;">0.00</td>
                    </tr>
                    <tr>
                        <td class="desc">2 &nbsp; &nbsp; 21,00</td>
                        <td class="desc">25.00</td>
                        <td class="desc">25.00</td>
                        <td class="desc"></td>
                        <td class="desc">Totaal BTW</td>
                        <td class="desc" style="text-align:right;">25.00<br>
                            <hr style="border-color:grey">
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <th class="desc" style="color:blue" width="66%">Unikoop HomeShopping B.V.
                        </td>
                        <th class="desc" width="29%">Te betalen €</th>
                        <th class="desc" style="text-align:right;">25.00</th>
                    </tr>
                </table>
                <hr style="margin-top:-10px">
                <table border="0" cellspacing="0" cellpadding="0" width="100%" style="font-size:8px;">
                    <tr>
                        <td width="105px !important">
                            <div><b>Westpoort 2727</b></div>
                            <div>Schakelstraat 13/15</div>
                            <div>1014 AW AMSTERDAM | NL</div>
                        </td>
                        <td width="85px !important">
                            <div><br></div>
                            <div>T: +31 20 303 88 50</div>
                            <div>F: +31 20 684 10 73</div>
                        </td>
                        <td width="75px !important">
                            <div><br></div>
                            <div>info@unikoop.com</div>
                            <div>www.unikoop.com</div>
                        </td>
                        <td width="120px !important">
                            <div><br></div>
                            <div class="to">KvK 34.15.98.32 to Amsterdam</div>
                            <div class="to">BTW nr. NL 81.02.24.574 B01</div>
                        </td>
                        <td width="130px !important">
                            <div><b> ABN-AMRO Bank </b></div>
                            <div class="to">IBAN: NL 77 ABNA 0623 3875 22</div>
                            <div class="to">BIC: ABNANL2A</div>
                        </td>
                        <td width="105px !important">
                            <div class="name"><b>ING Bank</b></div>
                            <div class="to">IBAN: NL23 INGB 0008 3554 77</div>
                            <div class="to">BIC: INGBNL2A</div>
                        </td>

                    </tr>
                </table>
                <div class="clear:both;"></div>
                <hr style="">
                <table border="0" cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                        @if ($preview->footer_logos)
                            @php
                                $logos = explode(",",$preview->footer_logos);
                            @endphp
                            @foreach ($logos as $key => $value)
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
            @endif
            </div>
        </div>
    </div>
</body>
</html>

