<?php

namespace Modules\Bol\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Session;
use App\ServiceBank;
use Image;
use Auth;
use DB;
use Illuminate\Support\Str;

class UserInvoiceTemplatesController extends Controller
{
    public function downloadInvoice($id)
    {
        $preview = DB::table('user_invoice_previews')
            ->select('*')
            ->join('invoice_previews', 'invoice_previews.id', '=', 'user_invoice_previews.invoice_preview_id')
            ->where('user_invoice_previews.user_id', Auth::id())
            ->where('user_invoice_previews.as_default', 1)
            ->first();
        if (!$preview) {
            Session::flash('danger','Please configure Invoice template in Settings tab area.');
            return to_route('invoice');
        }

        $servicebanks = DB::table('servicebank')->where('user_id', Auth::id())->first();
        $record = DB::table('bol_data')->where('bestelnummer', $id)->first();
        $file = $record->voornaam_verzending.' '.$record->achternaam_verzending.' Invoice bestelnummer #'.$id.'.pdf';
        // return View('template.gold.dhl.invoice-templates.download_invoice', compact('record','servicebanks','preview'));
        $pdf = \PDF::loadView('bol::invoice.download_invoice', compact('record','servicebanks','preview'));
        if($pdf){
            $file = $record->voornaam_verzending.' '.$record->achternaam_verzending.' Invoice bestelnummer #'.$id.'.pdf';        
            return $pdf->download($file);
        }        
    }
}
