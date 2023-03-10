<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Mail;
use DB;

class NotificationController extends Controller
{
    public function accountReport()
    {
        $user = Auth::user();
        $business = DB::table('bussiness_address')->where('register_id',$user->id)->first();
        $transactions = DB::table('transaction_histories')->where('user_id',$user->id)->get();
        $labels = DB::table('bol_rec')
            ->select('*')
            ->join('bol_data', 'bol_data.bol_rec_id', '=', 'bol_rec.id')
            ->where('bol_rec.user_id',$user->id)
            ->paginate(15);
        return view('user.account_report', compact('labels', 'transactions', 'business'));
    }

    public function profileupdate(Request $request, $id)
    {
        $this->validate($request, [
            'email' => 'email',
            'username' => 'string|alpha_dash|regex:/^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/',
        ]);
        $user = User::where('is_admin',1)->first();
      
        $obj = (object)array('username' => $request->username,'email' => $request->email);

        $profile_info = new Notification();
        $profile_info->user_id = $id;
        $profile_info->type = 'profile-change';
        $profile_info->data = json_encode($obj);
        $profile_info->save();

        Mail::send(
            ['html' => 'user.user_requests_email'], 
            array(
                'type'=>'profile_toadmin',
                'username' =>$request->username , 
                'email' => $request->email
            ),
            function ($message) use ($user) {
                $message->to($user->email)->subject
                ('User Query');
                $message->from('online@unikoop.nl');
            }
        );
            $image = $request->profile_url;
            $name = $image->getClientOriginalName();
            $image->storeAs('public/images',$name);


            //  User::Create(['profile_url' => $name,]);
            $image_save = User::find($id);
            $image_save->profile_url = $name;
            $image_save->save();

        return redirect()->route('my.profile')->with('success', 'Profile Info Change Request sent to admin for approval.');
    }

    public function changepass(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required','min:8'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        $user_pass = User::find(Auth()->user()->id);
        $user_pass->password = Hash::make($request->new_password);
        $user_pass->password_hint = $request->new_password;
        $user_pass->update();
        return redirect('/myprofile-index')->with('success', 'password changed successfully.');
    }

    public function bussinessinfo(Request $request, $id)
    {
        $this->validate($request, [
            'streets' => 'required|string',
            'housebuildname' => 'required',
            'postcode' => 'required',
            'citytown' => 'required|string',
            'county' => 'required|string',
            'pnumber' => 'required',
            'wnumber' => 'required',
            'mnumber' => 'required',
            'emailadmin' => 'required|email',
            'email_sale' => 'required|email',
        ]);
            $username = User::where('id',$id)->first();
            $user = User::where('is_admin',1)->first();

        $obj = (object)array('street' => $request->streets,'housebuildname' => $request->housebuildname,'postcode' => $request->postcode,'citytown' => $request->citytown,'county' => $request->county,'kycBusinessInfo_Country' => $request->kycBusinessInfo_Country, 'pnumber' => $request->pnumber,'wnumber' => $request->wnumber, 'mnumber' => $request->mnumber,'emailadmin' => $request->emailadmin, 'email_sale' => $request->email_sale);

        $bussiness_info = new Notification();
        $bussiness_info->user_id = $id;
        $bussiness_info->type = 'BussinessInfo-change';
        $bussiness_info->data = json_encode($obj);
        $bussiness_info->save();

        Mail::send(['html' => 'user.user_requests_email'], array('type'=>'bussiness_toadmin','username' =>$username->username , 'street' => $request->streets, 'housebuildname' => $request->housebuildname, 'postcode' => $request->postcode, 'citytown' => $request->citytown, 'county' => $request->county,'kycBusinessInfo_Country' => $request->kycBusinessInfo_Country, 'pnumber' => $request->pnumber,'wnumber' => $request->wnumber, 'mnumber' => $request->mnumber,'emailadmin' => $request->emailadmin, 'email_sale' => $request->email_sale),
            function ($message) use ($user) {
                $message->to($user->email)->subject
                ('User Query');
                $message->from('online@unikoop.nl');
            });

        return redirect('/myprofile-index')->with('success', 'Bussiness Info Change Request sent to admin for approval.');
    }
}
