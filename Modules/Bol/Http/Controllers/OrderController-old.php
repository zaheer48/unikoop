<?php
namespace Modules\Bol\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\BolPlazaClient;
use App\Bol_data;
use App\Bol_rec;
use App\Setting;
use Auth;
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



class OrderController extends Controller
{
    public function __construct()
    {
    }

    public function downloadLabel(Request $request)
    {
        $pdf_file = '';
        $isExists = '';
        $bol_data = DB::table('bol_data')
            ->select('*')
            ->join('bol_rec', 'bol_rec.id', '=', 'bol_data.bol_rec_id')
            ->where('bol_data.bestelnummer',$request->bestelnummer)
            ->where('bol_rec.user_id',Auth::id())
            ->first();
        if ($bol_data) {
            if ($bol_data->lable_pdf) {
                $pdf_file = $bol_data->lable_pdf;
            } else {
                $pdf = $request->bestelnummer . '_1.pdf';
                if (file_exists(public_path('pdf_files/' . $pdf))) {
                    $pdf_file = $pdf;
                } else {
                    $pdf_file = '';
                }
            }
            if ($pdf_file || $bol_data->trackerCode) {
                $isExists = 1;
                $request->session()->flash('alert-danger', 'Record found!');
                return View::make('bol::download')->with('pdf_file', $pdf_file)->with('bol_trackerCode', $bol_data->trackerCode)->with('exists', $isExists);
            } else {
                $request->session()->flash('alert-danger', 'No Record found!');
                return View::make('bol::download');
            }
        } else {
            $request->session()->flash('alert-danger', 'No Record found!');
            return View::make('bol::download');
        }
    }

    public function allOrders()
    {
        $userId = Auth::id();
        $bol_rec = DB::table('bol_rec')->where('user_id', $userId)->orderBy('id', 'DESC')->paginate(10);
        $totalRecords = DB::table('bol_rec')->where('user_id', $userId)->count();
        return view('bol::dashboard', compact('bol_rec', 'totalRecords'));
    }

    public function orders($id)
    {
        $array = DB::table('bol_data')->distinct()->where('bol_rec_id', $id)->orderBy('id', 'ASC')->get()->toArray();
        $temp = array_unique(array_column($array, 'bestelnummer'));
        $resp = array_intersect_key($array, $temp);

        $ret_str = array();
        if (count($resp) > 0) {
            foreach ($resp as $res) {
                $bestelnummer = $res->id;
                $ret_str[] = $bestelnummer;
            }
        }

        $dist_number = $ret_str;
        $returns = '';

        $result = DB::table('bol_data')->where('bol_rec_id', $id)->whereIn('id', $dist_number)->orderBy('id', 'ASC')->get()->toArray();
        foreach ($result as $row) {
            $id2 = $row->id;
            if (isset($id)) {
                $id = $id;
            } else {
                $id = $row->bol_rec_id;
            }
            $trackerCode = $row->trackerCode;
            //$site=$row[$i]['site'];
            $bestelnummer = $row->bestelnummer;
            $logistics = $row->logistiek;
            $besteldatum = $row->besteldatum;
            $dt = date("F j, Y, g:i a", strtotime($besteldatum));
            $best_date_exp = explode("T", $besteldatum);
            $best_date = $best_date_exp[0];
            $producttitel = $row->producttitel;

            $cus_rows = DB::table('bol_data')->select("id", "EAN", "aantal", "producttitel", "prijs", "referentie")->where('bestelnummer', $bestelnummer)->where('bol_rec_id', $id)->get()->toArray();
            $torder = count($cus_rows);

            //$total_order=$bol->get_total_order($id);
            $returns .= ('<tr>');
            $returns .= ('<td height="30">');
            $returns .= $row->bol_rec_id;
            $returns .= ('</td>');

            $returns .= ('<td height="30">');

            if (is_array($cus_rows)) {
                foreach ($cus_rows as $cus_row) {
                    $producttitel = $cus_row->producttitel;
                    $EAN = $cus_row->EAN;
                    //$referentie=$cus_row[$j]['referentie'];
                    $returns .= ("<b>EAN</b>:" . $EAN . "<br />");
                    $returns .= ("<b>Prijs</b>:" . $cus_row->prijs . "<br />");
                    $returns .= ("<b>Referentie</b>:" . $cus_row->referentie . "<br />");
                    $returns .= ("<b>Product</b>:" . $producttitel . "<br />");
                    $returns .= ("<b>Aantal</b>:" . $cus_row->aantal);
                }
            }
            $returns .= (' </td>');
            $returns .= ('<td height="30" style="word-break: break-all;"> ' . $row->bestelnummer . ' </td>');
            $returns .= ('<td height="30"> ' . $row->postcode_verzending . ' </td>');
            $returns .= ('<td height="30"> ' . $row->voornaam_verzending . ' </td>');
            $returns .= ('<td height="30"> ' . $row->achternaam_verzending . ' </td>');
            $returns .= ('<td height="30"> ' . $dt . ' </td>');
            $uit_dt = "";
            $uiterste_leverdatum = $row->uiterste_leverdatum;
            if ($uiterste_leverdatum != "")
                $uit_dt = date("F j, Y, g:i a", strtotime($uiterste_leverdatum));
            $returns .= ('<td height="30"> ' . $uit_dt . ' </td>');
            $returns .= ('<td height="30" style="word-break: break-all;"> ' . $row->trackerCode . ' </td>');
            $returns .= ('<td height="30"> ' . $torder . ' </td>');
            $returns .= ('<td height="30"> ' . $row->bol_update_status . '</td>');
            $returns .= ('<td height="30">');
            if ($trackerCode != "")
                if ($logistics == 'DHL Today')
                    $logistics = 'DHL';
                $returns .= ('<input type="checkbox" name="click1" value="' . $bestelnummer . '::' . $trackerCode . '::'. $logistics . '::' . $id . '::' . $id2 . '"> ');
            $returns .= ('</td>');
            $returns .= ('</tr>');
        }
        $result = DB::getSchemaBuilder()->getColumnListing('bol_data');
        $rows = $returns;
        $fields = $result;
        $order_id = $id;
        $bol_rec = DB::table('bol_rec')->where('id', $id)->get()->toArray();
        return View::make("bol::orders_list", compact(array('rows', 'fields', 'bol_rec', 'order_id')));
    }

    public function ordersEmails($id)
    {
        $array = DB::table('bol_data')->distinct()->where('bol_rec_id', $id)->orderBy('id', 'ASC')->get()->toArray();

        $temp = array_unique(array_column($array, 'bestelnummer'));
        $resp = array_intersect_key($array, $temp);

        $ret_str = array();
        if (count($resp) > 0) {
            foreach ($resp as $res) {

                $bestelnummer = $res->id;

                $ret_str[] = $bestelnummer;

            }
        }

        $dist_number = $ret_str;
        $returns = '';

        $result = DB::table('bol_data')->where('bol_rec_id', $id)->whereIn('id', $dist_number)->orderBy('id', 'ASC')->get()->toArray();

        foreach ($result as $row) {
            $bedrijfsnaam_verzending = $row->bedrijfsnaam_verzending;
            if (($bedrijfsnaam_verzending != "")) {
                $id2 = $row->id;
                if (isset($id)) {
                    $id = $id;
                } else {
                    $id = $row->bol_rec_id;
                }

                $trackerCode = $row->trackerCode;
                //$site=$row[$i]['site'];
                $bestelnummer = $row->bestelnummer;

                $besteldatum = $row->besteldatum;
                $dt = date("F j, Y, g:i a", strtotime($besteldatum));
                $best_date_exp = explode("T", $besteldatum);
                $best_date = $best_date_exp[0];
                $producttitel = $row->producttitel;

                $bol_date_row = DB::table('bol_rec')->select("date")->where('id', $row->bol_rec_id)->get();

                $cus_rows = DB::table('bol_data')->select("id", "EAN", "aantal", "producttitel", "prijs", "referentie")->where('bestelnummer', $bestelnummer)->where('bol_rec_id', $id)->get()->toArray();
                $torder = count($cus_rows);

                //$total_order=$bol->get_total_order($id);
                $returns .= ('<tr>');
                $returns .= ('<td height="30">');
                $returns .= $row->bol_rec_id;
                $returns .= ('</td>');
                $returns .= ('<td height="30" style="word-break: break-all;"> ' . $row->bestelnummer . ' </td>');
                $returns .= ('<td height="30"> ' . date("d-m-Y H:i:s", strtotime($bol_date_row[0]->date)) . ' </td>');
                $returns .= ('<td height="30"> ' . $torder . ' </td>');
                $returns .= ('<td height="30"> ' . $row->voornaam_verzending . ' ' . $row->achternaam_verzending . ' </td>');
                $returns .= ('<td height="30"> ' . $row->bedrijfsnaam_verzending . ' </td>');
                $returns .= ('<td height="30"> ' . $row->emailadres . ' </td>');

                if ($row->email_status == 0)
                    $returns .= ('<td height="30"> </td>');
                else
                    $returns .= ('<td height="30"> ' . date("d-m-Y H:i:s", strtotime($row->email_datetime)) . ' </td>');

                // order_no::TrackCode::DHL:bol_rec_id::db_id
                $returns .= ('<td height="30">');
                //if($trackerCode != "")
                $returns .= ('<input type="checkbox" name="click1" value="' . $id2 . '"> ');
                $returns .= ('</td>');
                $returns .= ('</tr>');
            }
        }
        $result = DB::getSchemaBuilder()->getColumnListing('bol_data');
        $rows = $returns;
        $fields = $result;
        $bol_rec = DB::table('bol_rec')->where('id', $id)->get()->toArray();
        return View::make("bol::emails.orders_email_list", compact(array('rows', 'fields', 'bol_rec')));
    }

