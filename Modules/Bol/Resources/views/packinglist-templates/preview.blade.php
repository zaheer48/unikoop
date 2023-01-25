<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{asset('dhl/css/pdfstyle.css')}}" media="all" />
    <title>Packing list Preview</title></head>
<body>
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
@if($preview->as_complete != 1)
    <p class="alert alert-info">
        You are viewing default template design please configure your own by editing template.
    </p>
@else
    <p class="alert alert-info">
        You are viewing configured template design.
    </p>
@endif
@if ($preview->type == 'pp1')
    <!-- Preview 1 -->
  <header class="clearfix">
        <div id="logo" style="float:left">
            @if ($preview->logo_1)
                <img src="{{ asset('images/'.$preview->logo_1) }}" width="150px" style="margin-right:60px" />
            @else
                <img src="{{asset('dhl/images/Homee For your comforts-2.jpg')}}" width="150px" style="margin-right:60px" />
            @endif
         </div>
         <div style="float:left; padding-top:30px" ><h2 class="" style="width: 480px; font-weight: bold; font-style: italic"> Bedankt voor je bestelling</h2>
         </div>
         <div id="logo2" style="float:right">
             @if ($preview->logo_2)
             <img src="{{ asset('images/'.$preview->logo_2) }}" width="200" style="margin-top: -36px;" />
                 @else
                 <img src="{{asset('dhl/images/bol_logo-2.png')}}" width="200" style="margin-top: -36px;" />
             @endif
        </div>
  </header>

    <div id="details" class="clearfix">
            <div id="client" style="width: 54%; padding-top:10px"><br>
            Bestelnummer: 123456  <br />
            Geadresseerde email:  <br />
            test@gmail.com<br />
            <b>Verzenddatum: 01-09-2020 </b> <br />
            </div>
            <div id="invoice" style="width: 30%" >
            <br /> Aan:
            <h2 class="name3">mr.Saleem</h2>
            Kerklaan  &nbsp; 14<br />
            7951 &nbsp; CD &nbsp; STAPHORST<br />
            NL
       </div>
    </div>
    <h2 class="name2" style="padding-top:30px; padding-bottom:10px">Pakbon</h2>
    <table cellspacing="0" cellpadding="0" style="margin-top:5px" class="packing_list">
        <thead>
        <tr class="border_top">
            <th class="unit" width="25%" style="text-align: left" >EANcode | Artikelcode</th>
            <th class="unit" width="10%" style="text-align: left">Aantal</th>
            <th class="desc" width="50%" style="text-align: left">Productomschrijving</th>
            <th class="unit" width="12%" style="text-align: left; padding-left:20px">Reference</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="" width="25%" style="text-align: left">1234567890234 </td>
            <td style="text-align: center" width="10%">2</td>
            <td class="" width="50%" style="text-align: left">Homéé - Waszak - rood / wit geribbed | 240g.p/m2</td>
            <td class="" width="12%" style="text-align: left; padding-left:20px">P1 R4</td>
        </tr>
     </tbody>
    </table>
    <div style="height: 272px;"></div>
    @if($preview->body_text)
        <div class="row">
            <div class="col-md-12">
            {!! $preview->body_text !!}
        </div>
        </div>
        @else
    <table cellspacing="0" cellpadding="0" class="packing_list">
        <thead>
        <tr>
            <th style="" class="desc"><h2>Retourneren:</h2></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="desc">De retourvoorwaarden vind je hieronder. Waar het op neerkomt, is dat je rustig over je aankoop mag nadenken. Als je artikel geen goede match is, mag je het gratis naar ons terugsturen binnen de zichttermijn.</td>
        </tr>
        <tr>
            <th style="padding-top:20px" class="desc"><h2>Retourvoorwaarden:</h2></th>
        </tr>
        <tr>
            <td  class="desc">1- Je retourneert binnen de zichttermijn van 14 dagen bij Homéé. Kopers van Homéé producten kunnen altijd een retourneren binnen de zicht termijn van 14 dagen. De zichttermijn gaat in op de dag dat jij het artikel ontvangt. Bij aankoop meerdere artikelen in 1 bestelling? Dan de termijn pas ingaat als je alles hebt ontvangen. <br>
                2- Het artikel zit in de originele verpakking.<br>
                3- Kleding en schoenen zijn niet gedragen en het labeltje zit er nog aan.
            </td>
        </tr>

        <tr>
            <th style="padding-top:20px" class="desc"><h2>Artikelen die je niet kunt retourneren:</h2></th>
        </tr>
        <tr >
            <td  class="desc" >1-	Cadeaubonnen en -kaarten<br>
                2-	Producten die geopend zijn, ander worden uit het pakking zijn en niet meer kan verpakt worden zoals het origineel verpakt was en waarvan de verpakking is verbroken
            </td>
        </tr>
        </tbody>
    </table>
    @endif

    <table border="0" cellspacing="0" cellpadding="0" class="packing_list">
        <tr class="border_top">
            <th class="desc">Heb je gevonden wat je zocht?  </th>
            <th class="desc"> </th>
            <th class="desc" style="text-align:right"> homee.nl</th>
        </tr>
    </table>
    <div id="notices" style="padding-top:10px;overflow: hidden;">
        <div class="notice">
            <div class="contactus" style="width:42%">
                <div class="name" style="color: blue;padding-bottom:3px">
                    Unikoop HomeShopping B.V.
                </div>
                <div class="to">Schakelstraat 13/15</div>
                <div class="to">1014 AW AMSTERDAM | NL</div>
            </div>
            <div class="contactus" style="width:40%">
                <div class="to">T: +31 20 303 88 50</div>
                <div class="to">F: +31 20 684 10 73</div>
            </div>
            <div class="contactus" style="width: 23%;float: right;margin-top: -27px;">
                <div class="to">info@unikoop.com</div>
                <div class="to">www.unikoop.com</div>
            </div>
        </div>
    </div>
    <div style="clear:both;"></div>
    <table style="margin-top:50px" border="0" cellspacing="0" cellpadding="0" width="100%" class="packing_list">
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
            <th class="desc" width="20%"><img src="{{asset('dhl/images/homee_logo-2.jpg')}}" width="120"/></th>
            <th class="desc" width="20%"><img src="{{asset('dhl/images/Lalouchi SINCE 1986-2.jpg')}}" width="150"/></th>
            <th width="20%" class="desc" style="text-align:center" ><img src="{{asset('dhl/images/organic-2.jpg')}}" width="120"/></th>
            <th class="desc" width="20%"><img src="{{asset('dhl/images/Ellaa Cosmetische Argon Olie-2.jpg')}}" width="120"/></td>
            <th width="20%" class="desc"> <img src="{{asset('dhl/images/La Tulipe Noire-2.jpg')}}" width="200" height="50" /></th>
            @endif
        </tr>
    </table>
    <div class="clear:both;"></div>

