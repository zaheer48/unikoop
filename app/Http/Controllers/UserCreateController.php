<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Sellingplangregist;
use App\Bussiness_address;
use App\Business;
use App\Business_owner;
use App\Register_contact;
use DB;
use App\Bankdetail;
use App\Charge_method;
use App\Models\Setting;
use Mail;

class UserCreateController extends Controller
{
    public function create()
    {
        $dhl = DB::table('dhl_label')->select('dhl_unikoop_price', 'dhl_discount_price', 'is_active')->first();
        $dpd = DB::table('dpd_label')->select('dpd_unikoop_price', 'dpd_discount_price', 'is_active')->first();
        return view('admin.users.create', compact('dhl', 'dpd'));
    }

    /**
     * @description
     * @param Request $request
     * @return mixed
     * @auther rafiullah
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
            'username' => 'required|string|alpha_dash|regex:/^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/',
        ]);
        $user = new User;
        if (Auth::user()->subadmin_activity_notify_status == 0) {
            $user->password_hint = $request->password;
            $user->terms_condition = 1;
            $user->is_active = 1;
            $user->status = 3;
            $user->dashboard_status = 1;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password = bcrypt($request->password);
            $user->create_by = Auth::user()->id;
            $user->save();
            $user_id = $user->id;
            \Session::put('user_id', $user_id);
        } else if (Auth::user()->subadmin_activity_notify_status == 1) {
            $user->password_hint = $request->password;
            $user->terms_condition = 1;
            $user->is_active = 0;
            $user->status = 3;
            $user->dashboard_status = 1;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password = bcrypt($request->password);
            $user->create_by = Auth::user()->id;
            $user->save();
            $user_id = $user->id;
            \Session::put('user_id', $user_id);
            $userdata = User::where('id', $user->create_by)->first();
            $admin = User::where('is_admin', 1)->first();
            Mail::send(['html' => 'emails.subadmin_activity_email'], array('type' => 'admin_approval_for_user', 'username' => $user->username, 'user_email' => $user->email, 'creater_name' => $userdata->username),
                function ($message) use ($admin) {
                    $message->to($admin->email)->subject
                    ('User Request For Approval from Unikoop');
                    $message->from('online@unikoop.nl');
                });
        }
        return redirect('/create')->with('success', 'User Created successfully.Now Fill Below Form');
    }

    public function storesellplan()
    {
        $user_id = request('user_id');

        $count_selling_plan = Sellingplangregist::where('register_id', $user_id)->count();
        if ($count_selling_plan > 0) {
            $update = Sellingplangregist::where('register_id', $user_id)
                ->update(['seller_plan_id' => request('prod'), 'is_active' => 1]);
        } else {
            $selling_plan = new Sellingplangregist();
            $selling_plan->register_id = request('user_id');
            $selling_plan->seller_plan_id = request('prod');
            $selling_plan->is_active = 1;

            $selling_plan->save();
        }
        $data = User::where('id', $user_id)->first();
        $data->bol_client_id = request('bol_client_id');
        $data->bol_client_secret = request('bol_client_secret');
        $data->bol_be_client_id = request('bol_be_client_id');
        $data->bol_be_client_secret = request('bol_be_client_secret');
        $data->update();

        return redirect('/create')->with('success', 'Record inserted successfully.');
    }

    public function storeBussiness_address(Request $request)
    {

        $validatedData = $request->validate([
            'pdf_file' => 'mimes:pdf',
            'creg_num' => 'numeric|nullable',
            'lename' => 'string|nullable',
            'firstName0' => 'string|nullable',
            'MidName0' => 'string|nullable',
            'lastname0' => 'string|nullable',
            'streets' => 'required|string',
            'housebuildname' => 'required|numeric',
            'postcode' => 'required',
            'citytown' => 'required|string',
            'county' => 'required|string',
            'pnumber' => 'required|numeric',
            'wnumber' => 'required|numeric',
            'mnumber' => 'required|numeric',
            'emailadmin' => 'required|email',
            'email_sale' => 'required|email',
            'dname' => 'required|string',
        ]);

        $user_id = request('user_id');
        if ($request->file('pdf_file')) {
            $file = $request->file('pdf_file');
            $file_ext = $file->getClientOriginalExtension();
        }

        $count_busines_owner = Business_owner::where('seller_id', $user_id)->count();

        if ($count_busines_owner > 0) {
            Business_owner::where('seller_id', $user_id)->delete();
        }
        $total_selected = 0;
        $count = $request->contact_total;
        if ($count > 0) {
            for ($sn = 0; $sn <= $count; $sn++) {
                if ($request->input('firstName' . $sn) != 'null' && $request->input('firstName' . $sn)) {
                    // return $request->input('firstName'.$sn);
                    $bussiness_owner = new Business_owner();
                    $bussiness_owner->gender = $request->input('gender' . $sn);
                    $bussiness_owner->first_name = $request->input('firstName' . $sn);
                    $bussiness_owner->mid_name = $request->input('MidName' . $sn);
                    $bussiness_owner->lastname = $request->input('lastname' . $sn);
                    $bussiness_owner->seller_id = request('user_id');
                    $bussiness_owner->save();
                    $total_selected++;
                }
            }
        }

        $count_reg_contact = Register_contact::where('register_id', $user_id)->count();

        if ($count_reg_contact > 0) {
            $file_name = '';
            if ($request->file('pdf_file')) {
                $file = $request->file('pdf_file');
                $destinationPath = 'pdf_file';
                $file_ext = $file->getClientOriginalExtension();
                $file_name = uniqid() . '.' . $file_ext;

                $file->move($destinationPath, $file_name);
            }


            $update = Register_contact::where('register_id', $user_id)
                ->update(['legal_name' => request('lename'), 'b_enti_type' => request('entype'), 'b_reg_number' => request('creg_num'), 'b_reg_date' => request('da_bregiste'), 'n_owner' => $total_selected, 'pdf_file' => $file_name]);
        } else {
            $file_name = '';
            //$file = $request->file('pdf_file');
            if ($request->file('pdf_file')) {
                $destinationPath = 'pdf_file';
                $file_ext = $file->getClientOriginalExtension();
                $file_name = uniqid() . '.' . $file_ext;
                $file->move($destinationPath, $file_name);
            }
            $bussiness_reg_contact = new Register_contact();
            $bussiness_reg_contact->register_id = request('user_id');
            $bussiness_reg_contact->legal_name = request('lename');
            $bussiness_reg_contact->b_enti_type = request('entype');
            $bussiness_reg_contact->b_reg_number = request('creg_num');
            $bussiness_reg_contact->b_reg_date = request('da_bregiste');
            $bussiness_reg_contact->n_owner = $total_selected;
            $bussiness_reg_contact->pdf_file = $file_name;
            $bussiness_reg_contact->utr_num = 0;
            $bussiness_reg_contact->hm_rev_cus = 0;
            $bussiness_reg_contact->save();
        }

        $bussiness = new business();

        $count_busines = business::where('register_id', $user_id)->count();

        if ($count_busines > 0) {
            $update = business::where('register_id', $user_id)
                ->update(['entity_id' => request('entity'), 'sub_enity_id' => request('subentity'), 'bussines_owner' => $total_selected, 'display_name' => request('dname')]);
        } else {
            $bussiness->register_id = request('user_id');
            $bussiness->entity_id = request('entity');
            $bussiness->sub_enity_id = request('subentity');
            $bussiness->bussines_owner = $total_selected;
            $bussiness->display_name = request('dname');
            $bussiness->propritership = 0;
            $bussiness->save();
            echo request('subentity');
        }


        $count = Bussiness_address::where('register_id', $user_id)->count();
        echo $count;

        if ($count > 0) {
            echo "string";
            $update = Bussiness_address::where('register_id', $user_id)
                ->update(['h_b_number' => request('housebuildname'), 'street' => request('streets'), 'city_town' => request('citytown'), 'county' => request('county'), 'country' => request('kycBusinessInfo_Country'), 'postcode' => request('postcode'), 'phonenumber' => request('pnumber'), 'workphone' => request('wnumber'), 'mobilephone' => request('mnumber'), 'p_extention' => request('extention'), 'email_admin' => request('emailadmin'), 'email_sales' => request('email_sale'), 'register_id' => request('user_id')]);
        } else {
            echo "stringelse";
            $bussiness_address = new bussiness_address();
            $bussiness_address->h_b_number = request('housebuildname');
            $bussiness_address->street = request('streets');
            $bussiness_address->city_town = request('citytown');
            $bussiness_address->county = request('county');
            $bussiness_address->country = request('kycBusinessInfo_Country');
            $bussiness_address->postcode = request('postcode');
            $bussiness_address->phonenumber = request('pnumber');
            $bussiness_address->workphone = request('wnumber');
            $bussiness_address->mobilephone = request('mnumber');
            $bussiness_address->p_extention = request('extention');
            $bussiness_address->email_admin = request('emailadmin');
            $bussiness_address->email_sales = request('email_sale');
            $bussiness_address->register_id = request('user_id');


            $bussiness_address->save();


        }
        return redirect('/create')->with('success', 'Record inserted successfully.');
    }

    function replace_numeric($c){
        return preg_replace("/[^0-9+.]/", "",$c);
    }

    public function storelogistiek(Request $request)
    {
        $user_id = \Session::get('user_id') ?? $request->user_id;
        $dpd_logistiek = null;

        if ($request->dhl_price_label == 'custom')
            $dhl_label_price = $request->price_limit;
        else
            $dhl_label_price = $request->dhl_price_label;
        if ($request->dpd_price_label == 'custom') {
            $dpd_logistiek = $request->dpd_logistiek;
            $dpd_label_price = $request->dpd_price_limit;
        } else
            $dpd_label_price = $request->dpd_price_label;

        User::where('id', $user_id)
            ->update([
                'logistiek' => request('Logistiek'),
                'dpd_logistiek' => $dpd_logistiek,
                'credit_limit' => request('credit_limit'),
                'price_per_label' => $this->replace_numeric($dhl_label_price),
                'price_per_label_dpd' => $this->replace_numeric($dpd_label_price)
            ]);

        if (request('Logistiek') || request('dpd_logistiek')) {
            $setting = new Setting;
            $setting->userid = $user_id;
            $setting->client_id = request('client_id');
            $setting->account_id = request('account_id');
            $setting->dhlkey = request('dhlkey');
            $setting->dpd_username = request('dpd_username');
            $setting->dpd_password = request('dpd_password');
            $setting->dpd_delisid = request('dpd_delisid');
            $setting->save();
        }

        return redirect()->route('users.index')->with('success', 'User Record inserted successfully.');
    }

    public function logout()
    {
        if (Auth::user()) {
            $as_admin = Auth::user()->is_admin;
            Auth::logout();
            if ($as_admin == 1 || $as_admin == 2)
                return redirect('admin/login');
            else
                return route('Servicelogin');
        } else
            return abort(404, 'Page not fouond.');
    }

}