    public function updateOrders(Request $request)
    {
        $site = $request->site;
        $client = new \Picqer\BolRetailerV8\Client();
		$userId = Auth::id();
               
        $user = DB::table('users')->where('id', $userId)->first();

        if($site == 'bol_nl')
        {
			$client->authenticate($user->bol_client_id, $user->bol_client_secret);
        } else if($site == 'bol_be') {
			$client->authenticate($user->bol_be_client_id, $user->bol_be_client_secret);           
        }   

        $orders = explode(",", $request->post('all_checked'));

        foreach ($orders as $order) {

            $order_arr = explode("::", $order);
          //dd($order_arr);

            // Next thing: we need to fetch an order to create a shipment for.
            $order = $client->getOrder($order_arr[0]);

            for ($i = 0; $i < count($order->orderItems); $i++) {
               
       		
           //$shipmentRequest = new \Picqer\BolRetailerV8\Model\ShipmentRequest;
            //$shipmentRequest->addTransportData(
             //   $order_arr[2],
              //  $order_arr[1]
            //);
            //$shipmentRequest->addOrderItemId($order->orderItems[$i]->orderItemId);
              
          $processStatus = $client->shipOrderItem([
                  	
                'orderItems' => [
                    'orderItemId' => $order->orderItems[$i]->orderItemId
                ],
                //"shipmentReference" => $order_arr[0],
                //"shippingLabelId"=> $order_arr[1],
                'transport' => [
                    'transporterCode' => $order_arr[2],
                    'trackAndTrace' => $order_arr[1]
                ]
            ]
            );
              
            }
            

            // [
            //     'orderItems' => [
            //         'orderItemId' => $order->orderItems[$i]->orderItemId
            //     ],
            //     'shipmentReference' => '',
            //     'shippingLabelId' => '',
            //     'transport' => [
            //         'transporterCode' => $order_arr[2],
            //         'trackAndTrace' => $order_arr[1]
            // ]

            /*

                Demo return

                Picqer\BolRetailer\ProcessStatus Object
                (
                    [data:protected] => Array
                        (
                            [id] => 1
                            [entityId] => 6042823871
                            [eventType] => CONFIRM_SHIPMENT
                            [description] => Confirm shipment for order item 6042823871.
                            [status] => PENDING
                            [createTimestamp] => 2020-03-31T20:41:13+02:00
                            [links] => Array
                                (
                                    [0] => Array
                                        (
                                            [rel] => self
                                            [href] => http://api.bol.com/retailer-demo/process-status/1
                                            [method] => GET
                                        )
                                )
                        )
                )
            */
                
            // if ($processStatus->status == 'Sent') {
                DB::table('bol_data')
                    ->where('id', $order_arr[4])
                    ->update(['bol_update_status' => $processStatus->status]);
            // }

        }

        return redirect('/bol/all_orders');

        // You can now choose to wait until the process completes:
        //
        // ```php
        // $processStatus->waitUntilComplete(20, 3);
        // ```
        //
        // Since the demo API of Bol.com does not support dynamic process statuses, we will not wait.

        // printf("Waiting for process with ID \"%s\"\n", $processStatus->id);

        // exit;

        // $userId = Auth::id();

        // $bol_rec = DB::table('bol_rec')->where('user_id', $userId)->orderBy('id', 'DESC')->paginate(10);

        // return View::make("template/gold/bol/dashboard", compact(array('bol_rec')));
    }

    public function ordersEmailsSend(Request $request)
    {

        $orders = explode(",", $request->post('all_checked'));

        foreach ($orders as $order_id) {

            $bol_data_row = DB::table('bol_data')->where('id', $order_id)->get();

            $email_to = "sajid@leywood.nl";//$bol_data_row[0]->emailadres;
            $bestelnummer = $bol_data_row[0]->bestelnummer;
            $paths = public_path() . "/";
            $str_html = $this->viewinivoice2($bestelnummer);
            $str_html2 = $this->viewpdf2($bestelnummer);

            if ($str_html == "" or $str_html2 == "") {
                $request->session()->flash('alert-warning', 'No Record found!');
                return redirect('/bol/invoice2');
                exit;
            }

            $data = array();

            //invoice pdf
            $preview = DB::table('user_invoice_previews')
                ->select('*')
                ->join('invoice_previews', 'invoice_previews.id', '=', 'user_invoice_previews.invoice_preview_id')
                ->where('user_invoice_previews.user_id', \Auth::id())
                ->where('user_invoice_previews.as_default', 1)
                ->first();
            if (!$preview) {
                Session::flash('alert-warning', 'Please configure Invoice template in Settings tab area.');
                return redirect('/bol/invoice2');
            }
            $servicebanks = DB::table('servicebank')->where('user_id', Auth::id())->first();
            $record = DB::table('bol_data')->where('bestelnummer', $bestelnummer)->first();
            $pdf1 = \PDF::loadView('bol::invoice.download_invoice', compact('record', 'preview','servicebanks'));

            //packing list pdf
            $preview = DB::table('user_packlist_previews')
                ->select('*')
                ->join('packinglist_previews', 'packinglist_previews.id', '=', 'user_packlist_previews.packlist_preview_id')
                ->where('user_packlist_previews.user_id', Auth::id())
                ->where('user_packlist_previews.as_default', 1)
                ->first();
            if (!$preview) {
                Session::flash('alert-warning', 'Please configure packing list template in Settings tab area.');
                return redirect('/bol/invoice2');
            }
            $record = DB::table('bol_data')->where('bestelnummer', $bestelnummer)->first();
            $pdf2 = \PDF::loadView('bol::packinglist-templates.download_packlist', compact('record', 'preview'));
            $bol_data = DB::table('bol_data')->select("bestelnummer", "voornaam_verzending", "achternaam_verzending", "bedrijfsnaam_verzending", "bol_rec_id")->where('bestelnummer', $bestelnummer)->first();
            $bol_rec = DB::table('bol_rec')->select("date")->where('id', $bol_data->bol_rec_id)->first();

            if (!$pdf1)
                $pdf1 = "";
            if (!$pdf2)
                $pdf2 = "";
            if ($bol_data->bedrijfsnaam_verzending != "")
                $name = $bol_data->bedrijfsnaam_verzending;
            else
                $name = $bol_data->voornaam_verzending . " " . $bol_data->achternaam_verzending;

            Mail::send('emails.mail', $data, function ($message) use ($data, $email_to, $pdf1, $pdf2, $bol_data, $bol_rec, $name) {
                $message->from('online@unikoop.nl');
                $message->to($email_to);
                $message->bcc('online@unikoop.nl');
                $message->subject($name . ' Invoice BOL bestelnummer ' . $bol_data->bestelnummer);

                if ($pdf1 != "")
                    $message->attachData($pdf1->output(), $name . ' Invoice BOL bestelnummer ' . $bol_data->bestelnummer . ' ' . date("d-m-Y", strtotime($bol_rec->date)) . '.pdf');

                if ($pdf2 != "")
                    $message->attachData($pdf2->output(), $name . ' Packing_list BOL bestelnummer ' . $bol_data->bestelnummer . ' ' . date("d-m-Y", strtotime($bol_rec->date)) . '.pdf');
            });

            DB::table('bol_data')->where('id', $order_id)->update(['email_status' => 1, 'email_datetime' => date("Y-m-d H:i:s")]);
        }
        return redirect('/bol/all_orders');
        exit;
    }

    public function dhl_csv($site, $id)
    {
        $site = urldecode($site);
        $dist_number = $this->select_distinct_bol_data($id);
        $row = DB::table('bol_data')->where('bol_rec_id', $id)->whereIn('id', $dist_number)->get()->toArray();
        $fileName = "file.csv";
        header('Content-Type: application/csv');
        header('Content-Disposition: attachement; filename="' . $fileName . '";');

        $handle = fopen('php://output', 'w');
        if (count($row) > 0) {
            //concatenation string
            $stringData = '';
            $hd_array = array();
            array_push($hd_array, "Klantnaam", "Contactpersoon", "straat + nummer + ext", "postcode", "stad", "landcode", "tel nummer", "colli", "gewicht", "product code", "emailadres", "ja/nee", "referentie");
            //concatenate
            $stringData .= rtrim(implode(';', $hd_array), ';');
            //new line
            $stringData .= "\r\n";
            foreach ($row as $key) {
                $data_array = array();

                $bestelnummer = $key->bestelnummer;
                $naam = $key->voornaam_verzending . " " . $key->achternaam_verzending;
                $ean = $key->EAN;
                $stad = $key->woonplaats_verzending;
                $straat_nummer_ext = $key->adres_verz_straat . " " . $key->adres_verz_huisnummer;
                $adres_verz_huisnummer_toevoeging = $key->adres_verz_huisnummer_toevoeging;
                if ($adres_verz_huisnummer_toevoeging != "") {
                    $straat_nummer_ext .= "_/ " . $adres_verz_huisnummer_toevoeging;
                }

                $postcode = $key->postcode_verzending;
                $referentie = $key->bestelnummer;
                $Contactpersoon = $key->bedrijfsnaam_verzending;
                if ($Contactpersoon == "") {
                    $Contactpersoon = "Particulier";
                }
                $land_verzending = $key->land_verzending;
                if (strlen($land_verzending) < 3) {
                    $landcode = $land_verzending;
                } else {
                    $landcode = $this->get_country_code($land_verzending);
                }

                array_push($data_array, "$naam", "$Contactpersoon", "$straat_nummer_ext", "$postcode", "$stad", "$landcode", " ", "1", "1", "07", " ", "1", "$referentie");

                //concatenate
                $stringData .= rtrim(implode(';', $data_array), ';');

                //new line
                $stringData .= "\r\n";
            }
            echo($stringData);
        }
        fpassthru($handle);
        fclose($handle);
    }

    public function packing_list($site, $id)
    {
        $str_html = $this->viewpdf($site, $id);
        $bol_rec = DB::table('bol_rec')->select("date")->where('id', $id)->first();
        $pdf = PDF::loadHTML($str_html)->setPaper('a4', 'portrait');
        return $pdf->download('Packing_list BOL ' . date("d-m-Y", strtotime($bol_rec->date)) . '.pdf');
    }

