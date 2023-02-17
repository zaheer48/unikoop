<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dhl_Label;
use App\Dpd_Label;
use Session;
use DB;

class LabelPricingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dhl = DB::table('dhl_label')->first();
        $dpd = DB::table('dpd_label')->first();
        return view('admin.label-pricing.index', compact('dhl', 'dpd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dhl = DB::table('dhl_label')->first();
        $dpd = DB::table('dpd_label')->first();
        return view('admin.label-pricing.create', compact('dhl', 'dpd'));
    }

    public function store(Request $request)
    {
        if ($request->service_type == 'dpd') {
            $this->validate($request, [
                'dpd_original_price' => 'required',
                'dpd_unikoop_price' => 'required',
                'dpd_discount_price' => 'required',
                'dpd_is_active' => 'required',
                'dpd_discount_note' => 'required',
                'box_size' => 'required',
                'delivery' => 'required',
            ]);
            $dpd = DB::table('dpd_label')->first();
            if (!$dpd) {
                DB::table('dpd_label')->insert([
                    'dpd_original_price' => $request->dpd_original_price,
                    'dpd_unikoop_price' => $request->dpd_unikoop_price,
                    'dpd_discount_price' => $request->dpd_discount_price,
                    'is_active' => $request->dpd_is_active,
                    'dpd_discount_note' => $request->dpd_discount_note,
                    'box_size' => $request->box_size,
                    'delivery' => $request->delivery
                ]);
            } else {
                DB::table('dpd_label')->where('id',1)->update([
                    'dpd_original_price' => $request->dpd_original_price,
                    'dpd_unikoop_price' => $request->dpd_unikoop_price,
                    'dpd_discount_price' => $request->dpd_discount_price,
                    'is_active' => $request->dpd_is_active,
                    'dpd_discount_note' => $request->dpd_discount_note,
                    'box_size' => $request->box_size,
                    'delivery' => $request->delivery
                ]);
            }
        } else {
            $this->validate($request, [
                'dhl_original_price' => 'required',
                'dhl_unikoop_price' => 'required',
                'dhl_discount_price' => 'required',
                'is_active' => 'required',
                'dhl_discount_note' => 'required',
                'box_size' => 'required',
                'delivery' => 'required',
            ]);
            $dhl = DB::table('dhl_label')->first();
            if (!$dhl) {
                DB::table('dhl_label')->insert([
                    'dhl_original_price' => $request->dhl_original_price,
                    'dhl_unikoop_price' => $request->dhl_unikoop_price,
                    'dhl_discount_price' => $request->dhl_discount_price,
                    'is_active' => $request->is_active,
                    'dhl_discount_note' => $request->dhl_discount_note,
                    'box_size' => $request->box_size,
                    'delivery' => $request->delivery
                ]);
            } else {
                DB::table('dhl_label')->where('id',1)->update([
                    'dhl_original_price' => $request->dhl_original_price,
                    'dhl_unikoop_price' => $request->dhl_unikoop_price,
                    'dhl_discount_price' => $request->dhl_discount_price,
                    'is_active' => $request->is_active,
                    'dhl_discount_note' => $request->dhl_discount_note,
                    'box_size' => $request->box_size,
                    'delivery' => $request->delivery
                ]);
            }
        }
        Session::flash('success', 'Action performed successfully.');
        return to_route('label.pricing');
    }
}
