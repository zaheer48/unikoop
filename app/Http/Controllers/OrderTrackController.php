<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderTrackController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'username'=> 'required',
            'email'=> 'email|required',
            'password_confirmation'=> 'required',
            'password'=> 'required|confirmed'
        ]);
        $user = Client::create($request->all());
        return view('trackorder', compact('user'));
    }

    public function check_order(Request $request)
    {
        dd($request->all());
        $bestelnummer = $request->post('bestelnummer');
        $platform = $request->post('platform');
        $baseln = DB::table('users_orders')
            ->select('*')
            ->where('order_id',$bestelnummer)
            ->first();

        if ($baseln) {
            $bol_data = DB::table('bol_data')->select("bestelnummer", "emailadres", "trackerCode", "bol_rec_id")->where('bestelnummer', $bestelnummer)->first();  
            // return [
            //     'o_no' => $bastenumber,
            //     'email' => $data,
            //     'name' => $name,
            // ];

        } elseif (Auth::check()) {
            $bol_data = DB::table('bol_data')->select("bestelnummer", "emailadres", "trackerCode", "bol_rec_id")
                                ->join('bol_rec', 'bol_rec.id', '=', 'bol_data.bol_rec_id')
                                ->where('bol_data.bestelnummer',$bestelnummer)
                                ->where('bol_rec.user_id',Auth::id())
                                ->first();
            DB::table('users_orders')->insert([
                'order_id'=> $bestelnummer,
                'user_id'=> Auth::id(),
                'platform'=> $platform,
            ]);
            // if($bol_data){
            //     $updation = DB::table('users_orders')->where(['order_id'=> $bestelnummer])->first();
            //     if(!$updation)
            //     {
            //         DB::table('users_orders')->insert([
            //             'order_id'=> $bestelnummer,
            //             'user_id'=> Auth::id(),
            //             'platform'=> $platform,
            //         ]);
            //     }
            // $bastenumber2 = $baseln2->bestelnummer;

            // $bol_data = DB::table('bol_data')->select("bestelnummer","emailadres", "voornaam_verzending", "achternaam_verzending", "bedrijfsnaam_verzending", "bol_rec_id")->where('bestelnummer', $bestelnummer)->first();
            
            // if ($bol_data->bedrijfsnaam_verzending != "") {
            //     $name = $bol_data->bedrijfsnaam_verzending;
            // } else {
            //     $name = $bol_data->voornaam_verzending . " " . $bol_data->achternaam_verzending;
            // }

            // if ($bol_data) {
            //     $data = $bol_data->emailadres;
            // }
            // return [
            //     'o_no' => $bastenumber2,
            //     'email' => $data,
            //     'name' => $name,
            // ];
            // }
        } else{
            $response = [
                'message' => 'redirect',
                'route' => route('register'),
            ];
            echo json_encode($response);
            // return redirect()->to('/register')->send();
        }

        $track_orser_response = $this->trackOrder($bol_data->trackerCode, $platform);

        $response = [
            'message' => 'success',
            'handled_by' => $platform,
            'response' => $track_orser_response,
        ];
        return json_encode($response);
        // return $track_orser_response;

    }

    public function trackOrder($trackerCode, $platform)
    {
        if($platform == 'DHL'){
            $user = Auth::user();
            $setting = DB::table('setting')->where('userid', $user->id)->first();

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api-gw.dhlparcel.nl/track-trace?key='.$trackerCode,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Cookie: __cfruid=7dbd7bc116db0cfffc4bfacf51424cfee593352a-1675772273'
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            return $response;
            
        } else if($platform == 'DPD'){
            // $history = true;

            // // Setting configurations
            // $i = 1;
            // \Config::set('dpd.delisId', $setting->dpd_delisid);
            // \Config::set('dpd.password', $setting->dpd_password);

            // $landcode = $this->get_country_code($buaddr->county);
            // $array = DB::table('bol_data')->distinct()->select("bestelnummer", "id")->whereIn('id', $dpd_orders)->orderBy('id', 'ASC')->get()->toArray();

            // $temp = array_unique(array_column($array, 'bestelnummer'));
            // $resp = array_intersect_key($array, $temp);
            // $ret_str = array();
            // if (count($resp) > 0) {
            //     foreach ($resp as $res) {
            //         $bestelnummer = $res->id;
            //         $ret_str[] = $bestelnummer;
            //     }
            // }
            // $dist_number = $ret_str;
            // $rowpe = DB::table('bol_data')->where('bol_rec_id', $id)->whereIn('id', $dist_number)->get()->toArray();

            // if (count($rowpe) > 0) {
            //     array_push($orders_key, $row->id);
            //     $bol_data_id = $row->id;

            //     app()->dpdShipment->setGeneralShipmentData([
            //         'product' => 'CL',
            //         'mpsCustomerReferenceNumber1' => $row->bestelnummer
            //     ]);

            //     app()->dpdShipment->setSender([
            //         'name1' => $display_name,
            //         'street' => $buaddr->street,
            //         'country' => $buaddr->country,
            //         'zipCode' => $buaddr->postcode,
            //         'city' => $buaddr->city_town,
            //         'email' => $buaddr->email_admin,
            //         'phone' => $buaddr->phonenumber
            //     ]);

            //     app()->dpdShipment->setReceiver([
            //         'name1' => $row->voornaam_verzending,
            //         'name2' => $row->achternaam_verzending,
            //         'street' => $row->adres_verz_straat,
            //         'houseNo' => $row->adres_verz_huisnummer,
            //         'zipCode' => $row->postcode_verzending,
            //         'city' => $row->woonplaats_verzending,
            //         'country' => $row->land_verzending,
            //         'contact' => $row->telnummerbezorging,
            //         'phone' => $row->telnummerbezorging,
            //         'email' => $row->emailadres,
            //         'comment' => null
            //     ]);

            //     app()->dpdShipment->addParcel([
            //         'weight' => 3000,
            //         'height' => 15,
            //         'width' => 10,
            //         'length' => 10
            //     ]);

            //     app()->dpdShipment->submit();

            //     $trackinglinks = app()->dpdShipment->getParcelResponses();
            //     $trackerCode = $trackinglinks[0]['airWayBill'];
            //     $trackerLink = $trackinglinks[0]['trackingLink'];

            //     header('Content-Type: application/pdf');
            //     $resp = app()->dpdShipment->getLabels();
            //     $today_dt = date("Y-m-d H:i:s");

            //     DB::table('dpd_entries')->insert(
            //         array(
            //             'user_id' => $uid,
            //             'dpdcode' => $trackerCode,
            //             'trackingLink' => $trackerLink,
            //             'date_time' => $today_dt
            //         )
            //     );

            //     // $path = public_path() . "/modules/bol/pdf_files/" . $bol_data_id . "_dpd.pdf";
            //     $path = Module::assetPath('bol').'/pdf_files/' . $bol_data_id . "_dpd.pdf";
            //     file_put_contents($path, $resp);
            //     $name = $bol_data_id . "_dpd.pdf";

            //     DB::table('bol_data')
            //         ->where('id', $bol_data_id)
            //         ->update([
            //             'trackerCode' => $trackerCode,
            //             'lable_pdf' => $name,
            //             'logistiek' => 'DPD',
            //             'price_charged' => $dpd_total_price,
            //             'fetched_date' => now()
            //         ]);
            // }
        }
    }
}
