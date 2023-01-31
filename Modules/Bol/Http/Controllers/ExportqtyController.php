<?php

namespace Modules\Bol\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Excel;
use Modules\Bol\Http\Exports\Exportqty;
use Modules\Bol\Http\Exports\MttRegistrationsExport;
use Carbon;
use DB;

class ExportqtyController extends Controller
{
    public function getExport(Request $request)
    {
		$bol_rec = DB::table('bol_rec')->select("date")->where('id', $request->recid)->first();
    	return Excel::download(new Exportqty($request->recid), 'Pick List_'.date("d-m-Y", strtotime($bol_rec->date)).'.xlsx');
    }
}
