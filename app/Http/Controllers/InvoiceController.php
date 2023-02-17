<?php
namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use DB;
use View;
use PDF;
use Mail;
use \Milon\Barcode\DNS1D;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Mail\MyDemoMail;
use Illuminate\Support\Facades\Validator;

use Nwidart\Modules\Facades\Module;
use Modules\Bol\Entities\EmailTemplate;
// use Illuminate\Pagination\Paginator;
use Paginate;
use Auth;

class InvoiceController extends Controller
{
    public function invoice()
	{
        $default = EmailTemplate::where('email_type','Order Invoice')->where('status',1)->first();
        return View::make("invoice.create_invoice", compact('default'));
	}

    public function checkInvoice($bol_data, $email)
    {
        $paths = public_path() . "/";

        $bestelnummer = $bol_data->bestelnummer;
        $str_html = $this->viewInivoice($bestelnummer);
        $str_html2 = $this->viewpdf2($bestelnummer);
        if ($str_html != "" and $str_html2 != "") {
            $check_invoice_orderID = $bestelnummer;
            $check_invoice_message = '1-2';
            if ($str_html == "") {
                $check_invoice_orderID = $bestelnummer;
                $check_invoice_message = 2;
            } else {
                $check_invoice_orderID = $bestelnummer;
                $check_invoice_message = 1;
            }

            // $bol_data = DB::table('bol_data')->select("bestelnummer", "voornaam_verzending", "achternaam_verzending", "bedrijfsnaam_verzending", "bol_rec_id")->where('bestelnummer', $bestelnummer)->first();

            if ($bol_data->bedrijfsnaam_verzending != "") {
                $name = $bol_data->bedrijfsnaam_verzending;
            } else {
                $name = $bol_data->voornaam_verzending . " " . $bol_data->achternaam_verzending;
            }
            return [
                'o_no' => $bestelnummer,
                'email' => $email,
                'check_invoice_orderID' => $check_invoice_orderID,
                'check_invoice_message' => $check_invoice_message,
                'name' => $name,
            ];

        }
    }

