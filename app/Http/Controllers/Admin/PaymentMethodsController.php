<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class PaymentMethodsController extends Controller
{
    public function index()
    {
        $mollie = \DB::table('payment_methods')->where('type','mollie_payment')->first();
        $bank = \DB::table('payment_methods')->where('type','bank_transfer')->first();
        return view('admin.payment-methods.index', compact('mollie','bank'));
    }

    public function store(Request $request)
    {
        if ($request->type == 'mollie_payment')
        {
            $this->validate($request, [
                'mollie_key' => 'required',
                'mollie_profile_id' => 'required',
            ]);
            $obj = (object)array('mollie_key' => $request->mollie_key,'mollie_profile_id' => $request->mollie_profile_id);
            $method = \DB::table('payment_methods')->where('type','mollie_payment')->first();
            if ($method)
            {
                \DB::table('payment_methods')->where('type','mollie_payment')->update([
                    'type' => $request->type,
                    'value' => json_encode($obj)
                ]);
            } else {
                \DB::table('payment_methods')->insert([
                    'type' => $request->type,
                    'value' => json_encode($obj)
                ]);
            }
            Session::flash('success','Payment settings updated successfully.');
        }

        if ($request->type == 'bank_transfer') {
            $this->validate($request, [
                'bank_name' => 'required',
                'account_name' => 'required',
                'account' => 'required',
                'account_iban' => 'required',
                'swift_code' => 'required',
                'bank_address' => 'required',
                'city' => 'required',
                'country' => 'required',
            ]);
            $obj = (object)array('bank_name' => $request->bank_name,'account_name' => $request->account_name,'account' => $request->account,'account_iban' => $request->account_iban,'swift_code' => $request->swift_code,'bank_address' => $request->bank_address,'city' => $request->city,'country' => $request->country);
            $method = \DB::table('payment_methods')->where('type','bank_transfer')->first();
            if ($method)
            {
                \DB::table('payment_methods')->where('type','bank_transfer')->update([
                    'type' => $request->type,
                    'value' => json_encode($obj)
                ]);
            } else {
                \DB::table('payment_methods')->insert([
                    'type' => $request->type,
                    'value' => json_encode($obj)
                ]);
            }
            Session::flash('success','Bank settings updated successfully.');
        }
        return back();
    }
}