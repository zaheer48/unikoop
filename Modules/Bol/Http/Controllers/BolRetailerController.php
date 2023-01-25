<?php

namespace Modules\Bol\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Bol_data;
use App\Bol_rec;
// use Picqer\BolRetailerV8\Client;

use App\Models\User;
use App\Models\Platform;
use App\Setting;
use Auth;
use DB;

class BolRetailerController extends Controller
{
    public function __construct()
    {
        // \Picqer\BolRetailer\Client::setDemoMode(false);
        // \Picqer\BolRetailer\Client::setCredentials(
        //     '9244ebd1-cd52-43f6-b08d-7b2c6aa87bc5',
        //     'URUtRkcHyMRgfkrygiUpEPBocfMFz4d3z5hNG1sKinlPpABWWUZnknbTEyJ_tiB2sfmECCrSDli571qfKaT8WA'
        // );
    }
    
    /**
     * Returns a collection of the open orders.
     *
     * @return Collection
     */
    public function getOpenOrders($site)
    {
		$client = new \Picqer\BolRetailerV8\Client();
		$platforms = User::find(Auth::id())->platforms->where('site', $site)->first();
		$client->authenticate($platforms->platform_client_id, $platforms->platform_client_secret);

		$reducedOrders_arr = array();
		
		for($a=1; $a<=4; $a++)
		{
			$reducedOrders_arr[] = $client->getOrders($a);
			// $reducedOrders_arr[] = \Picqer\BolRetailerV8\Order::all($a);
		}
		
		$bol_rec_id = 0;

		$order_check = 1;

		foreach($reducedOrders_arr as $reducedOrders)
		{
			if(isset($reducedOrders) and count($reducedOrders) > 0)
			{    
				$order_ids = array();
				foreach ($reducedOrders as $reducedOrder) {
					$order_ids[] = $reducedOrder->orderId;
				}    
				$result = DB::table('bol_data')->distinct()->select("bestelnummer")->whereIn('bestelnummer', $order_ids)->get()->toArray();            
				if(count($result) == count($reducedOrders))
				{
					return redirect('/bol/all_orders');
					exit;
				}
				$userId = Auth::id();
				$user_sno = DB::table('bol_rec')->where('user_id', $userId)->orderBy('s_no','DESC')->first(); 
				// dd($user_sno);
				if (isset($user_sno->s_no)){
					$s_no = $user_sno->s_no;
				}	else {
					$s_no = 0;
				}
              
               	if($s_no){
					if($order_check == 1){
						$bol_rec = new Bol_rec();
						$s_no1 = $s_no + 1;
						$date = date('Y-m-d H:i:s');
						$bol_rec->user_id = $userId;
						$bol_rec->date = $date;
						$bol_rec->site = $site;
						$bol_rec->s_no = $s_no1;
						$bol_rec->save();
						$bol_rec_id = $bol_rec->id;
						
						$order_check = $order_check + 1;
						$s_no = $s_no1 + 1;
					}
			 	} else {
					if($order_check == 1){
						$bol_rec = new Bol_rec();
						$s_no = 1;
						$date = date('Y-m-d H:i:s');
						$bol_rec->user_id = $userId;
						$bol_rec->date = $date;
						$bol_rec->site = $site;
						$bol_rec->s_no = $s_no;
						$bol_rec->save();
						$bol_rec_id = $bol_rec->id;
						
						$order_check = $order_check + 1;
						$s_no = $s_no + 1;
					}
				}
			
				foreach ($reducedOrders as $reducedOrder) {
					$result = DB::table('bol_data')->distinct()->select("bestelnummer")->where('bestelnummer', $reducedOrder->orderId)->get()->toArray();
					if(isset($result) and count($result) > 0)
						continue;

					$order = $client->getOrder($reducedOrder->orderId);
					
					$aanhef_verzending=$order->shipmentDetails->salutation ?? '';
					$voornaam_verzending=$order->shipmentDetails->firstName ?? '';
					$achternaam_verzending=$order->shipmentDetails->surname ?? '';
					$adres_verz_straat=$order->shipmentDetails->streetName ?? '';
					$adres_verz_huisnummer=$order->shipmentDetails->houseNumber ?? '';
					$adres_verz_huisnummer_toevoeging=$order->shipmentDetails->houseNumberExtension ?? '';

					$adres_verz_toevoeging=$order->shipmentDetails->extraAddressInformation ?? '';
					$postcode_verzending=$order->shipmentDetails->zipCode ?? '';
					$woonplaats_verzending=$order->shipmentDetails->city ?? '';
					$land_verzending=$order->shipmentDetails->countryCode ?? '';
					$emailadres=$order->shipmentDetails->email ?? '';
					$telnummerbezorging=$order->shipmentDetails->deliveryPhoneNumber ?? '';
					$bedrijfsnaam_verzending=$order->shipmentDetails->company ?? '';

					// $btw_nummer=$order->shipmentDetails->vatNumber;
					// $shipmentChamberOfCommerceNo=$order->shipmentDetails->chamberOfCommerceNumber;
					// $shipmentOrderReference=$order->shipmentDetails->orderReferenc;                    

					/* Customer Details */
					// $order->billingDetails
					$aanhef_facturatie = $order->billingDetails->salutation ?? '';
					$voornaam_facturatie = $order->billingDetailsfirstName ?? '';
					$achternaam_facturatie = $order->billingDetails->surname ?? '';
					$adres_fact_straat = $order->billingDetails->streetName ?? '';
					$adres_fact_huisnummer = $order->billingDetails->houseNumber ?? '';
					$adres_fact_huisnummer_toevoeging = $order->billingDetails->houseNumberExtension ?? '';
					$AddressSupplement2 = $order->billingDetails->addressSupplement ?? '';
					$adres_fact_toevoeging = $order->billingDetails->extraAddressInformation ?? '';
					$postcode_facturatie = $order->billingDetails->zipCode ?? '';
					$woonplaats_facturatie = $order->billingDetails->city ?? '';
					$land_facturatie = $order->billingDetails->countryCode ?? '';
					$Email2 = $order->billingDetails->email ?? '';

					// $DeliveryPhoneNumber2 = $order->billingDetails->deliveryPhoneNumber;
					
					$bedrijfsnaam_facturatie = $order->billingDetails->company ?? '';
					$VatNumber2 = $order->billingDetails->vatNumber ?? '';
					$billingChamberOfCommerceNo = $order->billingDetails->kvkNumber ?? '';
					$billingOrderReference = $order->billingDetails->orderReference ?? '';
					/* Customer Details */

					$besteldatum = $order->orderPlacedDateTime;
					$bestelnummer=$order->orderId;
					// dump($order->orderItems)."<br/>";
					// dump($order);
					// for($i=0; $i<count($order->orderItems); $i++){
						foreach($order->orderItems as $orderItems){
									 
						$orderItemId=$orderItems->orderItemId;
						$EAN=$orderItems->product->ean ?? '';
						$referentie=$orderItems->offer->reference ?? '';
						$producttitel=$orderItems->product->title ?? '';
						$aantal= $orderItems->quantity;
						$prijs= $orderItems->unitPrice * $aantal;
						$TransactionFee=$orderItems->commission;
						$uiterste_leverdatum=$orderItems->fulfilment->exactDeliveryDate ?? '';
						// $conditie=$orderItems->offerCondition;
						$annuleringsverzoek=$orderItems->cancellationRequest;
						
						$dt=date("Y-m-d");
						$exacte_leverdatum='';

						$bol_data = new Bol_data();
						$bol_data->bestelnummer = $bestelnummer;
						$bol_data->aanhef_verzending = $aanhef_verzending;
						$bol_data->voornaam_verzending = $voornaam_verzending;
						$bol_data->achternaam_verzending = $achternaam_verzending;
						$bol_data->bedrijfsnaam_verzending = $bedrijfsnaam_verzending;
						$bol_data->adres_verz_straat = $adres_verz_straat;
						$bol_data->adres_verz_huisnummer = $adres_verz_huisnummer;
						$bol_data->adres_verz_huisnummer_toevoeging = $adres_verz_huisnummer_toevoeging;
						$bol_data->adres_verz_toevoeging = $adres_verz_toevoeging;
						$bol_data->postcode_verzending = $postcode_verzending;
						$bol_data->woonplaats_verzending = $woonplaats_verzending;
						$bol_data->land_verzending = $land_verzending;
						// $bol_data->shipmentChamberOfCommerceNo = $shipmentChamberOfCommerceNo;
						// $bol_data->shipmentOrderReference = $shipmentOrderReference;

						$bol_data->aanhef_facturatie = $aanhef_facturatie;
						$bol_data->voornaam_facturatie = $voornaam_facturatie;
						$bol_data->achternaam_facturatie = $achternaam_facturatie;
						$bol_data->bedrijfsnaam_facturatie = $bedrijfsnaam_facturatie;
						$bol_data->adres_fact_straat = $adres_fact_straat;
						$bol_data->adres_fact_huisnummer = $adres_fact_huisnummer;
						$bol_data->adres_fact_huisnummer_toevoeging = $adres_fact_huisnummer_toevoeging;
						$bol_data->adres_fact_toevoeging = $adres_fact_toevoeging;
						$bol_data->postcode_facturatie = $postcode_facturatie;
						$bol_data->woonplaats_facturatie = $woonplaats_facturatie;
						$bol_data->land_facturatie = $land_facturatie;
						$bol_data->billingChamberOfCommerceNo = $billingChamberOfCommerceNo;
						$bol_data->billingOrderReference = $billingOrderReference;
						
						$bol_data->orderItemId = $orderItemId;
						$bol_data->EAN = $EAN;
						$bol_data->referentie = $referentie;
						$bol_data->producttitel = $producttitel;
						$bol_data->aantal = $aantal;
						$bol_data->prijs = $prijs;
						$bol_data->besteldatum = $besteldatum;
						$bol_data->uiterste_leverdatum = $uiterste_leverdatum;
						$bol_data->exacte_leverdatum = $exacte_leverdatum;
						//$bol_data->conditie = $conditie;
						$bol_data->annuleringsverzoek = $annuleringsverzoek;
						$bol_data->emailadres = $emailadres;
						$bol_data->telnummerbezorging = $telnummerbezorging;
						// $bol_data->btw_nummer = $btw_nummer;
						$bol_data->date_added = $dt;
						$bol_data->bol_rec_id = $bol_rec_id;

						// $conditie.$i;
						$bol_data->save();
						
					}

				}

			}
		}
        return redirect('/bol/all_orders');
    }
}