    public function viewpdf($site, $id)
    {
        $site = urldecode($site);
        $dist_number = $this->select_distinct_bol_data($id);

        $row = DB::table('bol_data')->where('bol_rec_id', $id)->whereIn('id', $dist_number)->get()->toArray();
        $paths = public_path() . "/";

        $str_html = '
		<!DOCTYPE html>
		<html>
		<head>
		<link rel="stylesheet" href="' . $paths . 'dhl/css/pdfstyle.css" media="all" />
		<title> Admin - Home  </title></head>';
        if (count($row) > 0) {
            foreach ($row as $key) {
                $bestelnummer = $key->bestelnummer;
                $cus_row = DB::table('bol_data')->select("id", "EAN", "aantal", "producttitel", "prijs", "referentie")->where('bestelnummer', $bestelnummer)->where('bol_rec_id', $id)->get()->toArray();

                $emailadres = $key->emailadres;
                $besteldt = $key->besteldatum;
                $exp_datum = explode("T", $besteldt);

                $besteldatum = $exp_datum[0];

                // solution code
                $aanhef_verzending = $key->aanhef_verzending;

                // first name
                $voornaam_verzending = $key->voornaam_verzending;
                // sur name
                $achternaam_verzending = $key->achternaam_verzending;

                // street name
                $adres_verz_straat = $key->adres_verz_straat;

                // house number
                $adres_verz_huisnummer = $key->adres_verz_huisnummer;

                // house extended number
                $adres_verz_huisnummer_toevoeging = $key->adres_verz_huisnummer_toevoeging;

                // extra addresss information
                $adres_verz_toevoeging = $key->adres_verz_toevoeging;
                // zipcode
                $postcode_verzending = $key->postcode_verzending;

                // city
                $woonplaats_verzending = $key->woonplaats_verzending;

                // landcode
                $land_verzending = $key->land_verzending;

                $str_html .= ' <body> <header class="clearfix">

     			<div id="logo" style="float:left">';

                // header logos
                $log = $paths . "dhl/images/homee_logo.jpg";

                $str_html .= '<img src="' . $paths . 'dhl/images/Homee For your comforts-2.jpg" width="150px" style="margin-right:60px"  /></div>';

                $str_html .= '<div style="float:left; padding-top:30px" ><h2 class="" style="width: 480px; font-weight: bold; font-style: italic"> Bedankt voor je bestelling</h2>
				</div><div id="logo2"  style="float:right"> <img src="' . $paths . 'dhl/images/bol_logo-2.png" width="200" style="" />
							</div>
							</header>';
                // below logos div
                $str_html .= ' <div id="details" class="clearfix"> ';
                // $str_html.=' <h2 class="title01"> Bedankt voor je bestelling</h2>';
                $str_html .= '<div id="client" style="width: 65%; padding-top:10px"> <br>';
                $str_html .= 'Bestelnummer: ' . $bestelnummer . '  <br />';
                $str_html .= 'Geadresseerde email:   <br />';
                $str_html .= $emailadres . '<br />';
                $str_html .= '<b>Verzenddatum: ' . date("d-m-Y", strtotime($besteldatum)) . ' </b> <br />';
                $str_html .= '</div>';

                $str_html .= '<div id="invoice" style="width: 30%" >';
                $str_html .= '<br /> Aan: ';
                $str_html .= '<h2 class="name3">' . $voornaam_verzending . ' ' . $achternaam_verzending . '</h2> ';
                $str_html .= $adres_verz_straat . ' ' . $adres_verz_huisnummer . '<br />';
                if (($adres_verz_huisnummer_toevoeging != "") && ($adres_verz_toevoeging != ""))
                    $str_html .= $adres_verz_huisnummer_toevoeging . ' ' . $adres_verz_toevoeging . '<br />';
                // $str_html.=$adres_verz_huisnummer_toevoeging.' '.$adres_verz_toevoeging.'<br />';
                $str_html .= $postcode_verzending . ' ' . $woonplaats_verzending . '<br />';
                $str_html .= $land_verzending;
                $str_html .= '</div></div>';

                $str_html .= '<h2 class="name2" style="padding-top:30px; padding-bottom:10px">Pakbon</h2>';

                $str_html .= '<table cellspacing="0" cellpadding="0" style="margin-top:5px" class="packing_list">
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
                    $EAN = $value->EAN;
                    $aantal = $value->aantal;
                    $producttitel = $value->producttitel;
                    $referentie = $value->referentie;
                    $str_html .= '<tr>

				            <td class="" width="25%" style="text-align: left">' . $EAN . ' </td>
				            <td style="text-align: center" width="10%">' . $aantal . '</td>
				            <td class="" width="50%" style="text-align: left">' . $producttitel . '</td>
				            <td class="" width="12%" style="text-align: left; padding-left:20px">' . $referentie . '</td>
				          </tr>';
                }
                $tnt = count($cus_row);
                $totalheight = 340;
                $minheight = $tnt * 40;
                $fheight = $totalheight - $minheight;

                $str_html .= '</tbody>
		      </table>';

                $str_html .= '
				<div style="height:' . $fheight . 'px;">
					</div>	';
                $str_html .= ' <table cellspacing="0" cellpadding="0" class="packing_list">
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
									<th class="desc" width="20%"><img src="' . $paths . 'dhl/images/homee_logo-2.jpg" width="120"/></th>

									<th class="desc" width="20%"><img src="' . $paths . 'dhl/images/Lalouchi SINCE 1986-2.jpg" width="150"/></th>
									<th width="20%" class="desc" style="text-align:center" ><img src="' . $paths . 'dhl/images/organic-2.jpg" width="120"/></th>
									<th class="desc" width="20%"><img src="' . $paths . 'dhl/images/Ellaa Cosmetische Argon Olie-2.jpg" width="120"/></td>

									<th width="20%" class="desc"> <img src="' . $paths . 'dhl/images/La Tulipe Noire-2.jpg" width="200" height="50" /></th>
								</tr>
							</table>

							<div class="clear:both;"></div>
							</body>							';
            }
        }


