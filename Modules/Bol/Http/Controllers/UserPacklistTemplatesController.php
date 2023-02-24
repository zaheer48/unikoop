<?php

namespace Modules\Bol\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use Image;

class UserPacklistTemplatesController extends Controller
{
    public function downloadInvoice($id)
    {
        $preview = DB::table('user_packlist_previews')
            ->select('*')
            ->join('packinglist_previews', 'packinglist_previews.id', '=', 'user_packlist_previews.packlist_preview_id')
            ->where('user_packlist_previews.user_id', Auth::id())
            ->where('user_packlist_previews.as_default', 1)
            ->first();
        if (!$preview) {
            Session::flash('danger','Please configure packing list template in Settings tab area.');
            return redirect('/bol/invoice');
        }
        $record = DB::table('bol_data')->where('bestelnummer', $id)->first();
        $pdf = \PDF::loadView('bol::packinglist-templates.download_packlist', compact('record','preview'));
        $file = $record->voornaam_verzending.' '.$record->achternaam_verzending.' Invoice bestelnummer #'.$id.'.pdf';
        return $pdf->download($file);
    }
}
