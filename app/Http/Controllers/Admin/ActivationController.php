<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;

class ActivationController extends Controller
{
    public function index()
    {
        $mollie = DB::table('payment_methods')->where('type','mollie_payment')->first();
        return view('admin.activation.index', compact('mollie'));
    }

    public function switchOperation(Request $request)
    {
        if ($request->type == 'mollie')
        {
            DB::table('payment_methods')->where('type','mollie_payment')->update([
                'status' => $request->status
            ]);
        }
        if ($request->type == 'bank')
        {
            DB::table('payment_methods')->where('type','bank_transfer')->update([
                'status' => $request->status
            ]);
        }
    }
}