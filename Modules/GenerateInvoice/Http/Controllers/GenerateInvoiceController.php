<?php

namespace Modules\GenerateInvoice\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\InvoiceController;
use App\Models\EmailTemplate;
use Auth;
use DB;

class GenerateInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $default = EmailTemplate::where('email_type','Order Invoice')->where('status',1)->first();
        return view('generateinvoice::index', compact('default'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('generateinvoice::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('generateinvoice::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('generateinvoice::edit');
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

                $order = new InvoiceController;
                $email = Auth::check() ? Auth::user()->email : DB::table('users')->where('id', $user_order->user_id)->pluck("email");
                return $order->checkInvoice($bol_data, $email);
            
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
}
