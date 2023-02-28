<?php

namespace Modules\TrackOrder\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use DB;

class TrackOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('trackorder::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('trackorder::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'username'=> 'required',
            'email'=> 'email|required',
            'password_confirmation'=> 'required',
            'password'=> 'required|confirmed'
        ]);
        $user = Client::create($request->all());
        return view('trackorder::trackorder', compact('user'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('trackorder::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('trackorder::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function check_order(Request $request)
    {
        $trackerCode_bestel = $request->post('bestelnummer');
        $platform = $request->post('platform');

        $bol_data = DB::table('bol_data')->select("*")
                            ->join('bol_rec', 'bol_rec.id', '=', 'bol_data.bol_rec_id')
                            ->where('bol_data.trackerCode', $trackerCode_bestel)
                            ->orWhere('bol_data.bestelnummer', $trackerCode_bestel)
                            ->first();

        if($bol_data){
            $user_order = DB::table('users_orders')
                                ->select('*')
                                ->where('order_id',$bol_data->bestelnummer)
                                ->first();

            if (!$user_order && !Auth::check()) {
                $response = [
                    'message' => 'redirect',
                    'route' => route('register'),
                ];
                return json_encode($response);
            } else if(!$user_order){
                DB::table('users_orders')->insert([
                    'order_id'=> $bol_data->bestelnummer,
                    'user_id'=> Auth::id(),
                    'platform'=> $platform,
                ]);
            }

            if(str_replace(url('/'), '', url()->previous()) == '/invoice'){                
                $order = new InvoiceController;
                $email = Auth::check() ? Auth::user()->email : DB::table('users')->where('id', $user_order->user_id)->pluck("email");
                return $order->checkInvoice($bol_data, $email);
            } else
                $track_order_response = $this->trackOrder($bol_data->trackerCode, $platform);            
            
            $response = [
                'message' => 'success',
                'handled_by' => $platform,
                'response' => $track_order_response,
                'tracking_code' => $trackerCode_bestel,
            ];
            return json_encode($response);
        } else {
            $response = [
                'message' => 'failure',
                'response' => 'No record found against this ID.',
                'tracking_code' => $trackerCode_bestel,
            ];
            return json_encode($response);
        }
    }

    public function trackOrder($trackerCode, $platform)
    {
        if($platform == 'DHL'){
            $user = Auth::user();
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
            $uid = Auth::id();
            $user = Auth::user();
            $buaddr = DB::table('bussiness_address')->where('register_id', $uid)->first();
            $setting = DB::table('setting')->where('userid', $uid)->first();
            
            // Setting configurations
            $i = 1;
            \Config::set('dpd.delisId', $setting->dpd_delisid);
            \Config::set('dpd.password', $setting->dpd_password);

            // $landcode = $this->get_country_code($buaddr->county);
            // $array = DB::table('bol_data')->distinct()->select("bestelnummer", "id")->where('id', $dpd_orders)->orderBy('id', 'ASC')->get()->toArray();
            dd(app()->dpdTracking->getStatus('1548946903'));
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

                    // $path = public_path() . "/modules/bol/pdf_files/" . $bol_data_id . "_dpd.pdf";
                    $path = Module::assetPath('bol').'/pdf_files/' . $bol_data_id . "_dpd.pdf";
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
    }
}