        $str_html .= '
			</html>';
        return $str_html;
    }

    public function create_invoice($site, $id)
    {
        $paths = public_path() . "/";
        $str_html = $this->viewinivoice($site, $id);

        if ($str_html == "") {
            return redirect('/bol/all_orders');

            exit;
        }

        $bol_rec = DB::table('bol_rec')->select("date")->where('id', $id)->first();

        $pdf = PDF::loadHTML($str_html)->setPaper('a4', 'portrait');

        if ($id != "") {
            $path = $paths . "invoice_files/order_id_" . $id . ".pdf";
        } else {
            $path = $paths . "invoice_files/" . $id . "1452.pdf";
        }

        // // $output = $this->doompdf->output();

        $content = $pdf->output();

        file_put_contents($path, $content);
        return $pdf->download('Invoice BOL ' . date("d-m-Y", strtotime($bol_rec->date)) . '.pdf');
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

    public function viewinivoice($site, $id)
    {
        $paths = public_path() . "/";
        $site = urldecode($site);
        $dist_number = $this->select_distinct_bol_data($id);
        $row = DB::table('bol_data')->where('bol_rec_id', $id)->whereIn('id', $dist_number)->get()->toArray();
        $str_html = '
		<!DOCTYPE html>
		<html>
		<head>
		<link rel="stylesheet" href="' . $paths . 'dhl/css/style_invoice.css" media="all" />

		<title> Admin - Home </title></head>';

        if (!empty($row)) {
            $invoice_check = 0;
            foreach ($row as $key) {
                $bedrijfsnaam_verzending = $key->bedrijfsnaam_verzending;
                if (($bedrijfsnaam_verzending != "")) {
                    $invoice_check++;
                    $bestelnummer = $key->bestelnummer;
                    //$cus_row=$this->bol->get_customer_orders($id,$bestelnummer);
                    $cus_row = DB::table('bol_data')->select("id", "EAN", "aantal", "producttitel", "prijs", "referentie")->where('bestelnummer', $bestelnummer)->where('bol_rec_id', $id)->get()->toArray();

                    // create invoice id
                    //$invoice_id=$this->bol->insert_bol_invoice($bestelnummer);

                    $today_dt = date("Y-m-d H:i:s");
                    //   	$data = array(
                    //        'date' => $today_dt,
                    //        'bestelnummer' => $bestelnummer,
                    //    	);
                    // $this->db->insert('bol_data_invoice', $data);
                    // return $this->db->insert_id();

                    $invoice_id = DB::table('bol_data_invoice')->insertGetId(
                        ['date' => $today_dt,
                            'bestelnummer' => $bestelnummer]
                    );

                    $emailadres = $key->emailadres;
                    $besteldt = $key->besteldatum;
                    $exp_datum = explode("T", $besteldt);
                    $dt = date("d-m-Y");
                    $besteldatum = $exp_datum[0];
                    // prijs
                    // solution code
                    $aanhef_verzending = $key->aanhef_verzending;

                    // first name
                    $voornaam_verzending = $key->voornaam_verzending;
                    // sur name
                    $achternaam_verzending = $key->achternaam_verzending;

                    // street name
                    $adres_verz_straat = $key->adres_verz_straat;

                    // house number
                    $adres_verz_huisnummer = $key->adres_verz_huisnummer;

                    // house extended number
                    $adres_verz_huisnummer_toevoeging = $key->adres_verz_huisnummer_toevoeging;

                    // extra addresss information
                    $adres_verz_toevoeging = $key->adres_verz_toevoeging;

                    // zipcode
                    $postcode_verzending = $key->postcode_verzending;

                    // city
                    $woonplaats_verzending = $key->woonplaats_verzending;

                    // landcode
                    $land_verzending = $key->land_verzending;

                    // trackerCode
                    $trackerCode = $key->trackerCode;

                    $str_html .= ' <body> <header class="clearfix">
			     				 <div id="logo" >';

                    // header logos
                    $str_html .= '<img src="' . $paths . 'dhl/images/Homee For your comforts-2.jpg" width="120px" style="margin-right:80px" /></div>';


                    //$str_html.='<div id="logo2"> <h2 class="title01"> FACTUUR</h2>
                    $str_html .= ' <h1 class="title01"> FACTUUR</h1>

								<div id="logo2">

								<img src="' . $paths . 'dhl/images/bol_logo-2.png" width="200"/></div>
							</header>';

                    // below logos div
                    $str_html .= ' <div id="details" class="clearfix"> ';
                    $str_html .= ' ';
                    $str_html .= '<div id="client" style=" width:50% ; float:left;  margin-top:62px" > ';
                    $str_html .= '<span class="inv_list">Factuurnummmer: </span><span class="inv_list">' . $invoice_id . ' </span> <br />';
                    $str_html .= '<span class="inv_list">Klantnummer: </span><span class="inv_list"> </span><br />';
                    $str_html .= '<span class="inv_list">Bestelnummer: </span><span class="inv_list">' . $bestelnummer . '</span><br />';
                    $str_html .= '<span class="inv_list">Geleverd door:</span><span class="inv_list"> DHL Parcel  </span><br />';
                    $str_html .= '<span class="inv_list">Track & Tracé:</span><span class="inv_list">' . $trackerCode . '</span> <br />';
                    // $str_html.='<span class="inv_list">Betalings beschrijving: </span>'.' <br />';
                    // $str_html.='<span class="inv_list">Uw Ref.: </span>'.' <br />';
                    // $str_html.='<span class="inv_list">Uw BTW nr.: </span>'.' <br />';
                    $str_html .= '<span class="inv_list">Datum :</span><span class="inv_list">' . date("d-m-Y", strtotime($besteldatum)) . '</span> <br />';
                    $str_html .= '</div>';

                    $str_html .= '<div id="invoice" style="float:left;" >';
                    $str_html .= '';
                    if ($bedrijfsnaam_verzending != "")
                        $str_html .= '' . $bedrijfsnaam_verzending . '<br />';
                    $str_html .= $voornaam_verzending . ' ' . $achternaam_verzending;
                    $str_html .= '<br>';
                    //$bedrijfsnaam_verzending

                    $str_html .= $adres_verz_straat . ' ' . $adres_verz_huisnummer . '<br />';
                    if (($adres_verz_huisnummer_toevoeging != "") && ($adres_verz_toevoeging != ""))
                        $str_html .= $adres_verz_huisnummer_toevoeging . ' ' . $adres_verz_toevoeging . '<br />';

                    // $str_html.=$adres_verz_huisnummer_toevoeging.' '.$adres_verz_toevoeging.'<br />';
                    $str_html .= $postcode_verzending . ' ' . $woonplaats_verzending . '<br />';

                    $cname = $this->get_country_name($land_verzending);
                    $str_html .= $cname;
                    $str_html .= '</div></div>';

                    //$str_html.='<h2 class="name2">Pakbon</h2>';

                    // <th class="unit" width="13%">Krt%</th>
                    $str_html .= '<table border="0" cellspacing="0" cellpadding="0">
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
                    $total_btw_all = 0;
                    $stukprijs_tot_btw_all = 0;
                    $stukprijs_tot_all = 0;
                    foreach ($cus_row as $value) {
                        $EAN = $value->EAN;
                        $aantal = $value->aantal;
                        $producttitel = $value->producttitel;
                        $referentie = $value->referentie;
                        $prijs_with_btw = $value->prijs;
                        $prijs_with_btw = $prijs_with_btw / $aantal;
                        $per_121 = (121 / 100);
                        $per_21 = (21 / 100);

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
                        $stukprijs2 = $this->money_format('%(#1n', $stukprijs);

                        setlocale(LC_MONETARY, 'nl_NL.UTF-8');
                        $stukprijs_tot2 = $this->money_format('%(#1n', $stukprijs_tot);
                        $str_html .= '<tr>

			            <td class="unit" width="12%" style="vertical-align: top;text-align:left">' . $EAN . ' </td>

			            <td class="desc" width="42%" style="vertical-align: top;text-align:left">' . $producttitel . '</td>

			             <td class="unit" width="7%" style="vertical-align: top;">' . $aantal . '</td>

			              <td class="unit" width="7%" style="vertical-align: top;">' . $stukprijs2 . '</td>

			                <td class="unit" width="7%" style="vertical-align: top;">' . $stukprijs_tot2 . '</td>

			            <td width="5%" class="unit" style="vertical-align: top;">2</td>
			          </tr>';

                    }
                    $bar_image_value = number_format((float)$stukprijs_tot_btw_all, 2, '.', '');

                    // saving image for barcode
                    //$data="data:image/png;base64," . base64_encode(\Picqer\Barcode\BarcodeGeneratorPNG::getBarcode($bar_image_value, \Picqer\Barcode\BarcodeGeneratorPNG::TYPE_CODE_128));

                    $d = new DNS1D();
					$barcode = $d->getBarcodePNG($bar_image_value, "C128");
                    $data = "data:image/png;base64," . $barcode;
                    // echo $d->getBarcodeHTML($bar_image_value, "C128");

                    list($type, $data) = explode(';', $data);
                    list(, $data) = explode(',', $data);
                    $data = base64_decode($data);

                    file_put_contents($paths . 'barcode_image/' . $invoice_id . '.png', $data);

                    $tnt = count($cus_row);
                    $totalheight = 525;
                    $minheight = $tnt * 40;
                    $fheight = $totalheight - $minheight;

                    $str_html .= '</tbody>
			      </table>';

                    $str_html .= '
					<div style="height:' . $fheight . 'px;">
						</div>
						';

                    $str_html .= ' <table border="0" cellspacing="0" cellpadding="0">
			        <tbody>
			        <tr >
			            <th style="padding-top:20px; padding-bottom:20px" colspan="4"><h2 style="margin-left:-78px">Gaarne bij vermelden: 51919/' . $invoice_id . '</h2></th>
			            <th style="padding-top:10px; padding-bottom:10px" colspan="2"><img src="' . $paths . 'barcode_image/' . $invoice_id . '.png" width="130" style="float:right; margin-right: 4px"/></th>
			        </tr>

					<tr >
					<th class="desc">btw &nbsp; &nbsp; %</th>
					<th class="desc">btw &nbsp; Grondslag</th>
					<th class="desc">BTW bedrag</th>
					<td class="desc"> </td>
					<td class="desc" style="width:150px!imported;">Excl. BTW voor korting</td>
					<td class="desc" style="text-align:right;">' . number_format((float)$stukprijs_tot_all, 2, '.', '') . '</td>

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
						 <td  class="desc" style="text-align:right;">' . number_format((float)$stukprijs_tot_all, 2, '.', '') . '</td>
					 </tr>
					 <tr>
						 <td  class="desc">2  &nbsp; &nbsp; 21,00 </td>
						 <td  class="desc">' . number_format((float)$stukprijs_tot_all, 2, '.', '') . ' </td>
						 <td  class="desc">' . number_format((float)$total_btw_all, 2, '.', '') . ' </td>
						  <td class="desc"> </td>
						 <td  class="desc">Totaal BTW</td>
						 <td  class="desc" style="text-align:right;">' . number_format((float)$total_btw_all, 2, '.', '') . '<br><hr style="border-color:grey"></td>
					 </tr>
			        </tbody>
			      </table>
				  <table border="0" cellspacing="0" cellpadding="0">
						<tr>
						    <th class="desc" style="color:blue" width="66%">Unikoop HomeShopping B.V.</td>
							<th class="desc" width="29%">Te betalen €</th>
							<th class="desc" style="text-align:right;"> ' . number_format((float)$stukprijs_tot_btw_all, 2, '.', '') . '  </th>
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
						<th class="desc" width="20%"><img src="' . $paths . 'dhl/images/homee_logo-2.jpg" width="120"/></th>

						<th class="desc" width="20%"><img src="' . $paths . 'dhl/images/Lalouchi SINCE 1986-2.jpg" width="150"/></th>
						<th width="20%" class="desc" style="text-align:center" ><img src="' . $paths . 'dhl/images/organic-2.jpg" width="120"/></th>
						<th class="desc" width="20%"><img src="' . $paths . 'dhl/images/Ellaa Cosmetische Argon Olie-2.jpg" width="120"/></td>

						<th width="20%" class="desc"> <img src="' . $paths . 'dhl/images/La Tulipe Noire-2.jpg" width="200" height="50" /></th>
					</tr>
					</table>
				<div class="clear:both;"></div>
				</body>
				';

                }
            }

            if ($invoice_check == 0) {
                return "";
                exit;
            }
        } else {
            return "";
            exit;
        }

        $str_html .= '
		</html>';
        return $str_html;
    }

    public function delete($site, $id)
    {
        DB::table('bol_rec')->where('id', $id)->delete();

        // $this->db->where('bol_rec_id', $id);
        // $this->db->delete('bol_data');
        DB::table('bol_data')->where('bol_rec_id', $id)->delete();

        // $this->session->set_flashdata('smg', 'Record Delete Successfully');
        // $this->session->flashdata('smg');

        return redirect('/bol/all_orders');
    }

    public function get_country_code($country_name)
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
        $cnt = strtoupper($country_name);
        $code = array_search($cnt, $countries);
        return $code;
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

    public function generate_uuid()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    public function select_distinct_bol_data($id)
    {
        $array = DB::table('bol_data')->distinct()->select("bestelnummer", "id")->where('bol_rec_id', $id)->orderBy('id', 'ASC')->get()->toArray();
        $temp = array_unique(array_column($array, 'bestelnummer'));
        $resp = array_intersect_key($array, $temp);
        $ret_str = array();
        if (count($resp) > 0) {
            foreach ($resp as $res) {
                $bestelnummer = $res->id;
                $ret_str[] = $bestelnummer;
            }
        }
        return $ret_str;
    }

    public function fetchSelect($id)
    {
        $array = DB::table('bol_data')->distinct()->where('bol_rec_id', $id)->orderBy('id', 'ASC')->get()->toArray();
        $temp = array_unique(array_column($array, 'bestelnummer'));
        $resp = array_intersect_key($array, $temp);

        $ret_str = array();
        if (count($resp) > 0) {
            foreach ($resp as $res) {

                $bestelnummer = $res->id;

                $ret_str[] = $bestelnummer;

            }
        }

        $dist_number = $ret_str;
        $returns = '';
        $result = DB::table('bol_data')->where('bol_rec_id', $id)->where('logistiek', null)->whereIn('id', $dist_number)->orderBy('id', 'ASC')->get()->toArray();
        foreach ($result as $row) {
            $id2 = $row->id;
            if (isset($id)) {
                $id = $id;
            } else {
                $id = $row->bol_rec_id;
            }
            $trackerCode = $row->trackerCode;
            //$site=$row[$i]['site'];
            $bestelnummer = $row->bestelnummer;

            $besteldatum = $row->besteldatum;
            $dt = date("F j, Y, g:i a", strtotime($besteldatum));
            $best_date_exp = explode("T", $besteldatum);
            $best_date = $best_date_exp[0];
            $producttitel = $row->producttitel;

            $cus_rows = DB::table('bol_data')->select("id", "EAN", "aantal", "producttitel", "prijs", "referentie")->where('bestelnummer', $bestelnummer)->where('bol_rec_id', $id)->get()->toArray();
            $torder = count($cus_rows);

            //$total_order=$bol->get_total_order($id);
            $returns .= ('<tr>');
            $returns .= ('<td height="30">');
            $returns .= $row->id;
            $returns .= ('</td>');

            $returns .= ('<td height="30">');

            if (is_array($cus_rows)) {
                foreach ($cus_rows as $cus_row) {
                    $producttitel = $cus_row->producttitel;
                    $EAN = $cus_row->EAN;
                    $returns .= ("<b>EAN</b>:" . $EAN . "<br />");
                    $returns .= ("<b>Prijs</b>:" . $cus_row->prijs . "<br />");
                    $returns .= ("<b>Product</b>:" . $producttitel . "<br />");
                }
            }
            $returns .= (' </td>');
            $returns .= ('<td height="30" style="word-break: break-all;"> ' . $row->bestelnummer . ' </td>');
            $returns .= ('<td height="30"> ' . $row->postcode_verzending . ' </td>');
            $returns .= ('<td height="30"> ' . $row->voornaam_verzending . ' </td>');
            $returns .= ('<td height="30"> ' . $row->achternaam_verzending . ' </td>');
            $returns .= ('<td height="30"> ' . $dt . ' </td>');
            $returns .= ('<td height="30"> ' . $torder . ' </td>');
            //$returns.=('<td height="30"> '.$row->bol_update_status.'</td>');
            $returns .= ('<td height="30"><select class="select_class" name="' . $row->id . '" id="select_' . $row->id . '"><option value="">--Select--</option><option value="dhl">DHL</option><option value="dpd">DPD</option><option value="dhl_today">DHL Today</option></select></td>');
            // order_no::TrackCode::DHL:bol_rec_id::db_id
            $returns .= ('<td height="30">');
            $returns .= ('<input type="checkbox" name="click1" onclick="unCheckCheckAll()" class="order_products" id="' . $row->id . '" value="' . $bestelnummer . '::' . $trackerCode . '::DHL' . '::' . $id . '::' . $id2 . '"> ');
            $returns .= ('</td>');
            $returns .= ('</tr>');
        }
        $result = DB::getSchemaBuilder()->getColumnListing('bol_data');
        $rows = $returns;
        $fields = $result;
        $bol_rec = DB::table('bol_rec')->where('id', $id)->get()->toArray();
        return View::make("bol::fetch_select", compact(array('rows', 'fields', 'bol_rec', 'id')));
    }

    public function fetchSelectNext(Request $request)
    {
        $bol = $request->bol_rec_id;
        $user = DB::table('bol_rec')
            ->select('price_per_label', 'credit_limit')
            ->join('users', 'users.id', '=', 'bol_rec.user_id')
            ->where('bol_rec.id', $bol)
            ->first();

        $dhl = DB::table('dhl_label')->first();
        $dpd = DB::table('dpd_label')->first();
        $request_arr = (array)$request->all();
        foreach ($request_arr as $index => $value) {
            if ($value === null)
                unset($request_arr[$index]);
        }

        unset($request_arr['site']);
        unset($request_arr['_token']);
        unset($request_arr['bol_rec_id']);
        $counts = array_count_values($request_arr);
        return View::make("template/gold/fetch_select_next", compact('request_arr', 'counts', 'bol', 'dhl', 'dpd', 'user'));
    }

    public function fetch(Request $request, $id)
    {
        $uid = Auth::id();
        $user = Auth::user();
        $dhl = DB::table('dhl_label')->first();
        $dpd = DB::table('dpd_label')->first();

        $dhl_price = ($dhl->is_active == 'Unikoop') ? $dhl->dhl_unikoop_price : $dhl->dhl_discount_price;
        $dpd_price = ($dpd->is_active == 'Unikoop') ? $dpd->dpd_unikoop_price : $dpd->dpd_discount_price;

        $dhl_total_price = ($user->price_per_label) ? $user->price_per_label : $dhl_price;
        $dpd_total_price = ($user->price_per_label) ? $user->price_per_label_dpd : $dpd_price;

        $dhl_orders = $request->dhl_orders;
        $dpd_orders = $request->dpd_orders;
        $dhl_today_orders = $request->dhl_today_orders;

        $dhl_count = ($dhl_orders) ? count($dhl_orders) : 0;
        $dpd_count = ($dpd_orders) ? count($dpd_orders) : 0;
        $dhl_today_count = ($dhl_today_orders) ? count($dhl_today_orders) : 0;

        $check = DB::table('setting')->where('userid', $uid)->count();
        $display = DB::table('bussines')->where('register_id', $uid)->first();

        /* Register Contacts Details */
        $reg_contacts = DB::table('register_contact')->select('legal_name')->where('register_id',$uid)->first();
        $company_name = $reg_contacts->legal_name;

        $display_name = ($display->display_name ?? 'Homee | Leywood');

        if ($check == 0) {
            \Session::flash('warning', 'Business settings not found.');
            return redirect('/bol/fetch/select/' . $id);
            exit;
        } else {
            $qb = DB::table('setting')->where('userid', $uid)->get()->toArray();
            foreach ($qb as $key) {
                $cid = $key->client_id;
                $delisid = $key->dpd_delisid;
            }
            $checkclientid = $cid;

            if ($dhl_count > 0) {
                if ($checkclientid == '') {
                    \Session::flash('warning', 'DHL client key not found.');
                    return redirect('/bol/fetch/select/' . $id);
                    exit;
                }
            }
            if ($dpd_count > 0) {
                if ($delisid == '') {
                    \Session::flash('warning', 'DPD Delis ID not found.');
                    return redirect('/bol/fetch/select/' . $id);
                    exit;
                }
            }
        }

        /* Calculating total price and checking user wallet and updating */
        //$dhl_total_price = $request->dhl_price;
        //$dpd_total_price = $request->dpd_price;
        $total = ($dhl_total_price * $dhl_count) + ($dpd_total_price * $dpd_count) + ($dhl_total_price * $dhl_today_count);
        $history = false;
        $orders_key = [];
        if ($total > $user->credit_limit || $user->credit_limit == null) {
            \Session::flash('warning', 'Your current wallet balance is low.');
            return redirect('/bol/fetch/select/' . $id);
            exit;
        }

        $buaddr = DB::table('bussiness_address')->where('register_id', $uid)->first();
        $setting = DB::table('setting')->where('userid', $uid)->first();

        if ($dhl_today_count > 0) {
            $history = true;
            $landcode = $this->get_country_code($buaddr->county);
            $array = DB::table('bol_data')->distinct()->select("bestelnummer", "id")->whereIn('id', $dhl_today_orders)->orderBy('id', 'ASC')->get()->toArray();
            $temp = array_unique(array_column($array, 'bestelnummer'));
            $resp = array_intersect_key($array, $temp);
            $ret_str = array();
            if (count($resp) > 0) {
                foreach ($resp as $res) {
                    $bestelnummer = $res->id;
                    $ret_str[] = $bestelnummer;
                }
            }

            $dist_number = $ret_str;
            $rowpe = DB::table('bol_data')->where('bol_rec_id', $id)->whereIn('id', $dist_number)->get()->toArray();
            $response_pdf = "";
            $txt_data = "";
            $file_array = array();
            $i = 1;
            if (count($rowpe) > 0) {
                echo("Total Uniqe Customers:" . count($rowpe) . "<br />");
                foreach ($rowpe as $row) {
                    array_push($orders_key, $row->id);
                    // DHL API //
                    $auth_string = '{"clientId":"' . $setting->client_id . '","key":"' . $setting->dhlkey . '"}';
                    $ch2 = curl_init('https://api-gw.dhlparcel.nl/authenticate/api-key'); //test environment
                    curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch2, CURLOPT_POSTFIELDS, $auth_string);
                    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json'));
                    //json response
                    $auth_response = curl_exec($ch2);
                    $api_key = json_decode($auth_response);
                    $accessToken = $api_key->{'accessToken'};
                    $uuid = $this->generate_uuid();
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://api-gw.dhlparcel.nl/labels');
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, [
                            "Content-Type: application/json; charset=utf-8",
                            "Authorization: Bearer $accessToken",
                            "Accept: application/json",
                        ]
                    );

                    // Create body
                    $bol_data_id = $row->id;
                    $bestelnummer = $row->bestelnummer;
                    $emailadres = $row->emailadres;
                    $besteldt = $row->besteldatum;
                    $exp_datum = explode("T", $besteldt);
                    $besteldatum = $exp_datum[0];
                    $telnummerbezorging = $row->telnummerbezorging;
                    $aanhef_verzending = $row->aanhef_verzending;
                    $voornaam_verzending = $row->voornaam_verzending;
                    $achternaam_verzending = $row->achternaam_verzending;
                    $adres_verz_straat = $row->adres_verz_straat;
                    $adres_verz_huisnummer = $row->adres_verz_huisnummer;
                    $adres_verz_huisnummer_toevoeging = $row->adres_verz_huisnummer_toevoeging;
                    $adres_verz_toevoeging = $row->adres_verz_toevoeging;
                    $more_address = $adres_verz_huisnummer_toevoeging . " " . $adres_verz_toevoeging;
                    if (empty($more_address)) {
                    } else {
                        $more_address = ' ';
                    }
                    if (empty($telnummerbezorging)) {
                    } else {
                        $telnummerbezorging = ' ';
                    }
                    $postcode_verzending = $row->postcode_verzending;
                    $woonplaats_verzending = $row->woonplaats_verzending;
                    $land_verzending = $row->land_verzending;
                    $house_num_ext = $adres_verz_huisnummer . " " . $adres_verz_huisnummer_toevoeging;
                    $json_array = [
                        "labelId" => "$uuid",
                        "parcelTypeKey" => "SMALL",
                        "receiver" => [
                            "name" => [
                                "firstName" => $voornaam_verzending,
                                "lastName" => "$achternaam_verzending",
                                "companyName" => $company_name,
                                "additionalName" => ""
                            ],
                            "address" => [
                                "countryCode" => "$land_verzending",
                                "postalCode" => $postcode_verzending,
                                "city" => "$woonplaats_verzending",
                                "street" => "$adres_verz_straat",
                                "number" => "$house_num_ext",
                                "isBusiness" => false,
                                "addition" => "$more_address"
                            ],
                            "email" => "$emailadres",
                            "phoneNumber" => "$telnummerbezorging"
                        ],
                        "shipper" => [
                            "name" => [

                                "companyName" => $display_name,
                                "additionalName" => ""
                            ],
                            "address" => [
                                "countryCode" => $buaddr->country,
                                "postalCode" => $buaddr->postcode,
                                "city" => $buaddr->city_town,
                                "street" => $buaddr->street,
                                "number" => $buaddr->h_b_number,
                                "isBusiness" => true,
                                "addition" => ""
                            ],
                            "email" => $buaddr->email_admin,
                            "phoneNumber" => "+31 206814411"
                        ],
                        "accountId" => $setting->account_id,
                        "options" => [
                            [
                                "key" => "SDD"
                            ],
                            [
                                "key" => "REFERENCE",
                                "input" => "$bestelnummer"
                            ]
                        ],
                        "isReturnShipment" => false,
                        "pieceNumber" => 1,
                        "quantity" => 1,
                        "product" => "DFY-B2C",
                        "userId" => $setting->dhlkey

                    ];
                    $body = json_encode($json_array);
                    echo "<pre>";

                    // Set body
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
                    // Send the request & save response to $resp
                    $resp = curl_exec($ch);
                    if (!$resp) {
                        die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
                    } else {
                        echo "Response HTTP Status Code : " . curl_getinfo($ch, CURLINFO_HTTP_CODE);
                        $pdf_data_array = json_decode($resp);
                        $response_pdf .= $pdf_data_array->trackerCode;
                        $trackerCode = $pdf_data_array->trackerCode;
                        $today_dt = date("Y-m-d H:i:s");
                        DB::table('dhl_entries')->insert(
                            array(
                                'user_id' => $uid,
                                'dhlcode' => $trackerCode,
                                'date_time' => $today_dt
                            )
                        );

                        $pdf_base64_decoded = base64_decode($pdf_data_array->pdf);
                        $response_pdf .= $pdf_base64_decoded;
                        $path = public_path() . "/pdf_files/" . $bol_data_id . "_" . $i . ".pdf";
                        file_put_contents($path, $pdf_base64_decoded);
                        $txt_data .= $bol_data_id . "_" . $i . ".pdf" . "\r\n";
                        $file_array[] = $bol_data_id . "_" . $i . ".pdf";
                        $name = $bol_data_id . "_" . $i . ".pdf";

                        DB::table('bol_data')
                            ->where('id', $bol_data_id)
                            ->update([
                                'trackerCode' => $trackerCode,
                                'lable_pdf' => $name,
                                'logistiek' => 'DHL Today',
                                'price_charged' => $dhl_total_price,
                                'fetched_date' => now()
                            ]);
                    }
                    curl_close($ch);
                    $i++;
                }
            }
        }

        if ($dhl_count > 0) {
            $history = true;
            $landcode = $this->get_country_code($buaddr->county);
            $array = DB::table('bol_data')->distinct()->select("bestelnummer", "id")->whereIn('id', $dhl_orders)->orderBy('id', 'ASC')->get()->toArray();
            $temp = array_unique(array_column($array, 'bestelnummer'));
            $resp = array_intersect_key($array, $temp);
            $ret_str = array();
            if (count($resp) > 0) {
                foreach ($resp as $res) {
                    $bestelnummer = $res->id;
                    $ret_str[] = $bestelnummer;
                }
            }

            $dist_number = $ret_str;
            $rowpe = DB::table('bol_data')->where('bol_rec_id', $id)->whereIn('id', $dist_number)->get()->toArray();
            $response_pdf = "";
            $txt_data = "";
            $file_array = array();
            $i = 1;
            if (count($rowpe) > 0) {
                echo("Total Uniqe Customers:" . count($rowpe) . "<br />");
                foreach ($rowpe as $row) {
                    array_push($orders_key, $row->id);
                    // DHL API //
                    $auth_string = '{"clientId":"' . $setting->client_id . '","key":"' . $setting->dhlkey . '"}';
                    $ch2 = curl_init('https://api-gw.dhlparcel.nl/authenticate/api-key'); //test environment
                    curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch2, CURLOPT_POSTFIELDS, $auth_string);
                    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json'));
                    //json response
                    $auth_response = curl_exec($ch2);
                    $api_key = json_decode($auth_response);
                    $accessToken = $api_key->{'accessToken'};
                    $uuid = $this->generate_uuid();
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://api-gw.dhlparcel.nl/labels');
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, [
                            "Content-Type: application/json; charset=utf-8",
                            "Authorization: Bearer $accessToken",
                            "Accept: application/json",
                        ]
                    );

                    // Create body
                    $bol_data_id = $row->id;
                    $bestelnummer = $row->bestelnummer;
                    $emailadres = $row->emailadres;
                    $besteldt = $row->besteldatum;
                    $exp_datum = explode("T", $besteldt);
                    $besteldatum = $exp_datum[0];
                    $telnummerbezorging = $row->telnummerbezorging;
                    $aanhef_verzending = $row->aanhef_verzending;
                    $voornaam_verzending = $row->voornaam_verzending;
                    $achternaam_verzending = $row->achternaam_verzending;
                    $adres_verz_straat = $row->adres_verz_straat;
                    $adres_verz_huisnummer = $row->adres_verz_huisnummer;
                    $adres_verz_huisnummer_toevoeging = $row->adres_verz_huisnummer_toevoeging;
                    $adres_verz_toevoeging = $row->adres_verz_toevoeging;
                    $more_address = $adres_verz_huisnummer_toevoeging . " " . $adres_verz_toevoeging;
                    if (empty($more_address)) {
                    } else {
                        $more_address = ' ';
                    }
                    if (empty($telnummerbezorging)) {
                    } else {
                        $telnummerbezorging = ' ';
                    }
                    $postcode_verzending = $row->postcode_verzending;
                    $woonplaats_verzending = $row->woonplaats_verzending;
                    $land_verzending = $row->land_verzending;
                    $house_num_ext = $adres_verz_huisnummer . " " . $adres_verz_huisnummer_toevoeging;
                    $json_array = [
                        "labelId" => "$uuid",
                        "parcelTypeKey" => "SMALL",
                        "receiver" => [
                            "name" => [
                                "firstName" => $voornaam_verzending,
                                "lastName" => "$achternaam_verzending",
                                "companyName" => $company_name,
                                "additionalName" => ""
                            ],
                            "address" => [
                                "countryCode" => "$land_verzending",
                                "postalCode" => $postcode_verzending,
                                "city" => "$woonplaats_verzending",
                                "street" => "$adres_verz_straat",
                                "number" => "$house_num_ext",
                                "isBusiness" => false,
                                "addition" => "$more_address"
                            ],
                            "email" => "$emailadres",
                            "phoneNumber" => "$telnummerbezorging"
                        ],
                        "shipper" => [
                            "name" => [

                                "companyName" => $display_name,
                                "additionalName" => ""
                            ],
                            "address" => [
                                "countryCode" => $buaddr->country,
                                "postalCode" => $buaddr->postcode,
                                "city" => $buaddr->city_town,
                                "street" => $buaddr->street,
                                "number" => $buaddr->h_b_number,
                                "isBusiness" => true,
                                "addition" => ""
                            ],
                            "email" => $buaddr->email_admin,
                            "phoneNumber" => "+31 206814411"
                        ],
                        "accountId" => $setting->account_id,
                        "options" => [
                            [
                                "key" => "DOOR"
                            ],
                            [
                                "key" => "REFERENCE",
                                "input" => "$bestelnummer"
                            ]
                        ],
                        "isReturnShipment" => false,
                        "pieceNumber" => 1,
                        "quantity" => 1,
                        "product" => "DFY-B2C",
                        "userId" => $setting->dhlkey

                    ];
                    $body = json_encode($json_array);
                    echo "<pre>";

                    // Set body
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
                    // Send the request & save response to $resp
                    $resp = curl_exec($ch);
                    if (!$resp) {
                        die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
                    } else {
                        echo "Response HTTP Status Code : " . curl_getinfo($ch, CURLINFO_HTTP_CODE);
                        $pdf_data_array = json_decode($resp);
                        $response_pdf .= $pdf_data_array->trackerCode;
                        $trackerCode = $pdf_data_array->trackerCode;
                        $today_dt = date("Y-m-d H:i:s");
                        DB::table('dhl_entries')->insert(
                            array(
                                'user_id' => $uid,
                                'dhlcode' => $trackerCode,
                                'date_time' => $today_dt
                            )
                        );

                        $pdf_base64_decoded = base64_decode($pdf_data_array->pdf);
                        $response_pdf .= $pdf_base64_decoded;
                        $path = public_path() . "/pdf_files/" . $bol_data_id . "_" . $i . ".pdf";
                        file_put_contents($path, $pdf_base64_decoded);
                        $txt_data .= $bol_data_id . "_" . $i . ".pdf" . "\r\n";
                        $file_array[] = $bol_data_id . "_" . $i . ".pdf";
                        $name = $bol_data_id . "_" . $i . ".pdf";

                        DB::table('bol_data')
                            ->where('id', $bol_data_id)
                            ->update([
                                'trackerCode' => $trackerCode,
                                'lable_pdf' => $name,
                                'logistiek' => 'DHL',
                                'price_charged' => $dhl_total_price,
                                'fetched_date' => now()
                            ]);
                    }
                    curl_close($ch);
                    $i++;
                }
            }
        }

        if ($dpd_count > 0) {
            $history = true;

            // Setting configurations
            $i = 1;
            \Config::set('dpd.delisId', $setting->dpd_delisid);
            \Config::set('dpd.password', $setting->dpd_password);

            $landcode = $this->get_country_code($buaddr->county);
            $array = DB::table('bol_data')->distinct()->select("bestelnummer", "id")->whereIn('id', $dpd_orders)->orderBy('id', 'ASC')->get()->toArray();

            $temp = array_unique(array_column($array, 'bestelnummer'));
            $resp = array_intersect_key($array, $temp);
            $ret_str = array();
            if (count($resp) > 0) {
                foreach ($resp as $res) {
                    $bestelnummer = $res->id;
                    $ret_str[] = $bestelnummer;
                }
            }
            $dist_number = $ret_str;
            $rowpe = DB::table('bol_data')->where('bol_rec_id', $id)->whereIn('id', $dist_number)->get()->toArray();

            if (count($rowpe) > 0) {
                foreach ($rowpe as $row) {

                    array_push($orders_key, $row->id);
                    $bol_data_id = $row->id;

                    app()->dpdShipment->setGeneralShipmentData([
                        'product' => 'CL',
                        'mpsCustomerReferenceNumber1' => $row->bestelnummer
                    ]);

                    app()->dpdShipment->setSender([
                        'name1' => $display_name,
                        'street' => $buaddr->street,
                        'country' => $buaddr->country,
                        'zipCode' => $buaddr->postcode,
                        'city' => $buaddr->city_town,
                        'email' => $buaddr->email_admin,
                        'phone' => $buaddr->phonenumber
                    ]);

                    app()->dpdShipment->setReceiver([
                        'name1' => $row->voornaam_verzending,
                        'name2' => $row->achternaam_verzending,
                        'street' => $row->adres_verz_straat,
                        'houseNo' => $row->adres_verz_huisnummer,
                        'zipCode' => $row->postcode_verzending,
                        'city' => $row->woonplaats_verzending,
                        'country' => $row->land_verzending,
                        'contact' => $row->telnummerbezorging,
                        'phone' => $row->telnummerbezorging,
                        'email' => $row->emailadres,
                        'comment' => null
                    ]);

                    app()->dpdShipment->addParcel([
                        'weight' => 3000,
                        'height' => 15,
                        'width' => 10,
                        'length' => 10
                    ]);

                    app()->dpdShipment->submit();

                    $trackinglinks = app()->dpdShipment->getParcelResponses();
                    $trackerCode = $trackinglinks[0]['airWayBill'];
                    $trackerLink = $trackinglinks[0]['trackingLink'];

                    header('Content-Type: application/pdf');
                    $resp = app()->dpdShipment->getLabels();
                    $today_dt = date("Y-m-d H:i:s");

                    DB::table('dpd_entries')->insert(
                        array(
                            'user_id' => $uid,
                            'dpdcode' => $trackerCode,
                            'trackingLink' => $trackerLink,
                            'date_time' => $today_dt
                        )
                    );

                    $path = public_path() . "/pdf_files/" . $bol_data_id . "_dpd.pdf";
                    file_put_contents($path, $resp);
                    $name = $bol_data_id . "_dpd.pdf";

                    DB::table('bol_data')
                        ->where('id', $bol_data_id)
                        ->update([
                            'trackerCode' => $trackerCode,
                            'lable_pdf' => $name,
                            'logistiek' => 'DPD',
                            'price_charged' => $dpd_total_price,
                            'fetched_date' => now()
                        ]);
                }
            }
        }

        // Creating payment history
        if ($history) {
            $orders_arr = implode(",", $orders_key);
            $rem = $user->credit_limit - $total;
            \DB::table('users')->where('id', $user->id)->update([
                'credit_limit' => $rem
            ]);
            $desc = 'Fetched ' . $dhl_count . ' DHL & ' . $dpd_count . ' DPD Labels.';
            \DB::table('transaction_histories')->insert([
                'user_id' => $uid,
                'amount' => $total,
                'description' => $desc,
                'type' => 'Label',
                'orders' => $orders_arr,
                'created_at' => now()
            ]);
        }

        \Session::flash('success', 'Orders fetched successful.');
        return redirect('/bol/all_orders');
    }

    public function fetchedLabels($id)
    {
        $labels = DB::table('bol_data')->where('bol_rec_id', $id)->where('logistiek', '!=', null)->get();
        return View::make("bol::fetched_labels", compact('labels'));
    }

    public function labelDownload($type,$id)
    {
        if ($type == 'DHL-Today')
            $type = 'DHL Today';
        $array = DB::table('bol_data')
            ->select("lable_pdf")
            ->where('bol_rec_id', $id)
            ->where('logistiek', $type)
            ->orderBy('id', 'ASC')
            ->get();
        $type = str_replace(' ', '-', $type);
        $mzip_name = "myOrders_" . $type . '-' . $id . ".pdf";
        $name = "public/" . $mzip_name;
        if (file_exists($name))
            unlink($name);

        $datadir = public_path() . "/pdf_zip/";
        $outputName = $datadir . $mzip_name;

        $cmd = "gs -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=/screen -dNOPAUSE -dQUIET -dBATCH -sOutputFile=$outputName ";
        foreach ($array as $file) {
            $cmd .= public_path() . "/pdf_files/" . $file->lable_pdf . " ";
        }
        // return $cmd;
        $result = shell_exec($cmd);
        // $file = public_path() . "/pdf_zip/" . $mzip_name;
        $file = Module::assetPath('bol').'/pdf_zip/' . $mzip_name;
        $headers = array(
            'Content-Type: application/pdf',
        );
        
        return response()->download($file, $mzip_name, $headers);
    }

    public function check_invoice(Request $request)
    {
        $paths = public_path() . "/";

        $bestelnummer = $request->post('bestelnummer');

        $email_to = $request->post('email');


        $str_html = $this->viewinivoice2($bestelnummer);

        $str_html2 = $this->viewpdf2($bestelnummer);


        if ($str_html == "" and $str_html2 == "") {
            $request->session()->flash('check_invoice_message', 'No Record found!');

            return redirect('/bol/invoice2');

            exit;
        } else if ($str_html != "" and $str_html2 != "") {
            $request->session()->flash('check_invoice_orderID', $bestelnummer);
            $request->session()->flash('check_invoice_email', $email_to);
            $request->session()->flash('check_invoice_message', '1-2');

            return redirect('/bol/invoice2');

            exit;
        } else if ($str_html == "") {
            $request->session()->flash('check_invoice_orderID', $bestelnummer);
            $request->session()->flash('check_invoice_email', $email_to);
            $request->session()->flash('check_invoice_message', '2');

            return redirect('/bol/invoice2');

            exit;
        } else {
            $request->session()->flash('check_invoice_orderID', $bestelnummer);
            $request->session()->flash('check_invoice_email', $email_to);
            $request->session()->flash('check_invoice_message', '1');

            return redirect('/bol/invoice2');

            exit;
        }

    }

    public function check_in1($id)
    {

        $bestelnummer = $id;
        $paths = public_path() . "/";

        // $bestelnummer = $request->post('bestelnummer');

        $str_html = $this->viewinivoice2($bestelnummer);

        $str_html2 = $this->viewpdf2($bestelnummer);


        if ($str_html != "" and $str_html2 != "") {
            $check_invoice_orderID = $bestelnummer;
            $check_invoice_message = '1-2';

        } else if ($str_html == "") {
            $check_invoice_orderID = $bestelnummer;
            $check_invoice_message = 2;
        } else {
            $check_invoice_orderID = $bestelnummer;
            $check_invoice_message = 1;
        }


        $baseln = DB::table('bol_data')->select("bestelnummer")->where('bestelnummer', $bestelnummer)->first();

        if ($baseln) {
            $bastenumber = $baseln->bestelnummer;
            $bol_data = DB::table('bol_data')->select("bestelnummer", "voornaam_verzending", "achternaam_verzending", "bedrijfsnaam_verzending", "bol_rec_id")->where('bestelnummer', $bestelnummer)->first();

            if ($bol_data->bedrijfsnaam_verzending != "") {
                $name = $bol_data->bedrijfsnaam_verzending;
            } else {
                $name = $bol_data->voornaam_verzending . " " . $bol_data->achternaam_verzending;
            }

            $email = DB::table('bol_data')->select("emailadres")->where('bestelnummer', $bestelnummer)->first();

            if ($email) {
                $data = $email->emailadres;
            }
            return [
                'o_no' => $bastenumber,
                'email' => $data,
                'check_invoice_orderID' => $check_invoice_orderID,
                'check_invoice_message' => $check_invoice_message,
                'name' => $name,
            ];

        } else {
            $response = [
                'message' => 'N/A'
            ];
            echo json_encode($response);
        }
    }

    public function check_invoice2(Request $request)
    {
        $paths = public_path() . "/";

        $bestelnummer = $request->post('bestelnummer');
        $baseln = DB::table('bol_data')
            ->select('*')
            ->join('bol_rec', 'bol_rec.id', '=', 'bol_data.bol_rec_id')
            ->where('bol_data.bestelnummer',$bestelnummer)
            ->where('bol_rec.user_id',Auth::id())
            ->first();

        if ($baseln) {
            $str_html = $this->viewinivoice2($bestelnummer);
            $str_html2 = $this->viewpdf2($bestelnummer);
            if ($str_html != "" and $str_html2 != "") {
            $check_invoice_orderID = $bestelnummer;
            $check_invoice_message = '1-2';

        } else if ($str_html == "") {
            $check_invoice_orderID = $bestelnummer;
            $check_invoice_message = 2;
        } else {
            $check_invoice_orderID = $bestelnummer;
            $check_invoice_message = 1;
        }

            $bastenumber = $baseln->bestelnummer;
            $bol_data = DB::table('bol_data')->select("bestelnummer", "voornaam_verzending", "achternaam_verzending", "bedrijfsnaam_verzending", "bol_rec_id")->where('bestelnummer', $bestelnummer)->first();

            if ($bol_data->bedrijfsnaam_verzending != "") {
                $name = $bol_data->bedrijfsnaam_verzending;
            } else {
                $name = $bol_data->voornaam_verzending . " " . $bol_data->achternaam_verzending;
            }

            $email = DB::table('bol_data')->select("emailadres")->where('bestelnummer', $bestelnummer)->first();

            if ($email) {
                $data = $email->emailadres;
            }
            return [
                'o_no' => $bastenumber,
                'email' => $data,
                'check_invoice_orderID' => $check_invoice_orderID,
                'check_invoice_message' => $check_invoice_message,
                'name' => $name,
            ];

        } else {
            $response = [
                'message' => 'No record found against this Order ID'
            ];
            echo json_encode($response);
        }
    }

    public function viewinivoice2($bestelnummer)
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

                //if(($bedrijfsnaam_verzending != "")) {
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
						</div>
						';

                    $str_html.=' <table border="0" cellspacing="0" cellpadding="0">
			        <tbody>
			        <tr >
			            <th style="padding-top:20px; padding-bottom:20px" colspan="4"><h2 style="margin-left:-78px">Gaarne bij vermelden: 51919/'.$invoice_id.'</h2></th>
			            <th style="padding-top:10px; padding-bottom:10px" colspan="2"><img src="'.$paths.'barcode_image/'.$invoice_id.'.png" width="130" style="float:right; margin-right: 4px"/></th>
			        </tr>

					<tr >
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