@elseif (($preview->type == 'pp2'))
    <!-- Preview 2 -->
    <header class="clearfix">
        <div id="logo" style="float:left">
            @if ($preview->logo_1)
            <img src="{{ asset('images/'.$preview->logo_1) }}" width="150px" style="margin-right:60px" />
        @else
         <img src="{{asset('dhl/images/Homee For your comforts-2.jpg')}}" width="150px" style="margin-right:60px" />
        @endif
        </div><br>
        <div id="logo2" style="float: left;margin-top: 45px;margin-right: 309px;">
            @if ($preview->logo_2)
                <img src="{{ asset('images/'.$preview->logo_2) }}" width="200" style="margin-top: -36px;" />
            @else
            <img src="{{asset('dhl/images/bol_logo-2.png')}}" width="200" style="margin-top: -36px;" />
                @endif
        </div>
        <div style="float:right; margin-top: -120px;" ><h2 class="" style="font-weight: bold; font-style: italic"> Bedankt voor je bestelling</h2>
        </div>
    </header>

    <div id="details" class="clearfix">
        <div id="client" style="width: 54%; padding-top:10px"><br>
            Bestelnummer: 123456  <br />
            Geadresseerde email:  <br />
            test@gmail.com<br />
            <b>Verzenddatum: 01-09-2020 </b> <br />
        </div>
        <div id="invoice" style="width: 30%" >
            <br /> Aan:
            <h2 class="name3">mr.Saleem</h2>
            Kerklaan  &nbsp; 14<br />
            7951 &nbsp; CD &nbsp; STAPHORST<br />
            NL
        </div>
    </div>
    <h2 class="name2" style="padding-top:30px; padding-bottom:10px">Pakbon</h2>
    <table cellspacing="0" cellpadding="0" style="margin-top:5px" class="packing_list">
        <thead>
        <tr class="border_top">
            <th class="unit" width="25%" style="text-align: left" >EANcode | Artikelcode</th>
            <th class="unit" width="10%" style="text-align: left">Aantal</th>
            <th class="desc" width="50%" style="text-align: left">Productomschrijving</th>
            <th class="unit" width="12%" style="text-align: left; padding-left:20px">Reference</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="" width="25%" style="text-align: left">1234567890234 </td>
            <td style="text-align: center" width="10%">2</td>
            <td class="" width="50%" style="text-align: left">Homéé - Waszak - rood / wit geribbed | 240g.p/m2</td>
            <td class="" width="12%" style="text-align: left; padding-left:20px">P1 R4</td>
        </tr>
        </tbody>
    </table>
    <div style="height: 260px;"></div>
    @if($preview->body_text)
        <div class="row">
            <div class="col-md-12">
                {!! $preview->body_text !!}
            </div>
        </div>
    @else
        <table cellspacing="0" cellpadding="0" class="packing_list">
            <thead>
            <tr>
                <th style="" class="desc"><h2>Retourneren:</h2></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="desc">De retourvoorwaarden vind je hieronder. Waar het op neerkomt, is dat je rustig over je aankoop mag nadenken. Als je artikel geen goede match is, mag je het gratis naar ons terugsturen binnen de zichttermijn.</td>
            </tr>
            <tr>
                <th style="padding-top:20px" class="desc"><h2>Retourvoorwaarden:</h2></th>
            </tr>
            <tr>
                <td  class="desc">1- Je retourneert binnen de zichttermijn van 14 dagen bij Homéé. Kopers van Homéé producten kunnen altijd een retourneren binnen de zicht termijn van 14 dagen. De zichttermijn gaat in op de dag dat jij het artikel ontvangt. Bij aankoop meerdere artikelen in 1 bestelling? Dan de termijn pas ingaat als je alles hebt ontvangen. <br>
                    2- Het artikel zit in de originele verpakking.<br>
                    3- Kleding en schoenen zijn niet gedragen en het labeltje zit er nog aan.
                </td>
            </tr>

            <tr>
                <th style="padding-top:20px" class="desc"><h2>Artikelen die je niet kunt retourneren:</h2></th>
            </tr>
            <tr >
                <td  class="desc" >1-	Cadeaubonnen en -kaarten<br>
                    2-	Producten die geopend zijn, ander worden uit het pakking zijn en niet meer kan verpakt worden zoals het origineel verpakt was en waarvan de verpakking is verbroken
                </td>
            </tr>
            </tbody>
        </table>
    @endif

    <table border="0" cellspacing="0" cellpadding="0" class="packing_list">
        <tr class="border_top">
            <th class="desc">Heb je gevonden wat je zocht?  </th>
            <th class="desc"> </th>
            <th class="desc" style="text-align:right"> homee.nl</th>
        </tr>
    </table>
    <div id="notices" style="padding-top:10px;overflow: hidden;">
        <div class="notice">
            <div class="contactus" style="width:42%">
                <div class="name" style="color: blue;padding-bottom:3px">
                    Unikoop HomeShopping B.V.
                </div>
                <div class="to">Schakelstraat 13/15</div>
                <div class="to">1014 AW AMSTERDAM | NL</div>
            </div>
            <div class="contactus" style="width:40%">
                <div class="to">T: +31 20 303 88 50</div>
                <div class="to">F: +31 20 684 10 73</div>
            </div>
            <div class="contactus" style="width: 23%;float: right;margin-top: -27px;">
                <div class="to">info@unikoop.com</div>
                <div class="to">www.unikoop.com</div>
            </div>
        </div>
    </div>
    <div style="clear:both;"></div>
    <table style="margin-top:50px" border="0" cellspacing="0" cellpadding="0" width="100%" class="packing_list">
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
            <th class="desc" width="20%"><img src="{{asset('dhl/images/homee_logo-2.jpg')}}" width="120"/></th>
            <th class="desc" width="20%"><img src="{{asset('dhl/images/Lalouchi SINCE 1986-2.jpg')}}" width="150"/></th>
            <th width="20%" class="desc" style="text-align:center" ><img src="{{asset('dhl/images/organic-2.jpg')}}" width="120"/></th>
            <th class="desc" width="20%"><img src="{{asset('dhl/images/Ellaa Cosmetische Argon Olie-2.jpg')}}" width="120"/></td>
            <th width="20%" class="desc"> <img src="{{asset('dhl/images/La Tulipe Noire-2.jpg')}}" width="200" height="50" /></th>
        @endif
        </tr>
    </table>
    <div class="clear:both;"></div>

