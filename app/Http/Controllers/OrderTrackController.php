<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

        $bestelnummer = $request->post('bestelnummer');
        $platform = $request->post('platform');
        $baseln = DB::table('users_orders')
            ->select('*')
            ->where('order_id',$bestelnummer)
            ->first();

        if ($baseln) {

            $bastenumber = $baseln->order_id;

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
                'name' => $name,
            ];

        } 
        elseif (Auth::check()) {

                $baseln2 = DB::table('bol_data')
                ->select('*')
                ->join('bol_rec', 'bol_rec.id', '=', 'bol_data.bol_rec_id')
                ->where('bol_data.bestelnummer',$bestelnummer)
                ->where('bol_rec.user_id',Auth::id())
                ->first();

                if($baseln2){
                    $updation = DB::table('users_orders')->where(['order_id'=> $bestelnummer])->first();
                    if(!$updation)
                    {
                        DB::table('users_orders')->insert([
                            'order_id'=> $bestelnummer,
                            'user_id'=> Auth::id(),
                            'platform'=> $platform,
                        ]);
                    }
                $bastenumber2 = $baseln2->bestelnummer;

                $bol_data = DB::table('bol_data')->select("bestelnummer","emailadres", "voornaam_verzending", "achternaam_verzending", "bedrijfsnaam_verzending", "bol_rec_id")->where('bestelnummer', $bestelnummer)->first();
                
                if ($bol_data->bedrijfsnaam_verzending != "") {
                    $name = $bol_data->bedrijfsnaam_verzending;
                } else {
                    $name = $bol_data->voornaam_verzending . " " . $bol_data->achternaam_verzending;
                }
    
                if ($bol_data) {
                    $data = $bol_data->emailadres;
                }
                return [
                    'o_no' => $bastenumber2,
                    'email' => $data,
                    'name' => $name,
                ];
              }
            }
        else{
                 
            $response = [
                'message' => 'redirect',
                'route' => route('register'),
            ];
            echo json_encode($response);
            // return redirect()->to('/register')->send();

        }
    }
}
