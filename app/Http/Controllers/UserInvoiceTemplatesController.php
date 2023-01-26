<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\ServiceBank;
use Image;
use Auth;
use DB;
use Illuminate\Support\Str;

class UserInvoiceTemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = DB::table('user_invoice_previews')->where('user_id', Auth::id())->get();
        if ($templates->count() <= 0) {
            $invoice_previews = DB::table('invoice_previews')->get();
            foreach ($invoice_previews as $preview) {
                DB::table('user_invoice_previews')->insert([
                    'user_id' => Auth::id(),
                    'invoice_preview_id' => $preview->id,
                ]);
            }
            $templates = DB::table('user_invoice_previews')->where('user_id', Auth::id())->get();
        }
        $servicebanks = DB::table('servicebank')->where('user_id', Auth::id())->first();
        return view('invoice.templates.index', compact('templates','servicebanks'));
    }

    public function edit($id)
    {
        $preview = DB::table('invoice_previews')
            ->select('*')
            ->join('user_invoice_previews', 'user_invoice_previews.invoice_preview_id', '=', 'invoice_previews.id')
            ->where('user_invoice_previews.id', $id)
            ->first();
        return view('invoice.templates.edit', compact('preview'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $preview = DB::table('user_invoice_previews')->where('id',$id)->first();
        $logo1 = $preview->logo_1;
        $logo2 = $preview->logo_2;
        $logos = $preview->footer_logos;

        /* Image Intervention */
        if ($request->logo_1) {
            $this->validate($request, ['logo_1' => 'mimes:jpg,jpeg,png,bmp,tiff |max:4096',]);

            if ($preview->logo_1) {
                if (file_exists(public_path('images/' . $preview->logo_1)))
                    unlink(public_path('images/' . $preview->logo_1));
            }

            $file = $request->logo_1;
            $logo1 = time() . $file->getClientOriginalName();
            $logo1 = str_replace(" ", "", strip_tags(trim($logo1)));
            $file->move(public_path().'/images',$logo1);
        }

        /* Image Intervention */
        if ($request->logo_2) {
            $this->validate($request, ['logo_2' => 'mimes:jpg,jpeg,png,bmp,tiff |max:4096']);

            if ($preview->logo_2) {
                if (file_exists(public_path('images/' . $preview->logo_2)))
                    unlink(public_path('images/' . $preview->logo_2));
            }

            $file = $request->logo_2;
            $logo2 = time() . $file->getClientOriginalName();
            $logo2 = str_replace(" ", "", strip_tags(trim($logo2)));
            $file->move(public_path().'/images',$logo2);
        }

        if ($request->file('footer_logos')) {
            if ($preview->footer_logos) {
                $files = explode(",", $preview->footer_logos);
                foreach ($files as $file => $value) {
                    if (file_exists(public_path('images/' . $value)))
                        unlink(public_path('images/' . $value));
                }
            }
            
            foreach ($request->file('footer_logos') as $file) {
                /* Image Intervention */
                $name = time() . $file->getClientOriginalName();
                $name = str_replace(" ", "", strip_tags(trim($name)));
//                $thumbnailImage = $file;
                $file->move(public_path().'/images',$name);
//                Image::make($thumbnailImage->getRealPath())->resize(120, 37)->save($path);
                $data[] = $name;
            }

            $logos = implode(",", $data);
        }

        $status = DB::table('user_invoice_previews')->where('user_id',\Auth::id())->where('as_default',1)->first();
        $set = ($status) ? 0 : 1;
        DB::table('user_invoice_previews')->where('id',$id)->update([
            'logo_1' => $logo1,
            'logo_2' => $logo2,
            'footer_logos' => $logos,
            'as_default' => $set,
            'as_complete' => 1
        ]);

        Session::flash('success', 'Invoice template configured.');
        return redirect('/invoice-templates');
    }

    public function preview($id)
    {
        $preview = DB::table('user_invoice_previews')
            ->select('*')
            ->join('invoice_previews', 'invoice_previews.id', '=', 'user_invoice_previews.invoice_preview_id')
            ->where('user_invoice_previews.id', $id)
            ->first();
        return view('invoice.templates.preview', compact('preview'));
    }

    public function setDefault($id)
    {
        DB::table('user_invoice_previews')
            ->where('user_id',Auth::id())
            ->update([
                'as_default' => 0
            ]);

        DB::table('user_invoice_previews')->where('id',$id)->update([
            'as_default' => 1
        ]);

        Session::flash('success', 'Invoice template set to default.');
        return redirect('/invoice-templates');
    }

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
            return redirect('/bol/invoice');
        }

        $servicebanks = DB::table('servicebank')->where('user_id', Auth::id())->first();
        $record = DB::table('bol_data')->where('bestelnummer', $id)->first();
        // return View('template.gold.dhl.invoice-templates.download_invoice', compact('record','servicebanks','preview'));
        $pdf = \PDF::loadView('invoice.download_invoice', compact('record','servicebanks','preview'));
        $file = $record->voornaam_verzending.' '.$record->achternaam_verzending.' Invoice bestelnummer #'.$id.'.pdf';
        return $pdf->download($file);
    }

    public function servicecreate()
    {
        return view('invoice.service-bank.create');
    }

    public function servicestore(Request $request)
    {
        $this->validate($request, [
          
          'bank_name' => 'required',
          'iban' => 'required',
          'bic' => 'required'
        ],
        [
         
         'iban.required' => 'Bank IBAN Required', 
         'bank_name.required' => 'Bank Name is Required', 
         'bic.required' => 'Bank BIC Required', 
         
     ]);

        ServiceBank::create([

            'user_id' => Auth::id(),
            'slug' =>  1 . mt_rand(1000, 9999),
            'bank_name' => $request->bank_name,
            'bic' => $request->bic,
            'iban' => $request->iban,
            'bank_name_2' => $request->bank_name_2,
            'bic_2' => $request->bic_2,
            'iban_2' => $request->iban_2,
       ]);

     return redirect('/invoice-templates');

    }

    public function serviceedit($slug)
    {    
        $details = ServiceBank::where('slug', $slug)->first();
        return view('invoice.service-bank.edit',compact('details'));

    }

    public function serviceupdate($id, Request $request)
    {
         $this->validate($request, [
          
          'bank_name' => 'required',
          'iban' => 'required',
          'bic' => 'required'
        ],
        [
         
         'iban.required' => 'Bank IBAN Required', 
         'bank_name.required' => 'Bank Name is Required', 
         'bic.required' => 'Bank BIC Required', 
         
     ]);

         ServiceBank::where('id',$request->id)->update([

            'user_id' => Auth::id(),
            'slug' =>  1 . mt_rand(1000, 9999),
            'bank_name' => $request->bank_name,
            'bic' => $request->bic,
            'iban' => $request->iban,
            'bank_name_2' => $request->bank_name_2,
            'bic_2' => $request->bic_2,
            'iban_2' => $request->iban_2,
       ]);
     return redirect('/invoice-templates');
    }
}