@elseif($preview->type == 'pp3')
    <!-- Preview 3 -->
    <header class="clearfix">
        <div id="logo" style="float:right;margin-top: 73px;">
            @if ($preview->logo_1)
                <img src="{{ asset('images/'.$preview->logo_1) }}" width="150px" style="margin-right:60px"/>
            @else
            <img src="{{asset('dhl/images/Homee For your comforts-2.jpg')}}" width="150px" style="margin-right:60px" />
            @endif
        </div>
        <div id="logo2" style="float:right;margin-right: -207px;">
            @if ($preview->logo_2)
                <img src="{{ asset('images/'.$preview->logo_2) }}" width="200" />
            @else
            <img src="{{asset('dhl/images/bol_logo-2.png')}}" width="200" />
                @endif
        </div>
        <div style="float:left; padding-top:30px" ><h2 class="" style="font-weight: bold; font-style: italic"> Bedankt voor je bestelling</h2>
        </div>
    </header>

    <div id="details" class="clearfix">
        <div id="client" style="width: 54%; padding-top:10px"><br>
            Bestelnummer: 123456  <br />
            Geadresseerde email:  <br />
            test@gmail.com<br />
            <b>Verzenddatum: 01-09-2020 </b> <br />
        </div>
        <div id="invoice" style="width: 30%" >
            <br /> Aan:
            <h2 class="name3">mr.Saleem</h2>
            Kerklaan  &nbsp; 14<br />
            7951 &nbsp; CD &nbsp; STAPHORST<br />
            NL
        </div>
    </div>
    <h2 class="name2" style="padding-top:30px; padding-bottom:10px">Pakbon</h2>
    <table cellspacing="0" cellpadding="0" style="margin-top:5px" class="packing_list">
        <thead>
        <tr class="border_top">
            <th class="unit" width="25%" style="text-align: left" >EANcode | Artikelcode</th>
            <th class="unit" width="10%" style="text-align: left">Aantal</th>
            <th class="desc" width="50%" style="text-align: left">Productomschrijving</th>
            <th class="unit" width="12%" style="text-align: left; padding-left:20px">Reference</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="" width="25%" style="text-align: left">1234567890234 </td>
            <td style="text-align: center" width="10%">2</td>
            <td class="" width="50%" style="text-align: left">Homéé - Waszak - rood / wit geribbed | 240g.p/m2</td>
            <td class="" width="12%" style="text-align: left; padding-left:20px">P1 R4</td>
        </tr>
        </tbody>
    </table>
    <div style="height: 250px;"></div>
    @if($preview->body_text)
        <div class="row">
            <div class="col-md-12">
                {!! $preview->body_text !!}
            </div>
        </div>
    @else
        <table cellspacing="0" cellpadding="0" class="packing_list">
            <thead>
            <tr>
                <th style="" class="desc"><h2>Retourneren:</h2></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="desc">De retourvoorwaarden vind je hieronder. Waar het op neerkomt, is dat je rustig over je aankoop mag nadenken. Als je artikel geen goede match is, mag je het gratis naar ons terugsturen binnen de zichttermijn.</td>
            </tr>
            <tr>
                <th style="padding-top:20px" class="desc"><h2>Retourvoorwaarden:</h2></th>
            </tr>
            <tr>
                <td  class="desc">1- Je retourneert binnen de zichttermijn van 14 dagen bij Homéé. Kopers van Homéé producten kunnen altijd een retourneren binnen de zicht termijn van 14 dagen. De zichttermijn gaat in op de dag dat jij het artikel ontvangt. Bij aankoop meerdere artikelen in 1 bestelling? Dan de termijn pas ingaat als je alles hebt ontvangen. <br>
                    2- Het artikel zit in de originele verpakking.<br>
                    3- Kleding en schoenen zijn niet gedragen en het labeltje zit er nog aan.
                </td>
            </tr>

            <tr>
                <th style="padding-top:20px" class="desc"><h2>Artikelen die je niet kunt retourneren:</h2></th>
            </tr>
            <tr >
                <td  class="desc" >1-	Cadeaubonnen en -kaarten<br>
                    2-	Producten die geopend zijn, ander worden uit het pakking zijn en niet meer kan verpakt worden zoals het origineel verpakt was en waarvan de verpakking is verbroken
                </td>
            </tr>
            </tbody>
        </table>
    @endif

    <table border="0" cellspacing="0" cellpadding="0" class="packing_list">
        <tr class="border_top">
            <th class="desc">Heb je gevonden wat je zocht?  </th>
            <th class="desc"> </th>
            <th class="desc" style="text-align:right"> homee.nl</th>
        </tr>
    </table>
    <div id="notices" style="padding-top:10px;overflow: hidden;">
        <div class="notice">
            <div class="contactus" style="width:42%">
                <div class="name" style="color: blue;padding-bottom:3px">
                    Unikoop HomeShopping B.V.
                </div>
                <div class="to">Schakelstraat 13/15</div>
                <div class="to">1014 AW AMSTERDAM | NL</div>
            </div>
            <div class="contactus" style="width:40%">
                <div class="to">T: +31 20 303 88 50</div>
                <div class="to">F: +31 20 684 10 73</div>
            </div>
            <div class="contactus" style="width: 23%;float: right;margin-top: -27px;">
                <div class="to">info@unikoop.com</div>
                <div class="to">www.unikoop.com</div>
            </div>
        </div>
    </div>
    <div style="clear:both;"></div>
    <table style="margin-top:50px" border="0" cellspacing="0" cellpadding="0" width="100%" class="packing_list">
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
            <th class="desc" width="20%"><img src="{{asset('dhl/images/homee_logo-2.jpg')}}" width="120"/></th>
            <th class="desc" width="20%"><img src="{{asset('dhl/images/Lalouchi SINCE 1986-2.jpg')}}" width="150"/></th>
            <th width="20%" class="desc" style="text-align:center" ><img src="{{asset('dhl/images/organic-2.jpg')}}" width="120"/></th>
            <th class="desc" width="20%"><img src="{{asset('dhl/images/Ellaa Cosmetische Argon Olie-2.jpg')}}" width="120"/></td>
            <th width="20%" class="desc"> <img src="{{asset('dhl/images/La Tulipe Noire-2.jpg')}}" width="200" height="50" /></th>
        @endif
        </tr>
    </table>
    <div class="clear:both;"></div>

