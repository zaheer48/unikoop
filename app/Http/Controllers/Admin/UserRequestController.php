<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use DB;
use Mail;
use App\Models\Notification;
use App\Bussiness_address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_requests = Notification::orderBy('id','DESC')->get();
        return view('admin.user-requests.index',compact('user_requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_request = Notification::find($id);
        return view('admin.user-requests.show',compact('user_request'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user_request = Notification::find($id);
        $user = User::where('id',$user_request->user_id)->first();
        if($user_request->type == 'BussinessInfo-change'){
            $bussiness_address = Bussiness_address::where('register_id',$user_request->user_id)->first();
            if($bussiness_address) {
                $data = json_decode($user_request->data);
                $bussiness_address->h_b_number = $data->housebuildname;
                $bussiness_address->street = $data->street;
                $bussiness_address->city_town = $data->citytown;
                $bussiness_address->county = $data->county;
                $bussiness_address->country = $data->kycBusinessInfo_Country;
                $bussiness_address->postcode = $data->postcode;
                $bussiness_address->phonenumber = $data->pnumber;
                $bussiness_address->workphone = $data->wnumber;
                $bussiness_address->mobilephone = $data->mnumber;
                $bussiness_address->email_admin = $data->emailadmin;
                $bussiness_address->email_sales = $data->email_sale;
                $bussiness_address->update();
            }
            else{
                $data = json_decode($user_request->data);
                $bussiness_address = new Bussiness_address();
                $bussiness_address->h_b_number = $data->housebuildname;
                $bussiness_address->street = $data->street;
                $bussiness_address->city_town = $data->citytown;
                $bussiness_address->county = $data->county;
                $bussiness_address->country = $data->kycBusinessInfo_Country;
                $bussiness_address->postcode = $data->postcode;
                $bussiness_address->phonenumber = $data->pnumber;
                $bussiness_address->workphone = $data->wnumber;
                $bussiness_address->mobilephone = $data->mnumber;
                $bussiness_address->email_admin = $data->emailadmin;
                $bussiness_address->email_sales = $data->email_sale;
                $bussiness_address->register_id = $user_request->user_id;
                $bussiness_address->p_extention = 0;
                $bussiness_address->save();
            }
            Mail::send(['html' => 'admin.user_requests_email'], array('type'=>'admin_approval_bussiness','username' =>$user->username , 'street' => $data->street, 'housebuildname' => $data->housebuildname, 'postcode' => $data->postcode, 'citytown' => $data->citytown, 'county' => $data->county,'kycBusinessInfo_Country' => $data->kycBusinessInfo_Country, 'pnumber' => $data->pnumber,'wnumber' => $data->wnumber, 'mnumber' => $data->mnumber,'emailadmin' => $data->emailadmin, 'email_sale' => $data->email_sale),
                function ($message) use ($user) {
                    $message->to($user->email)->subject
                    ('Response from Unikoop');
                    $message->from('online@unikoop.nl');
                });
        }
        if($user_request->type == 'wallet_recharge') {
            $data = json_decode($user_request->data);
            DB::table('transaction_histories')->where('id', $data->transaction_id)->where('user_id', $user_request->user_id)->update(['transaction_status' => 1, 'updated_at' => now()]);

            User::where('id', '=', $user_request->user_id)->update(['credit_limit' => DB::raw('credit_limit + ' . $data->amount)]);

            //send pdf file in email to user
            $transaction = \DB::table('transaction_histories')->where('id', $data->transaction_id)->first();
            $user = \DB::table('users')->where('id',$transaction->user_id)->first();
            $pdf = \PDF::loadView('template.gold.dhl.userwallet.wallet_invoice', compact('transaction','user'))->setPaper('a4', 'portrait');

            if ($transaction ?? '') {
                Mail::send(['html' => 'admin.user_requests_email'], array('type' => 'admin_approval_wallet', 'username' => $user->username),
                    function ($message) use ($user,$pdf,$transaction) {
                        $message->to($user->email)->subject
                        ('Response from Unikoop');
                        $message->from('online@unikoop.nl');
                        $message->attachData($pdf->output(),' transaction# ' . $transaction->id . '.pdf');
                    });
            }
        }
        if($user_request->type == 'profile-change') {
            $data = json_decode($user_request->data);
            $user = DB::table('users')->where('id',$user_request->user_id)->first();
            DB::table('users')->where('id', $user_request->user_id)->update(['username' => $data->username, 'email' => $data->email]);

            Mail::send(['html' => 'admin.user_requests_email'], array('type' => 'admin_approval_profile', 'username' => $user->username,'new_username' => $data->username, 'new_email' => $data->email),
                    function ($message) use ($user) {
                        $message->to($user->email)->subject
                        ('Response from Unikoop');
                        $message->from('online@unikoop.nl');
                    });
 
            }

        $user_request->delete();
        return redirect()->route('user_requests.index')->with('success','Record Approved successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_request = Notification::find($id);
        $data = json_decode($user_request->data);
        $user = User::where('id',$user_request->user_id)->first();
        if($user_request->type == 'wallet_recharge'){
        DB::table('transaction_histories')->where('id',$data->transaction_id)->where('user_id',$user_request->user_id)->update(['transaction_status' => 2,'updated_at' => now(),]);

            $user = User::where('id',$user_request->user_id)->first();

            //send pdf file in email to user
            $transaction = \DB::table('transaction_histories')->where('id', $data->transaction_id)->first();
            $user = \DB::table('users')->where('id',$transaction->user_id)->first();
            $pdf = \PDF::loadView('template.gold.dhl.userwallet.wallet_invoice', compact('transaction','user'))->setPaper('a4', 'portrait');
            if ($transaction ?? '') {
                Mail::send(['html' => 'admin.user_requests_email'], array('type' => 'admin_reject_wallet', 'username' => $user->username),
                    function ($message) use ($user, $pdf, $transaction) {
                        $message->to($user->email)->subject
                        ('Response from Unikoop');
                        $message->from('online@unikoop.nl');
                        $message->attachData($pdf->output(),' transaction# ' . $transaction->id . '.pdf');
                    });
            }
        }
        if($user_request->type == 'BussinessInfo-change'){
            Mail::send(['html' => 'admin.user_requests_email'], array('type'=>'admin_reject_bussiness','username' =>$user->username , 'street' => $data->street, 'housebuildname' => $data->housebuildname, 'postcode' => $data->postcode, 'citytown' => $data->citytown, 'county' => $data->county,'kycBusinessInfo_Country' => $data->kycBusinessInfo_Country, 'pnumber' => $data->pnumber,'wnumber' => $data->wnumber, 'mnumber' => $data->mnumber,'emailadmin' => $data->emailadmin, 'email_sale' => $data->email_sale),
                function ($message) use ($user) {
                    $message->to($user->email)->subject
                    ('Response from Unikoop');
                    $message->from('online@unikoop.nl');

                });
        }
        if($user_request->type == 'profile-change') {
            Mail::send(['html' => 'admin.user_requests_email'], array('type' => 'admin_reject_profile', 'username' => $user->username,'new_username' => $data->username, 'new_email' => $data->email),
                function ($message) use ($user) {
                    $message->to($user->email)->subject
                    ('Response from Unikoop');
                    $message->from('online@unikoop.nl');
                });
        }

        $user_request->delete();
        return redirect()->route('user_requests.index')->with('success','Record Rejected successfully');
    }
}
