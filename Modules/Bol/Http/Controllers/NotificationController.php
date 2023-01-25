<?php

namespace Modules\Bol\Http\Controllers;

use Illuminate\Routing\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Notification;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Mail;
class NotificationController extends Controller
{
    public function accountReport()
    {
        return view('bol::account_report');
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

        Mail::send(['html' => 'user_requests_email'], array('type'=>'profile_toadmin','username' =>$request->username , 'email' => $request->email),
            function ($message) use ($user) {
                $message->to($user->email)->subject
                ('User Query');
                $message->from('online@unikoop.nl');
            });

        return redirect('/myprofile-index')->with('success', 'Profile Info Change Request sent to admin for approval.');
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

        Mail::send(['html' => 'user_requests_email'], array('type'=>'bussiness_toadmin','username' =>$username->username , 'street' => $request->streets, 'housebuildname' => $request->housebuildname, 'postcode' => $request->postcode, 'citytown' => $request->citytown, 'county' => $request->county,'kycBusinessInfo_Country' => $request->kycBusinessInfo_Country, 'pnumber' => $request->pnumber,'wnumber' => $request->wnumber, 'mnumber' => $request->mnumber,'emailadmin' => $request->emailadmin, 'email_sale' => $request->email_sale),
            function ($message) use ($user) {
                $message->to($user->email)->subject
                ('User Query');
                $message->from('online@unikoop.nl');
            });

        return redirect('/myprofile-index')->with('success', 'Bussiness Info Change Request sent to admin for approval.');
    }
}
