<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;

class UserActivationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function activate(Request $request, $id)
    {
        $user = User::find($id);
        $status =  $user->create_by;
        if($status == 'Registered By self'){
            $user->is_active = 1;
            $user->update();
            Mail::send(['html' => 'emails.user_registration_email'], array('type'=>'admin_approval_user','username' =>$user->username , 'email' => $user->email,'password' =>$user->password_hint),
                function ($message) use ($user) {
                    $message->to($user->email)->subject
                    ('Response from Unikoop');
                    $message->from('online@unikoop.nl');
                });
        }
        else {
            $user->is_active = 1;
            $user->update();
        }
        return redirect()->route('users.index')->with('success','User Activated successfully');

    }
    public function deactivate(Request $request, $id)
    {
        $user = User::find($id);
        $user->is_active = 0;
        $user->update();
        return redirect()->route('users.index')->with('success','User De-activated successfully');

    }

    public function activateSuperadmin(Request $request, $id)
    {
        $user = User::find($id);
        $user->is_active = 1;
        $user->update();
        return redirect()->route('subadmins.index')->with('success','Sub Admin Activated successfully');

    }
    public function deactivateSuperadmin(Request $request, $id)
    {
        $user = User::find($id);
        $user->is_active = 0;
        $user->update();
        return redirect()->route('subadmins.index')->with('success','Sub Admin De-activated successfully');

    }
}