//                }
            }

            if($invoice_check == 0)
            {
                return "";

                exit;
            }

        }
        else
        {
            return "";

            exit;
        }

        $str_html.='</html>';

        return $str_html;
    }

    public function print_invoice(Request $request)
	{
		$paths = public_path()."/";

		$bestelnummer = $request->post('bestelnummer');

		$email_to = $request->post('email');

		$str_html = $this->viewinivoice3($bestelnummer);

		if($str_html != "")
		{
			$request->session()->flash('print_invoice_orderID', $bestelnummer);
			$request->session()->flash('print_invoice_email', $email_to);
			$request->session()->flash('print_invoice_message', '1');

			return redirect('/bol/invoice2');

			exit;
		}
		else
		{
			$request->session()->flash('print_invoice_message', 'No Record found!');

			return redirect('/bol/invoice2');

			exit;
		}
	}

	public function create_invoice_2($bestelnummer)
	{
		$paths = public_path()."/";

		$str_html=$this->viewinivoice2($bestelnummer);

		$data = array(
			);

		$bol_data = DB::table('bol_data')->select("bestelnummer", "voornaam_verzending", "achternaam_verzending", "bedrijfsnaam_verzending", "bol_rec_id")->where('bestelnummer', $bestelnummer)->first();

		$bol_rec = DB::table('bol_rec')->select("date")->where('id', $bol_data->bol_rec_id)->first();

		if($bol_data->bedrijfsnaam_verzending != "")
			$name = $bol_data->bedrijfsnaam_verzending;
		else
			$name = $bol_data->voornaam_verzending." ".$bol_data->achternaam_verzending;

		$pdf = PDF::loadHTML($str_html)->setPaper('a4', 'portrait');

		return $pdf->download($name.' Invoice BOL bestelnummer '.$bol_data->bestelnummer.' '.date("d-m-Y", strtotime($bol_rec->date)).'.pdf');
	}

	public function create_invoice_3($bestelnummer)
	{
		$paths = public_path()."/";

		$str_html=$this->viewinivoice3($bestelnummer);

		$data = array(
			);

		$bol_data = DB::table('bol_data')->select("bestelnummer", "voornaam_verzending", "achternaam_verzending", "bedrijfsnaam_verzending", "bol_rec_id")->where('bestelnummer', $bestelnummer)->first();

		$bol_rec = DB::table('bol_rec')->select("date")->where('id', $bol_data->bol_rec_id)->first();

		if($bol_data->bedrijfsnaam_verzending != "")
			$name = $bol_data->bedrijfsnaam_verzending;
		else
			$name = $bol_data->voornaam_verzending." ".$bol_data->achternaam_verzending;

		$pdf = PDF::loadHTML($str_html)->setPaper('a4', 'portrait');

		return $pdf->download($name.' Invoice BOL bestelnummer '.$bol_data->bestelnummer.' '.date("d-m-Y", strtotime($bol_rec->date)).'.pdf');
	}

	public function create_packing_list($bestelnummer)
	{
		$paths = public_path()."/";

		$str_html=$this->viewpdf2($bestelnummer);

		$data = array(
			);

		$bol_data = DB::table('bol_data')->select("bestelnummer", "voornaam_verzending", "achternaam_verzending", "bedrijfsnaam_verzending", "bol_rec_id")->where('bestelnummer', $bestelnummer)->first();

		$bol_rec = DB::table('bol_rec')->select("date")->where('id', $bol_data->bol_rec_id)->first();

		if($bol_data->bedrijfsnaam_verzending != "")
			$name = $bol_data->bedrijfsnaam_verzending;
		else
			$name = $bol_data->voornaam_verzending." ".$bol_data->achternaam_verzending;

		$pdf = PDF::loadHTML($str_html)->setPaper('a4', 'portrait');

		return $pdf->download($name.' Packing_list BOL bestelnummer '.$bol_data->bestelnummer.' '.date("d-m-Y", strtotime($bol_rec->date)).'.pdf');
	}

    public function download_packing_list($bestelnummer){

	$paths = public_path()."/";

		$str_html=$this->viewpdf2($bestelnummer);

		$data = array(
			);

		$bol_data = DB::table('bol_data')->select("bestelnummer", "voornaam_verzending", "achternaam_verzending", "bedrijfsnaam_verzending", "bol_rec_id")->where('bestelnummer', $bestelnummer)->first();

		$bol_rec = DB::table('bol_rec')->select("date")->where('id', $bol_data->bol_rec_id)->first();

		if($bol_data->bedrijfsnaam_verzending != "")
			$name = $bol_data->bedrijfsnaam_verzending;
		else
			$name = $bol_data->voornaam_verzending." ".$bol_data->achternaam_verzending;

		$pdf = PDF::loadHTML($str_html)->setPaper('a4', 'portrait');

		return $pdf->download($name.' Packing_list BOL bestelnummer '.$bol_data->bestelnummer.' '.date("d-m-Y", strtotime($bol_rec->date)).'.pdf');



   }

	public function invoice_submit(Request $request)
	{
		$paths = public_path()."/";
		$bestelnummer = $request->post('bestelnummer');
		$email_to = $request->post('email');

		$str_html=$this->viewinivoice2($bestelnummer);
		$str_html2=$this->viewpdf2($bestelnummer);
		if($str_html == "" or $str_html2 == "")
		{
			$request->session()->flash('alert-warning', 'No Record found!');
			return redirect('/bol/invoice2');
			exit;
		}
		$data = array();
        $bol_data = DB::table('bol_data')->select("bestelnummer", "voornaam_verzending", "achternaam_verzending", "bedrijfsnaam_verzending", "bol_rec_id")->where('bestelnummer', $bestelnummer)->first();

		$bol_rec = DB::table('bol_rec')->select("date")->where('id', $bol_data->bol_rec_id)->first();


		if($str_html != "")
			$pdf = PDF::loadHTML($str_html)->setPaper('a4', 'portrait');
		else
			$pdf = "";

		if($str_html2 != "")
			$pdf2 = PDF::loadHTML($str_html2)->setPaper('a4', 'portrait');
		else
			$pdf2 = "";

		if($bol_data->bedrijfsnaam_verzending != "")
			$name = $bol_data->bedrijfsnaam_verzending;
		else
			$name = $bol_data->voornaam_verzending." ".$bol_data->achternaam_verzending;

		Mail::send('emails.mail', $data, function($message) use ($data, $email_to, $pdf, $pdf2, $str_html, $str_html2, $bol_data, $bol_rec, $name){
            $message->from('online@unikoop.nl');
            $message->to($email_to);
            $message->subject($name.' Invoice BOL bestelnummer '.$bol_data->bestelnummer);
            //Attach PDF doc

			if($str_html != "")
				$message->attachData($pdf->output(), $name.' Invoice BOL bestelnummer '.$bol_data->bestelnummer.' '.date("d-m-Y", strtotime($bol_rec->date)).'.pdf');

			if($str_html2 != "")
				$message->attachData($pdf2->output(), $name.' Packing_list BOL bestelnummer '.$bol_data->bestelnummer.' '.date("d-m-Y", strtotime($bol_rec->date)).'.pdf');
        });

		return redirect('/bol/invoice2');

		exit;
		// if($bestelnummer != ""){
		// 	$path = $paths."invoice_files/order_id_".$id.".pdf";
		// }
		// else{
		// 	$path = $paths."invoice_files/".$id."1452.pdf";
		// }

		// // $output = $this->doompdf->output();

		// $content = $pdf->output();

		// file_put_contents($path, $content);

		// $this->doompdf->stream();

		return $pdf->download('invoice.pdf');
	}

	public function invoice2()
	{
        $default = EmailTemplate::where('user_id',Auth::id())->where('email_type','Order Invoice')->where('status',1)->first();
        return View::make("bol::invoice.create_invoice", compact('default'));
	}

	public function invoice_submit2(Request $request)
	{
        $file1 = '';
        $pdf1 = '';
        $file2 = '';
        $pdf2 = '';
        $bestelnummer = $request->post('o_no');
		$email_to = $request->post('email');

        if($request->post('sinvoice_input') == 'yes') {
            //invoice pdf
            $preview = DB::table('user_invoice_previews')
                ->select('*')
                ->join('invoice_previews', 'invoice_previews.id', '=', 'user_invoice_previews.invoice_preview_id')
                ->where('user_invoice_previews.user_id', \Auth::id())
                ->where('user_invoice_previews.as_default', 1)
                ->first();
            if (!$preview) {
                Session::flash('danger', 'Please configure Invoice template in Settings tab area.');
                return redirect('/bol/invoice');
            }

            $record = DB::table('bol_data')->where('bestelnummer', $bestelnummer)->first();
            $pdf1 = \PDF::loadView('bol::invoice.download_invoice', compact('record', 'preview'));
            $file1 = $record->voornaam_verzending . ' ' . $record->achternaam_verzending . ' Invoice bestelnummer #' . $bestelnummer . '.pdf';
        }
        if($request->post('tpackinglist_input') == 'yes') {
            //packing list pdf
            $preview = DB::table('user_packlist_previews')
                ->select('*')
                ->join('packinglist_previews', 'packinglist_previews.id', '=', 'user_packlist_previews.packlist_preview_id')
                ->where('user_packlist_previews.user_id', Auth::id())
                ->where('user_packlist_previews.as_default', 1)
                ->first();
            if (!$preview) {
                Session::flash('danger', 'Please configure packing list template in Settings tab area.');
                return redirect('/bol/invoice');
            }
            $record = DB::table('bol_data')->where('bestelnummer', $bestelnummer)->first();
            $pdf2 = \PDF::loadView('bol::packinglist-templates.download_packlist', compact('record', 'preview'));
            $file2 = $record->voornaam_verzending . ' ' . $record->achternaam_verzending . ' Invoice bestelnummer #' . $bestelnummer . '.pdf';
        }
        if($request->post('finvoice_input') && $request->post('fpackinglist_input') == 'yes') {
            //invoice pdf
            $preview = DB::table('user_invoice_previews')
                ->select('*')
                ->join('invoice_previews', 'invoice_previews.id', '=', 'user_invoice_previews.invoice_preview_id')
                ->where('user_invoice_previews.user_id', \Auth::id())
                ->where('user_invoice_previews.as_default', 1)
                ->first();
            if (!$preview) {
                Session::flash('danger', 'Please configure Invoice template in Settings tab area.');
                return redirect('/bol/invoice');
            }
            $servicebanks = DB::table('servicebank')->where('user_id', Auth::id())->first();
            $record = DB::table('bol_data')->where('bestelnummer', $bestelnummer)->first();
            $pdf1 = \PDF::loadView('bol::invoice.download_invoice', compact('record', 'preview','servicebanks'));
            $file1 = $record->voornaam_verzending . ' ' . $record->achternaam_verzending . ' Invoice bestelnummer #' . $bestelnummer . '.pdf';

            //packing list pdf
            $preview = DB::table('user_packlist_previews')
                ->select('*')
                ->join('packinglist_previews', 'packinglist_previews.id', '=', 'user_packlist_previews.packlist_preview_id')
                ->where('user_packlist_previews.user_id', Auth::id())
                ->where('user_packlist_previews.as_default', 1)
                ->first();
            if (!$preview) {
                Session::flash('danger', 'Please configure packing list template in Settings tab area.');
                return redirect('/bol/invoice');
            }
            $record = DB::table('bol_data')->where('bestelnummer', $bestelnummer)->first();
            $pdf2 = \PDF::loadView('bol::packinglist-templates.download_packlist', compact('record', 'preview'));
            $file2 = $record->voornaam_verzending . ' ' . $record->achternaam_verzending . ' Invoice bestelnummer #' . $bestelnummer . '.pdf';
        }

        $cc = explode(',', $request->cc);
        $message = $request->content;
        $data = array(
          'subject' => $request->subject,
          'message' => $message,
          'file1' => $file1,
          'pdf1' => $pdf1,
          'file2' => $file2,
          'pdf2' => $pdf2,
        );
        if($cc[0] == ''){
            Mail::to($email_to)->bcc('online@unikoop.nl')->send(new MyDemoMail($data));
            $request->session()->flash('success', 'email Sent Successfully!');
            return redirect('/bol/invoice');
        } else {
            Mail::to($email_to)->cc($cc)->bcc('online@unikoop.nl')->send(new MyDemoMail($data));
            $request->session()->flash('success', 'email Sent Successfully!');
            return redirect('/bol/invoice');
        }
    }

	public function viewinivoice3($bestelnummer)
	{
		//$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();

		//$generator = \Picqer\Barcode\BarcodeGeneratorPNG::;

		// $path2="/opt/bitnami/apache2/htdocs/";
		// $paths=$path2.$this->theme->active_theme_path();
		// $paths=$this->theme->active_theme_path();

		$paths = public_path()."/";

		//$site=urldecode($site);

		// $this->load->model('dhl/bol');

		// $row=$this->bol->select_all_data2($id);

		// $dist_number=$this->select_distinct_bol_data($id);

		$row = DB::table('bol_data')->where('bestelnummer', $bestelnummer)->get()->toArray();

		if(!isset($row) or count($row) == 0)
		{
			return false;
			exit;
		}

		// echo "<pre>";
		//  print_r($row);
		//  echo "</pre>";
		$str_html='
		<!DOCTYPE html>
		<html>
		<head>
		<link rel="stylesheet" href="'.$paths.'dhl/css/style_invoice.css" media="all" />

		<title> Admin - Home  </title></head>';

		if(!empty($row)){

			$invoice_check = 0;

			foreach ($row as $key )
			{
				$bedrijfsnaam_verzending=$key->bedrijfsnaam_verzending;


				//if(($bedrijfsnaam_verzending != ""))
				//{
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
						$stukprijs2 = money_format('%(#1n', $stukprijs);

						setlocale(LC_MONETARY, 'nl_NL.UTF-8');
						$stukprijs_tot2 = money_format('%(#1n', $stukprijs_tot);
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

					// $d = new DNS1D();
              		$d = new DNS1D();

					$data="data:image/png;base64," . $d->getBarcodePNG($bar_image_value, "C128");
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
						</div>
						';

			      $str_html.=' <table border="0" cellspacing="0" cellpadding="0">
			        <tbody>
			        <tr >
			            <th style="padding-top:20px; padding-bottom:20px" colspan="4"><h2 style="margin-left:-78px">Gaarne bij vermelden: 51919/'.$invoice_id.'</h2></th>
			            <th style="padding-top:10px; padding-bottom:10px" colspan="2"><img src="'.$paths.'barcode_image/'.$invoice_id.'.png" width="130" style="float:right; margin-right: 4px"/></th>
			        </tr>

					<tr >
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

				//}
			}

			if($invoice_check == 0)
			{
				return "";

				exit;
			}

		}
		else
		{
			return "";

			exit;
		}

		$str_html.='
		</html>';

		return $str_html;
	}

	public function viewpdf2($bestelnummer)
	{
		//$site=urldecode($site);

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
							</body>							';


			$str_html.='
			</html>';
		}
		else
		{
			return "";

			exit;
		}

		return $str_html;
	}

}