    public function viewInivoice($bestelnummer)
    {
        $paths = public_path()."/";
        $row = DB::table('bol_data')->where('bestelnummer', $bestelnummer)->get()->toArray();

        if(!isset($row) or count($row) == 0)
        {
            return false;
            exit;
        }

        $str_html='
		<!DOCTYPE html>
		<html>
		<head>
		<link rel="stylesheet" href="'.$paths.'dhl/css/style_invoice.css" media="all" />
		<title> Admin - Home  </title></head>';

        if(!empty($row)  or count($row) >= 1){
            $invoice_check = 0;
            foreach ($row as $key )
            {
                $bedrijfsnaam_verzending=$key->bedrijfsnaam_verzending;
                $invoice_check++;

                $bestelnummer=$key->bestelnummer;
                //$cus_row=$this->bol->get_customer_orders($id,$bestelnummer);

                $cus_row = DB::table('bol_data')->select("id", "EAN", "aantal", "producttitel", "prijs", "referentie")->where('bestelnummer', $bestelnummer)->get()->toArray();

                // create invoice id
                //$invoice_id=$this->bol->insert_bol_invoice($bestelnummer);

                $today_dt=date("Y-m-d H:i:s");
                //   	$data = array(
                //        'date' => $today_dt,
                //        'bestelnummer' => $bestelnummer,
                //    	);
                // $this->db->insert('bol_data_invoice', $data);
                // return $this->db->insert_id();

                $invoice_id = DB::table('bol_data_invoice')->insertGetId(
                    ['date' 		=> $today_dt,
                        'bestelnummer' => $bestelnummer]
                );

                $emailadres=$key->emailadres;
                $besteldt=$key->besteldatum;
                $exp_datum=explode("T", $besteldt);
                $dt=date("d-m-Y");
                $besteldatum=$exp_datum[0];
                // prijs
                // solution code
                $aanhef_verzending=$key->aanhef_verzending;

                // first name
                $voornaam_verzending=$key->voornaam_verzending;
                // sur name
                $achternaam_verzending=$key->achternaam_verzending;

                // street name
                $adres_verz_straat=$key->adres_verz_straat;

                // house number
                $adres_verz_huisnummer=$key->adres_verz_huisnummer;

                // house extended number
                $adres_verz_huisnummer_toevoeging=$key->adres_verz_huisnummer_toevoeging;

                // extra addresss information
                $adres_verz_toevoeging=$key->adres_verz_toevoeging;

                // zipcode
                $postcode_verzending=$key->postcode_verzending;

                // city
                $woonplaats_verzending=$key->woonplaats_verzending;

                // landcode
                $land_verzending=$key->land_verzending;

                // trackerCode
                $trackerCode=$key->trackerCode;

                $str_html.=' <body> <header class="clearfix">
                                <div id="logo" >';

                // header logos
                $str_html.='<img src="'.$paths.'dhl/images/Homee For your comforts-2.jpg" width="120px" style="margin-right:80px" /></div>';


                //$str_html.='<div id="logo2"> <h2 class="title01"> FACTUUR</h2>
                $str_html.=' <h1 class="title01"> FACTUUR</h1>

                            <div id="logo2">

                            <img src="'.$paths.'dhl/images/bol_logo-2.png" width="200"/></div>
                        </header>';

                // below logos div
                $str_html.=' <div id="details" class="clearfix"> ';
                $str_html.=' ';
                $str_html.='<div id="client" style=" width:50% ; float:left;  margin-top:62px" > ';
                $str_html.='<span class="inv_list">Factuurnummmer: </span><span class="inv_list">'.$invoice_id.' </span> <br />';
                $str_html.='<span class="inv_list">Klantnummer: </span><span class="inv_list"> </span><br />';
                $str_html.='<span class="inv_list">Bestelnummer: </span><span class="inv_list">'.$bestelnummer.'</span><br />';
                $str_html.='<span class="inv_list">Geleverd door:</span><span class="inv_list"> DHL Parcel  </span><br />';
                $str_html.='<span class="inv_list">Track & Tracé:</span><span class="inv_list">'.$trackerCode.'</span> <br />';
                // $str_html.='<span class="inv_list">Betalings beschrijving: </span>'.' <br />';
                // $str_html.='<span class="inv_list">Uw Ref.: </span>'.' <br />';
                // $str_html.='<span class="inv_list">Uw BTW nr.: </span>'.' <br />';
                $str_html.='<span class="inv_list">Datum :</span><span class="inv_list">'.date("d-m-Y", strtotime($besteldatum)).'</span> <br />';
                $str_html.='</div>';

                $str_html.='<div id="invoice" style="float:left;" >';
                $str_html.='';
                if($bedrijfsnaam_verzending != "")
                    $str_html.=''.$bedrijfsnaam_verzending.'<br />';
                $str_html.=$voornaam_verzending.' '.$achternaam_verzending;
                $str_html.='<br>';
                //$bedrijfsnaam_verzending

                $str_html.=$adres_verz_straat.' '.$adres_verz_huisnummer.'<br />';
                if(($adres_verz_huisnummer_toevoeging != "") && ($adres_verz_toevoeging != ""))
                    $str_html.=$adres_verz_huisnummer_toevoeging.' '.$adres_verz_toevoeging.'<br />';

                // $str_html.=$adres_verz_huisnummer_toevoeging.' '.$adres_verz_toevoeging.'<br />';
                $str_html.=$postcode_verzending.' '.$woonplaats_verzending.'<br />';

                $cname=$this->get_country_name($land_verzending);
                $str_html.=$cname;
                $str_html.='</div></div>';

                //$str_html.='<h2 class="name2">Pakbon</h2>';

                // <th class="unit" width="13%">Krt%</th>
                $str_html.='<table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr class="border_top" >

                    <th class="unit" width="12%" style="text-align:left" >Artikelcode</th>
                    <th class="desc" width="42%" style="text-align:left">Omschrijving</th>
                    <th class="unit" width="7%" style="text-align:left">Aantal</th>
                    <th class="unit" width="7%" style="text-align:left">Stukprijs</th>

                        <th class="unit" width="7%">Totaal</th>
                        <th class="unit" width="5%">Btw</th>
                    </tr>
                </thead>
                <tbody>';
                $total_btw_all=0;
                $stukprijs_tot_btw_all=0;
                $stukprijs_tot_all=0;


                foreach ($cus_row as $value) {
                    $EAN=$value->EAN;
                    $aantal=$value->aantal;
                    $producttitel=$value->producttitel;
                    $referentie=$value->referentie;
                    $prijs_with_btw=$value->prijs;
                    $prijs_with_btw=$prijs_with_btw/$aantal;
                    $per_121=(121 / 100) ;
                    $per_21=(21 / 100) ;

                    // single price (total price / 121%)
                    $stukprijs=$prijs_with_btw / $per_121;
                    // single price 21% (single price * 21%)
                    $single_btw=$stukprijs * $per_21;
                    $stukprijs_tot=$stukprijs * $aantal;
                    $stukprijs_tot_all+=$stukprijs * $aantal;
                    $total_btw= $stukprijs_tot * $per_21;
                    $total_btw_all+= $stukprijs_tot * $per_21;
                    $stukprijs_tot_btw=$stukprijs_tot + $total_btw;
                    $stukprijs_tot_btw_all+=$stukprijs_tot + $total_btw;
                    setlocale(LC_MONETARY, 'nl_NL.UTF-8');
                    $stukprijs2 = $this->money_format('%(#1n', $stukprijs);
                    setlocale(LC_MONETARY, 'nl_NL.UTF-8');
                    $stukprijs_tot2 = $this->money_format('%(#1n', $stukprijs_tot);
                    $str_html.='<tr>
                    <td class="unit" width="12%" style="vertical-align: top;text-align:left">'.$EAN.' </td>
                    <td class="desc" width="42%" style="vertical-align: top;text-align:left">'.$producttitel.'</td>
                        <td class="unit" width="7%" style="vertical-align: top;">'.$aantal.'</td>
                        <td class="unit" width="7%" style="vertical-align: top;">'.$stukprijs2.'</td>
                        <td class="unit" width="7%" style="vertical-align: top;">'.$stukprijs_tot2.'</td>
                    <td width="5%" class="unit" style="vertical-align: top;">2</td>
                    </tr>';
                }
                $bar_image_value=number_format((float)$stukprijs_tot_btw_all, 2, '.', '');

                // saving image for barcode
                //$data="data:image/png;base64," . base64_encode(\Picqer\Barcode\BarcodeGeneratorPNG::getBarcode($bar_image_value, \Picqer\Barcode\BarcodeGeneratorPNG::TYPE_CODE_128));

                $d = new DNS1D();
                //$barcode = DNS1D::getBarcodePNG($bar_image_value, "C128");

                $data="data:image/png;base64," .$d->getBarcodePNG($bar_image_value, "C128") ;
                // echo $d->getBarcodeHTML($bar_image_value, "C128");

                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);

                file_put_contents($paths.'barcode_image/'.$invoice_id.'.png', $data);

                $tnt=count($cus_row);
                $totalheight=525;
                $minheight=$tnt*40;
                $fheight=$totalheight-$minheight;

                $str_html.='</tbody>
			        </table>';
                        $str_html.='
                        <div style="height:'.$fheight.'px;">
                            </div>';
                        $str_html.=' <table border="0" cellspacing="0" cellpadding="0">
			        <tbody>
			        <tr >
			            <th style="padding-top:20px; padding-bottom:20px" colspan="4"><h2 style="margin-left:-78px">Gaarne bij vermelden: 51919/'.$invoice_id.'</h2></th>
			            <th style="padding-top:10px; padding-bottom:10px" colspan="2"><img src="'.$paths.'barcode_image/'.$invoice_id.'.png" width="130" style="float:right; margin-right: 4px"/></th>
			        </tr>
					<tr>
                        <th class="desc">btw &nbsp; &nbsp; %</th>
                        <th class="desc">btw &nbsp; Grondslag</th>
                        <th class="desc">BTW bedrag</th>
                        <td class="desc"> </td>
                        <td class="desc" style="width:150px!imported;">Excl. BTW voor korting</td>
                        <td class="desc" style="text-align:right;">'.number_format((float)$stukprijs_tot_all, 2, '.', '').'</td>
					</tr>
					 <tr>
						 <td  class="desc">0 &nbsp; &nbsp;  0,000 </td>
						 <td  class="desc">0,000 </td>
						 <td  class="desc">00,00 </td>
						 <td  class="desc"> </td>
						 <td  class="desc">Factuurkorting   % </td>
						 <td  class="desc" style="text-align:right;">  00,00<br><hr style="border-color:grey"></td>
					 </tr>
					 <tr>
						 <td  class="desc">1  &nbsp; &nbsp; 0,000 </td>
						 <td  class="desc">0,000 </td>
						 <td  class="desc">00,00 </td>
						  <td class="desc"> </td>
						 <td  class="desc">Excl. BTW na korting </td>
						 <td  class="desc" style="text-align:right;">'.number_format((float)$stukprijs_tot_all, 2, '.', '').'</td>
					 </tr>
					 <tr>
						 <td  class="desc">2  &nbsp; &nbsp; 21,00 </td>
						 <td  class="desc">'.number_format((float)$stukprijs_tot_all, 2, '.', '').' </td>
						 <td  class="desc">'.number_format((float)$total_btw_all, 2, '.', '').' </td>
						  <td class="desc"> </td>
						 <td  class="desc">Totaal BTW</td>
						 <td  class="desc" style="text-align:right;">'.number_format((float)$total_btw_all, 2, '.', '').'<br><hr style="border-color:grey"></td>
					 </tr>
			        </tbody>
			        </table>
				    <table border="0" cellspacing="0" cellpadding="0">
						<tr>
						    <th class="desc" style="color:blue" width="66%">Unikoop HomeShopping B.V.</td>
							<th class="desc" width="29%">Te betalen €</th>
							<th class="desc" style="text-align:right;"> '.number_format((float)$stukprijs_tot_btw_all, 2, '.', '').'  </th>
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
                            <div><br> </div>
                            <div>T: +31 20 303 88 50</div>
                            <div>F: +31 20 684 10 73</div>
                        </td>
                        <td width="75px !important">
                            <div><br> </div>
                            <div>info@unikoop.com</div>
                            <div>www.unikoop.com</div>
                        </td>
                        <td width="120px !important">
                            <div><br> </div>
                            <div class="to">KvK 34.15.98.32 to Amsterdam</div>
                            <div class="to">BTW nr. NL 81.02.24.574 B01</div>
                        </td>
                        <td width="130px !important">
                        <div ><b> ABN-AMRO Bank </b></div>
                                <div class="to">IBAN:  NL 77 ABNA 0623 3875 22 </div>
                                <div class="to">BIC: ABNANL2A</div>
                        </td>
                        <td width="105px !important">
                            <div class="name"><b>ING Bank</b></div>
                                <div class="to">IBAN:  NL23 INGB 0008 3554 77 </div>
                                <div class="to">BIC: INGBNL2A</div>
                        </td>

                    </tr>
				</table>
                <div class="clear:both;"></div>
                <hr style="">
				<table border="0" cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<th class="desc" width="20%"><img src="'.$paths.'dhl/images/homee_logo-2.jpg" width="120"/></th>

						<th class="desc" width="20%"><img src="'.$paths.'dhl/images/Lalouchi SINCE 1986-2.jpg" width="150"/></th>
						<th width="20%" class="desc" style="text-align:center" ><img src="'.$paths.'dhl/images/organic-2.jpg" width="120"/></th>
						<th class="desc" width="20%"><img src="'.$paths.'dhl/images/Ellaa Cosmetische Argon Olie-2.jpg" width="120"/></td>

						<th width="20%" class="desc"> <img src="'.$paths.'dhl/images/La Tulipe Noire-2.jpg" width="200" height="50" /></th>
					</tr>
					</table>
				<div class="clear:both;"></div>
				</body>
				';
            }
            if($invoice_check == 0)
            {
                return "";
                exit;
            }
        } else {
            return "";
            exit;
        }
        $str_html.='</html>';
        return $str_html;
    }

    public function get_country_name($key)
    {
        $countries = array(
            'AF' => 'AFGHANISTAN',
            'AL' => 'ALBANIA',
            'DZ' => 'ALGERIA',
            'AS' => 'AMERICAN SAMOA',
            'AD' => 'ANDORRA',
            'AO' => 'ANGOLA',
            'AI' => 'ANGUILLA',
            'AQ' => 'ANTARCTICA',
            'AG' => 'ANTIGUA AND BARBUDA',
            'AR' => 'ARGENTINA',
            'AM' => 'ARMENIA',
            'AW' => 'ARUBA',
            'AU' => 'AUSTRALIA',
            'AT' => 'AUSTRIA',
            'AZ' => 'AZERBAIJAN',
            'BS' => 'BAHAMAS',
            'BH' => 'BAHRAIN',
            'BD' => 'BANGLADESH',
            'BB' => 'BARBADOS',
            'BY' => 'BELARUS',
            'BE' => 'BELGIUM',
            'BZ' => 'BELIZE',
            'BJ' => 'BENIN',
            'BM' => 'BERMUDA',
            'BT' => 'BHUTAN',
            'BO' => 'BOLIVIA',
            'BA' => 'BOSNIA AND HERZEGOVINA',
            'BW' => 'BOTSWANA',
            'BV' => 'BOUVET ISLAND',
            'BR' => 'BRAZIL',
            'IO' => 'BRITISH INDIAN OCEAN TERRITORY',
            'BN' => 'BRUNEI DARUSSALAM',
            'BG' => 'BULGARIA',
            'BF' => 'BURKINA FASO',
            'BI' => 'BURUNDI',
            'KH' => 'CAMBODIA',
            'CM' => 'CAMEROON',
            'CA' => 'CANADA',
            'CV' => 'CAPE VERDE',
            'KY' => 'CAYMAN ISLANDS',
            'CF' => 'CENTRAL AFRICAN REPUBLIC',
            'TD' => 'CHAD',
            'CL' => 'CHILE',
            'CN' => 'CHINA',
            'CX' => 'CHRISTMAS ISLAND',
            'CC' => 'COCOS (KEELING) ISLANDS',
            'CO' => 'COLOMBIA',
            'KM' => 'COMOROS',
            'CG' => 'CONGO',
            'CD' => 'CONGO, THE DEMOCRATIC REPUBLIC OF THE',
            'CK' => 'COOK ISLANDS',
            'CR' => 'COSTA RICA',
            'CI' => 'COTE D IVOIRE',
            'HR' => 'CROATIA',
            'CU' => 'CUBA',
            'CY' => 'CYPRUS',
            'CZ' => 'CZECH REPUBLIC',
            'DK' => 'DENMARK',
            'DJ' => 'DJIBOUTI',
            'DM' => 'DOMINICA',
            'DO' => 'DOMINICAN REPUBLIC',
            'TP' => 'EAST TIMOR',
            'EC' => 'ECUADOR',
            'EG' => 'EGYPT',
            'SV' => 'EL SALVADOR',
            'GQ' => 'EQUATORIAL GUINEA',
            'ER' => 'ERITREA',
            'EE' => 'ESTONIA',
            'ET' => 'ETHIOPIA',
            'FK' => 'FALKLAND ISLANDS (MALVINAS)',
            'FO' => 'FAROE ISLANDS',
            'FJ' => 'FIJI',
            'FI' => 'FINLAND',
            'FR' => 'FRANCE',
            'GF' => 'FRENCH GUIANA',
            'PF' => 'FRENCH POLYNESIA',
            'TF' => 'FRENCH SOUTHERN TERRITORIES',
            'GA' => 'GABON',
            'GM' => 'GAMBIA',
            'GE' => 'GEORGIA',
            'DE' => 'GERMANY',
            'GH' => 'GHANA',
            'GI' => 'GIBRALTAR',
            'GR' => 'GREECE',
            'GL' => 'GREENLAND',
            'GD' => 'GRENADA',
            'GP' => 'GUADELOUPE',
            'GU' => 'GUAM',
            'GT' => 'GUATEMALA',
            'GN' => 'GUINEA',
            'GW' => 'GUINEA-BISSAU',
            'GY' => 'GUYANA',
            'HT' => 'HAITI',
            'HM' => 'HEARD ISLAND AND MCDONALD ISLANDS',
            'VA' => 'HOLY SEE (VATICAN CITY STATE)',
            'HN' => 'HONDURAS',
            'HK' => 'HONG KONG',
            'HU' => 'HUNGARY',
            'IS' => 'ICELAND',
            'IN' => 'INDIA',
            'ID' => 'INDONESIA',
            'IR' => 'IRAN, ISLAMIC REPUBLIC OF',
            'IQ' => 'IRAQ',
            'IE' => 'IRELAND',
            'IL' => 'ISRAEL',
            'IT' => 'ITALY',
            'JM' => 'JAMAICA',
            'JP' => 'JAPAN',
            'JO' => 'JORDAN',
            'KZ' => 'KAZAKSTAN',
            'KE' => 'KENYA',
            'KI' => 'KIRIBATI',
            'KP' => 'KOREA DEMOCRATIC PEOPLES REPUBLIC OF',
            'KR' => 'KOREA REPUBLIC OF',
            'KW' => 'KUWAIT',
            'KG' => 'KYRGYZSTAN',
            'LA' => 'LAO PEOPLES DEMOCRATIC REPUBLIC',
            'LV' => 'LATVIA',
            'LB' => 'LEBANON',
            'LS' => 'LESOTHO',
            'LR' => 'LIBERIA',
            'LY' => 'LIBYAN ARAB JAMAHIRIYA',
            'LI' => 'LIECHTENSTEIN',
            'LT' => 'LITHUANIA',
            'LU' => 'LUXEMBOURG',
            'MO' => 'MACAU',
            'MK' => 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF',
            'MG' => 'MADAGASCAR',
            'MW' => 'MALAWI',
            'MY' => 'MALAYSIA',
            'MV' => 'MALDIVES',
            'ML' => 'MALI',
            'MT' => 'MALTA',
            'MH' => 'MARSHALL ISLANDS',
            'MQ' => 'MARTINIQUE',
            'MR' => 'MAURITANIA',
            'MU' => 'MAURITIUS',
            'YT' => 'MAYOTTE',
            'MX' => 'MEXICO',
            'FM' => 'MICRONESIA, FEDERATED STATES OF',
            'MD' => 'MOLDOVA, REPUBLIC OF',
            'MC' => 'MONACO',
            'MN' => 'MONGOLIA',
            'MS' => 'MONTSERRAT',
            'MA' => 'MOROCCO',
            'MZ' => 'MOZAMBIQUE',
            'MM' => 'MYANMAR',
            'NA' => 'NAMIBIA',
            'NR' => 'NAURU',
            'NP' => 'NEPAL',
            'NL' => 'NEDERLAND',
            'AN' => 'NETHERLANDS ANTILLES',
            'NC' => 'NEW CALEDONIA',
            'NZ' => 'NEW ZEALAND',
            'NI' => 'NICARAGUA',
            'NE' => 'NIGER',
            'NG' => 'NIGERIA',
            'NU' => 'NIUE',
            'NF' => 'NORFOLK ISLAND',
            'MP' => 'NORTHERN MARIANA ISLANDS',
            'NO' => 'NORWAY',
            'OM' => 'OMAN',
            'PK' => 'PAKISTAN',
            'PW' => 'PALAU',
            'PS' => 'PALESTINIAN TERRITORY, OCCUPIED',
            'PA' => 'PANAMA',
            'PG' => 'PAPUA NEW GUINEA',
            'PY' => 'PARAGUAY',
            'PE' => 'PERU',
            'PH' => 'PHILIPPINES',
            'PN' => 'PITCAIRN',
            'PL' => 'POLAND',
            'PT' => 'PORTUGAL',
            'PR' => 'PUERTO RICO',
            'QA' => 'QATAR',
            'RE' => 'REUNION',
            'RO' => 'ROMANIA',
            'RU' => 'RUSSIAN FEDERATION',
            'RW' => 'RWANDA',
            'SH' => 'SAINT HELENA',
            'KN' => 'SAINT KITTS AND NEVIS',
            'LC' => 'SAINT LUCIA',
            'PM' => 'SAINT PIERRE AND MIQUELON',
            'VC' => 'SAINT VINCENT AND THE GRENADINES',
            'WS' => 'SAMOA',
            'SM' => 'SAN MARINO',
            'ST' => 'SAO TOME AND PRINCIPE',
            'SA' => 'SAUDI ARABIA',
            'SN' => 'SENEGAL',
            'SC' => 'SEYCHELLES',
            'SL' => 'SIERRA LEONE',
            'SG' => 'SINGAPORE',
            'SK' => 'SLOVAKIA',
            'SI' => 'SLOVENIA',
            'SB' => 'SOLOMON ISLANDS',
            'SO' => 'SOMALIA',
            'ZA' => 'SOUTH AFRICA',
            'GS' => 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS',
            'ES' => 'SPAIN',
            'LK' => 'SRI LANKA',
            'SD' => 'SUDAN',
            'SR' => 'SURINAME',
            'SJ' => 'SVALBARD AND JAN MAYEN',
            'SZ' => 'SWAZILAND',
            'SE' => 'SWEDEN',
            'CH' => 'SWITZERLAND',
            'SY' => 'SYRIAN ARAB REPUBLIC',
            'TW' => 'TAIWAN, PROVINCE OF CHINA',
            'TJ' => 'TAJIKISTAN',
            'TZ' => 'TANZANIA, UNITED REPUBLIC OF',
            'TH' => 'THAILAND',
            'TG' => 'TOGO',
            'TK' => 'TOKELAU',
            'TO' => 'TONGA',
            'TT' => 'TRINIDAD AND TOBAGO',
            'TN' => 'TUNISIA',
            'TR' => 'TURKEY',
            'TM' => 'TURKMENISTAN',
            'TC' => 'TURKS AND CAICOS ISLANDS',
            'TV' => 'TUVALU',
            'UG' => 'UGANDA',
            'UA' => 'UKRAINE',
            'AE' => 'UNITED ARAB EMIRATES',
            'GB' => 'UNITED KINGDOM',
            'US' => 'UNITED STATES',
            'UM' => 'UNITED STATES MINOR OUTLYING ISLANDS',
            'UY' => 'URUGUAY',
            'UZ' => 'UZBEKISTAN',
            'VU' => 'VANUATU',
            'VE' => 'VENEZUELA',
            'VN' => 'VIET NAM',
            'VG' => 'VIRGIN ISLANDS, BRITISH',
            'VI' => 'VIRGIN ISLANDS, U.S.',
            'WF' => 'WALLIS AND FUTUNA',
            'EH' => 'WESTERN SAHARA',
            'YE' => 'YEMEN',
            'YU' => 'YUGOSLAVIA',
            'ZM' => 'ZAMBIA',
            'ZW' => 'ZIMBABWE',
        );
        $key_up = strtoupper($key);
        $name = $countries[$key_up];
        return $name;
    }

    public function money_format($formato, $valor) {
        if (setlocale(LC_MONETARY, 0) == 'C') {
            return number_format($valor, 2);
        }

        $locale = localeconv();

        $regex = '/^'.             // Inicio da Expressao
                '%'.              // Caractere %
                '(?:'.            // Inicio das Flags opcionais
                '\=([\w\040])'.   // Flag =f
                '|'.
                '([\^])'.         // Flag ^
                '|'.
                '(\+|\()'.        // Flag + ou (
                '|'.
                '(!)'.            // Flag !
                '|'.
                '(-)'.            // Flag -
                ')*'.             // Fim das flags opcionais
                '(?:([\d]+)?)'.   // W  Largura de campos
                '(?:#([\d]+))?'.  // #n Precisao esquerda
                '(?:\.([\d]+))?'. // .p Precisao direita
                '([in%])'.        // Caractere de conversao
                '$/';             // Fim da Expressao

        if (!preg_match($regex, $formato, $matches)) {
            trigger_error('Formato invalido: '.$formato, E_USER_WARNING);
            return $valor;
        }

        $opcoes = array(
            'preenchimento'   => ($matches[1] !== '') ? $matches[1] : ' ',
            'nao_agrupar'     => ($matches[2] == '^'),
            'usar_sinal'      => ($matches[3] == '+'),
            'usar_parenteses' => ($matches[3] == '('),
            'ignorar_simbolo' => ($matches[4] == '!'),
            'alinhamento_esq' => ($matches[5] == '-'),
            'largura_campo'   => ($matches[6] !== '') ? (int)$matches[6] : 0,
            'precisao_esq'    => ($matches[7] !== '') ? (int)$matches[7] : false,
            'precisao_dir'    => ($matches[8] !== '') ? (int)$matches[8] : $locale['int_frac_digits'],
            'conversao'       => $matches[9]
        );

        if ($opcoes['usar_sinal'] && $locale['n_sign_posn'] == 0) {
            $locale['n_sign_posn'] = 1;
        } elseif ($opcoes['usar_parenteses']) {
            $locale['n_sign_posn'] = 0;
        }
        if ($opcoes['precisao_dir']) {
            $locale['frac_digits'] = $opcoes['precisao_dir'];
        }
        if ($opcoes['nao_agrupar']) {
            $locale['mon_thousands_sep'] = '';
        }

        $tipo_sinal = $valor >= 0 ? 'p' : 'n';
        if ($opcoes['ignorar_simbolo']) {
            $simbolo = '';
        } else {
            $simbolo = $opcoes['conversao'] == 'n' ? $locale['currency_symbol']
                                                : $locale['int_curr_symbol'];
        }
        $numero = number_format(abs($valor), $locale['frac_digits'], $locale['mon_decimal_point'], $locale['mon_thousands_sep']);


        $sinal = $valor >= 0 ? $locale['positive_sign'] : $locale['negative_sign'];
        $simbolo_antes = $locale[$tipo_sinal.'_cs_precedes'];

        $espaco1 = $locale[$tipo_sinal.'_sep_by_space'] == 1 ? ' ' : '';

        $espaco2 = $locale[$tipo_sinal.'_sep_by_space'] == 2 ? ' ' : '';

        $formatado = '';
        switch ($locale[$tipo_sinal.'_sign_posn']) {
        case 0:
            if ($simbolo_antes) {
                $formatado = '('.$simbolo.$espaco1.$numero.')';
            } else {
                $formatado = '('.$numero.$espaco1.$simbolo.')';
            }
            break;
        case 1:
            if ($simbolo_antes) {
                $formatado = $sinal.$espaco2.$simbolo.$espaco1.$numero;
            } else {
                $formatado = $sinal.$numero.$espaco1.$simbolo;
            }
            break;
        case 2:
            if ($simbolo_antes) {
                $formatado = $simbolo.$espaco1.$numero.$sinal;
            } else {
                $formatado = $numero.$espaco1.$simbolo.$espaco2.$sinal;
            }
            break;
        case 3:
            if ($simbolo_antes) {
                $formatado = $sinal.$espaco2.$simbolo.$espaco1.$numero;
            } else {
                $formatado = $numero.$espaco1.$sinal.$espaco2.$simbolo;
            }
            break;
        case 4:
            if ($simbolo_antes) {
                $formatado = $simbolo.$espaco2.$sinal.$espaco1.$numero;
            } else {
                $formatado = $numero.$espaco1.$simbolo.$espaco2.$sinal;
            }
            break;
        }

        if ($opcoes['largura_campo'] > 0 && strlen($formatado) < $opcoes['largura_campo']) {
            $alinhamento = $opcoes['alinhamento_esq'] ? STR_PAD_RIGHT : STR_PAD_LEFT;
            $formatado = str_pad($formatado, $opcoes['largura_campo'], $opcoes['preenchimento'], $alinhamento);
        }

        return $formatado;
    }

    public function viewpdf2($bestelnummer)
	{
		$paths = public_path()."/";
		$cus_row = DB::table('bol_data')->select("*")->where('bestelnummer', $bestelnummer)->get()->toArray();
		if(count($cus_row) > 0)
		{
			$key = $cus_row[0];
			$str_html='
			<!DOCTYPE html>
			<html>
			<head>
			<link rel="stylesheet" href="'.$paths.'dhl/css/pdfstyle.css" media="all" />
			<title> Admin - Home  </title></head>';
            $emailadres=$key->emailadres;
            $besteldt=$key->besteldatum;
            $exp_datum=explode("T", $besteldt);
            $besteldatum=$exp_datum[0];
            // solution code
            $aanhef_verzending=$key->aanhef_verzending;
            // first name
            $voornaam_verzending=$key->voornaam_verzending;
            // sur name
            $achternaam_verzending=$key->achternaam_verzending;
            // street name
            $adres_verz_straat=$key->adres_verz_straat;
            // house number
            $adres_verz_huisnummer=$key->adres_verz_huisnummer;
            // house extended number
            $adres_verz_huisnummer_toevoeging=$key->adres_verz_huisnummer_toevoeging;
            // extra addresss information
            $adres_verz_toevoeging=$key->adres_verz_toevoeging;
            // zipcode
            $postcode_verzending=$key->postcode_verzending;
            // city
            $woonplaats_verzending=$key->woonplaats_verzending;
            // landcode
            $land_verzending=$key->land_verzending;
            $str_html.=' <body> <header class="clearfix">
            <div id="logo" style="float:left">';
            // header logos
            $log=$paths."dhl/images/homee_logo.jpg";
            $str_html.='<img src="'.$paths.'dhl/images/Homee For your comforts-2.jpg" width="150px" style="margin-right:60px"  /></div>';
            $str_html.='<div style="float:left; padding-top:30px" ><h2 class="" style="width: 480px; font-weight: bold; font-style: italic"> Bedankt voor je bestelling</h2>
            </div><div id="logo2"  style="float:right"> <img src="'.$paths.'dhl/images/bol_logo-2.png" width="200" style="" />
                        </div>
                        </header>';
                // below logos div
            $str_html.=' <div id="details" class="clearfix"> ';
            // $str_html.=' <h2 class="title01"> Bedankt voor je bestelling</h2>';
            $str_html.='<div id="client" style="width: 65%; padding-top:10px"> <br>';
            $str_html.='Bestelnummer: '.$bestelnummer.'  <br />';
            $str_html.='Geadresseerde email:   <br />';
            $str_html.=$emailadres.'<br />';
            $str_html.='<b>Verzenddatum: '.date("d-m-Y", strtotime($besteldatum)).' </b> <br />';
            $str_html.='</div>';
            $str_html.='<div id="invoice" style="width: 30%" >';
            $str_html.='<br /> Aan: ';
            $str_html.='<h2 class="name3">'.$voornaam_verzending.' '.$achternaam_verzending.  '</h2> ';
            $str_html.=$adres_verz_straat.' '.$adres_verz_huisnummer.'<br />';
            if(($adres_verz_huisnummer_toevoeging != "") && ($adres_verz_toevoeging != ""))
            $str_html.=$adres_verz_huisnummer_toevoeging.' '.$adres_verz_toevoeging.'<br />';
            // $str_html.=$adres_verz_huisnummer_toevoeging.' '.$adres_verz_toevoeging.'<br />';
            $str_html.=$postcode_verzending.' '.$woonplaats_verzending.'<br />';
            $str_html.=$land_verzending;
            $str_html.='</div></div>';
            $str_html.='<h2 class="name2" style="padding-top:30px; padding-bottom:10px">Pakbon</h2>';
            $str_html.='<table cellspacing="0" cellpadding="0" style="margin-top:5px" class="packing_list">
            <thead>
                <tr class="border_top">
                <th class="unit" width="25%" style="text-align: left" >EANcode | Artikelcode</th>
                <th class="unit" width="10%" style="text-align: left">Aantal</th>
                <th class="desc" width="50%" style="text-align: left">Productomschrijving</th>
                <th class="unit" width="12%" style="text-align: left; padding-left:20px">Reference</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($cus_row as $value) {
                $EAN=$value->EAN;
                $aantal=$value->aantal;
                $producttitel=$value->producttitel;
                $referentie=$value->referentie;
                $str_html.='<tr>
                <td class="" width="25%" style="text-align: left">'.$EAN.' </td>
                <td style="text-align: center" width="10%">'.$aantal.'</td>
                <td class="" width="50%" style="text-align: left">'.$producttitel.'</td>
                <td class="" width="12%" style="text-align: left; padding-left:20px">'.$referentie.'</td>
                </tr>';
            }
            $tnt=count($cus_row);
            $totalheight=340;
            $minheight=$tnt*40;
            $fheight=$totalheight-$minheight;

            $str_html.='</tbody>
            </table>';
            $str_html.='
            <div style="height:'.$fheight.'px;">
                </div>	';
            $str_html.=' <table cellspacing="0" cellpadding="0" class="packing_list">
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
                    <table border="0" cellspacing="0" cellpadding="0" class="packing_list">
                                <tr class="border_top">
                                    <th class="desc">Heb je gevonden wat je zocht?  </th>
                                    <th class="desc"> </th>
                                    <th class="desc" style="text-align:right"> homee.nl</th>
                                </tr>
                            </table>


                    <div id="notices" style="padding-top:10px">

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
                            <div class="contactus">
                                <div class="to">info@unikoop.com</div>
                                <div class="to">www.unikoop.com</div>
                            </div>
                        </div>
                    </div>

                    <div style="clear:both;"></div>

                    <table style="margin-top:50px" border="0" cellspacing="0" cellpadding="0" width="100%" class="packing_list">
                        <tr>
                            <th class="desc" width="20%"><img src="'.$paths.'dhl/images/homee_logo-2.jpg" width="120"/></th>

                            <th class="desc" width="20%"><img src="'.$paths.'dhl/images/Lalouchi SINCE 1986-2.jpg" width="150"/></th>
                            <th width="20%" class="desc" style="text-align:center" ><img src="'.$paths.'dhl/images/organic-2.jpg" width="120"/></th>
                            <th class="desc" width="20%"><img src="'.$paths.'dhl/images/Ellaa Cosmetische Argon Olie-2.jpg" width="120"/></td>

                            <th width="20%" class="desc"> <img src="'.$paths.'dhl/images/La Tulipe Noire-2.jpg" width="200" height="50" /></th>
                        </tr>
                    </table>

                    <div class="clear:both;"></div>
                </body>';
			$str_html.='</html>';
		} else {
			return "";
			exit;
		}
		return $str_html;
	}
}
