<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Exports\UsersExport;
use App\Exports\MttRegistrationsExport;
use Carbon;
use DB;

class CustomerController extends Controller
{
    public function getExport(Request $request)
    {
    	// $export = new InvoicesExport([
     //    [1, 2, 3],
     //    [4, 5, 6]
    	// ]);
    	//$mytime = Carbon\Carbon::now();
		//$dt = $mytime->toDateTimeString();
		$bol_rec = DB::table('bol_rec')->select("date")->where('id', $request->recid)->first();

    	return Excel::download(new UsersExport($request->recid), 'Pick List_'.date("d-m-Y", strtotime($bol_rec->date)).'.xlsx');
    }
}
