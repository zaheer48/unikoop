<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Models\User;
use Auth;
use DB;
use App\Sellingplangregist;
use App\Bussiness_address;
use App\Business;
use App\Business_owner;
use App\Register_contact;
use App\Bankdetail;
use App\Charge_method;
use App\Models\Setting;
use App\Bol_data;
use App\Bol_rec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Session::get('user_id')){
        \Session::forget('user_id');
    }
        $users = User::where('is_admin',0)->orderBy('id','DESC')->get();
        return view('admin.users.index',compact('users'));
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
        $user = User::find($id);
        $business = DB::table('bussiness_address')->where('register_id',$user->id)->first();
        $transactions = DB::table('transaction_histories')->where('user_id',$user->id)->get();
        $labels = DB::table('bol_rec')
            ->select('*')
            ->join('bol_data', 'bol_data.bol_rec_id', '=', 'bol_rec.id')
            ->where('bol_rec.user_id',$user->id)
            ->get();
        return view('admin.users.show', compact('user','business','transactions','labels'));
    }
    
    public function edit($id)
    {
        $user = User::find($id);
        $dhl = DB::table('dhl_label')->select('dhl_unikoop_price','dhl_discount_price','is_active')->first();
        $dpd = DB::table('dpd_label')->select('dpd_unikoop_price','dpd_discount_price','is_active')->first();

        if($user ?? ''){
            $userId = $user->id;   
            
            $user2 = DB::table('bussiness_address')->where('register_id', $userId)->first();

            $reg_business = DB::table('bussines')->where('register_id', $userId)->first();

            $business_owner = DB::table('business_owner')->where('seller_id', $userId)->get();

            $business_register_contact = DB::table('register_contact')->where('register_id', $userId)->first();

            $term_con = DB::table('users')->where('id', $userId)->first();

            $bank_detail = DB::table('bankdetail')->where('user_id', $userId)->first();

            $return_shipping = DB::table('return_shipping')->where('seller_id', $userId)->first();

            $charge_method = DB::table('charge_method')->where('register_id', $userId)->first();

            $selling_plan = DB::table('selling_plan_regist')->where('register_id', $userId)->first();
            $setting = DB::table('setting')->where('userid', $userId)->first();
        }else{
            $userId = '';
            $selling_plan = ''; 
            $charge_method = '';
            $return_shipping = '';
            $bank_detail ='';
            $term_con ='';
            $business_owner ='';
            $reg_business ='';
            $user2 = '';
            $business_register_contact = '';
            $setting = '';
        }
        return view('admin.users.update',compact('dhl','dpd','user','userId','user2','reg_business','business_owner','business_register_contact','term_con','bank_detail','return_shipping','charge_method','selling_plan','setting'));
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
        $user = User::find($id);
        $this->validate($request, [
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'required|min:8',
            'username' => 'required|string|alpha_dash|regex:/^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/',
        ]);

            $user->password_hint = $request->password;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password = bcrypt($request->password);
            $user->update();
    
           return redirect()->back()->with('success','Record Updated successfully');
          }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $data = Bol_rec::where('user_id',$id)->get();
        $invoice_previews = \DB::table('user_invoice_previews')->where('user_id',$id)->get();
        $packlist_previews = \DB::table('user_packlist_previews')->where('user_id',$id)->get();
        $email_templates = \DB::table('email_templates')->where('user_id',$id)->get();
        if(!empty($invoice_previews)) {
            foreach($invoice_previews as $preview) {
                if ($preview->logo_1) {
                    if (file_exists(public_path('images/'.$preview->logo_1)))
                        unlink(public_path('images/'.$preview->logo_1));
                }
                if ($preview->logo_2) {
                    if (file_exists(public_path('images/'.$preview->logo_2)))
                        unlink(public_path('images/'.$preview->logo_2));
                }
                if ($preview->footer_logos) {
                    $files = explode(",",$preview->footer_logos);
                    foreach ($files as $file) {
                        unlink(public_path('images/'.$file));
                    }
                }
                \DB::table('user_invoice_previews')->where('user_id', $preview->user_id)->delete();
            }
        }
        if(!empty($packlist_previews)) {
            foreach($packlist_previews as $preview) {
                if ($preview->logo_1) {
                    if (file_exists(public_path('images/'.$preview->logo_1)))
                        unlink(public_path('images/'.$preview->logo_1));
                }
                if ($preview->logo_2) {
                    if (file_exists(public_path('images/'.$preview->logo_2)))
                        unlink(public_path('images/'.$preview->logo_2));
                }
                if ($preview->footer_logos) {
                    $files = explode(",",$preview->footer_logos);
                    foreach ($files as $file) {
                        unlink(public_path('images/'.$file));
                    }
                }
                \DB::table('user_packlist_previews')->where('user_id', $preview->user_id)->delete();
            }
        }
        if(!empty($email_templates)){
            foreach($email_templates as $email) {
            \DB::table('email_templates')->where('user_id',$email->user_id)->delete();
            }
        }

        if(!empty($data)){
            foreach($data as $bolrecord){
                Bol_data::where('bol_rec_id',$bolrecord->id)->delete(); 
                Bol_rec::where('id',$bolrecord->id)->delete();
            }
        }
        $user1 = Sellingplangregist::where('register_id',$id)->first();
        $user2 = Register_contact::where('register_id',$id)->first();
        $user4 = business::where('register_id',$id)->first();
        $user5 = Bussiness_address::where('register_id',$id)->first();
        $user6 = Bankdetail::where('user_id',$id)->first();
        $user7 = Charge_method::where('register_id',$id)->first();
        $user8 = Setting::where('userid',$id)->first();
        $user3 = Business_owner::where('seller_id',$id)->get();
        if(!empty($user3)){
            foreach( $user3 as $onerecord){
                $onerecord->delete();
            }
        }
        if($user1){
            $user1->delete();
        }
        if($user2){
            $user2->delete();
        }
        if($user4){
            $user4->delete();
        }
        if($user5){
            $user5->delete();
        }
        if($user6){
            $user6->delete();
        }
        if($user7){
            $user7->delete();
        }
        if($user8){
            $user8->delete();
        }
        $user->delete();
        return redirect()->route('users.index')->with('success','User Deleted successfully');
    }
}