@elseif ($preview->type == 'pp4')
    <!-- Preview 4 -->
    <header class="clearfix">
        <div id="logo" style="float:left">
            @if ($preview->logo_1)
                <img src="{{ asset('images/'.$preview->logo_1) }}" width="150px" style="margin-right:60px" />
            @else
            <img src="{{asset('dhl/images/Homee For your comforts-2.jpg')}}" width="150px" style="margin-right:60px" />
            @endif
        </div>
        <div style="float:left; padding-top: 112px;" ><h2 class="" style="font-weight: bold; font-style: italic"> Bedankt voor je bestelling</h2>
        </div>
        <div id="logo2" style="float:right">
            @if ($preview->logo_2)
            <img src="{{ asset('images/'.$preview->logo_2) }}" width="150px" style="margin-right:60px" />
            @else
            <img src="{{asset('dhl/images/bol_logo-2.png')}}" width="200" />
            @endif
        </div>
    </header>

    <div id="details" class="clearfix">
        <div id="client" style="width: 54%; padding-top:10px"><br>
            Bestelnummer: 123456  <br />
            Geadresseerde email:  <br />
            test@gmail.com<br />
            <b>Verzenddatum: 01-09-2020 </b> <br />
        </div>
        <div id="invoice" style="width: 30%" >
            <br /> Aan:
            <h2 class="name3">mr.Saleem</h2>
            Kerklaan  &nbsp; 14<br />
            7951 &nbsp; CD &nbsp; STAPHORST<br />
            NL
        </div>
    </div>
    <h2 class="name2" style="padding-top:30px; padding-bottom:10px">Pakbon</h2>
    <table cellspacing="0" cellpadding="0" style="margin-top:5px" class="packing_list">
        <thead>
        <tr class="border_top">
            <th class="unit" width="25%" style="text-align: left" >EANcode | Artikelcode</th>
            <th class="unit" width="10%" style="text-align: left">Aantal</th>
            <th class="desc" width="50%" style="text-align: left">Productomschrijving</th>
            <th class="unit" width="12%" style="text-align: left; padding-left:20px">Reference</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="" width="25%" style="text-align: left">1234567890234 </td>
            <td style="text-align: center" width="10%">2</td>
            <td class="" width="50%" style="text-align: left">Homéé - Waszak - rood / wit geribbed | 240g.p/m2</td>
            <td class="" width="12%" style="text-align: left; padding-left:20px">P1 R4</td>
        </tr>
        </tbody>
    </table>
    <div style="height: 200px;"></div>
    @if($preview->body_text)
        <div class="row">
            <div class="col-md-12">
                {!! $preview->body_text !!}
            </div>
        </div>
    @else
        <table cellspacing="0" cellpadding="0" class="packing_list">
            <thead>
            <tr>
                <th style="" class="desc"><h2>Retourneren:</h2></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="desc">De retourvoorwaarden vind je hieronder. Waar het op neerkomt, is dat je rustig over je aankoop mag nadenken. Als je artikel geen goede match is, mag je het gratis naar ons terugsturen binnen de zichttermijn.</td>
            </tr>
            <tr>
                <th style="padding-top:20px" class="desc"><h2>Retourvoorwaarden:</h2></th>
            </tr>
            <tr>
                <td  class="desc">1- Je retourneert binnen de zichttermijn van 14 dagen bij Homéé. Kopers van Homéé producten kunnen altijd een retourneren binnen de zicht termijn van 14 dagen. De zichttermijn gaat in op de dag dat jij het artikel ontvangt. Bij aankoop meerdere artikelen in 1 bestelling? Dan de termijn pas ingaat als je alles hebt ontvangen. <br>
                    2- Het artikel zit in de originele verpakking.<br>
                    3- Kleding en schoenen zijn niet gedragen en het labeltje zit er nog aan.
                </td>
            </tr>

            <tr>
                <th style="padding-top:20px" class="desc"><h2>Artikelen die je niet kunt retourneren:</h2></th>
            </tr>
            <tr >
                <td  class="desc" >1-	Cadeaubonnen en -kaarten<br>
                    2-	Producten die geopend zijn, ander worden uit het pakking zijn en niet meer kan verpakt worden zoals het origineel verpakt was en waarvan de verpakking is verbroken
                </td>
            </tr>
            </tbody>
        </table>
    @endif

    <table border="0" cellspacing="0" cellpadding="0" class="packing_list">
        <tr class="border_top">
            <th class="desc">Heb je gevonden wat je zocht?  </th>
            <th class="desc"> </th>
            <th class="desc" style="text-align:right"> homee.nl</th>
        </tr>
    </table>
    <div id="notices" style="padding-top:10px;overflow: hidden;">
        <div class="notice">
            <div class="contactus" style="width:42%">
                <div class="name" style="color: blue;padding-bottom:3px">
                    Unikoop HomeShopping B.V.
                </div>
                <div class="to">Schakelstraat 13/15</div>
                <div class="to">1014 AW AMSTERDAM | NL</div>
            </div>
            <div class="contactus" style="width:40%">
                <div class="to">T: +31 20 303 88 50</div>
                <div class="to">F: +31 20 684 10 73</div>
            </div>
            <div class="contactus" style="width: 23%;float: right;margin-top: -27px;">
                <div class="to">info@unikoop.com</div>
                <div class="to">www.unikoop.com</div>
            </div>
        </div>
    </div>
    <div style="clear:both;"></div>
    <table style="margin-top:50px" border="0" cellspacing="0" cellpadding="0" width="100%" class="packing_list">
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
            <th class="desc" width="20%"><img src="{{asset('dhl/images/homee_logo-2.jpg')}}" width="120"/></th>
            <th class="desc" width="20%"><img src="{{asset('dhl/images/Lalouchi SINCE 1986-2.jpg')}}" width="150"/></th>
            <th width="20%" class="desc" style="text-align:center" ><img src="{{asset('dhl/images/organic-2.jpg')}}" width="120"/></th>
            <th class="desc" width="20%"><img src="{{asset('dhl/images/Ellaa Cosmetische Argon Olie-2.jpg')}}" width="120"/></td>
            <th width="20%" class="desc"> <img src="{{asset('dhl/images/La Tulipe Noire-2.jpg')}}" width="200" height="50" /></th>
        @endif
        </tr>
    </table>
    <div class="clear:both;"></div>
@endif
</body>
</html>