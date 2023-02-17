<?php

namespace Modules\InvoiceTemplate\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\ServiceBank;
use Session;
use Auth;
use DB;

class InvoiceTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
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
        return view('invoicetemplate::index', compact('templates','servicebanks'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('invoicetemplate::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $preview = DB::table('user_invoice_previews')
            ->select('*')
            ->join('invoice_previews', 'invoice_previews.id', '=', 'user_invoice_previews.invoice_preview_id')
            ->where('user_invoice_previews.id', $id)
            ->first();
        // return view('invoice.templates.preview', compact('preview'));
        return view('invoicetemplate::show', compact('preview'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $preview = DB::table('invoice_previews')
            ->select('*')
            ->join('user_invoice_previews', 'user_invoice_previews.invoice_preview_id', '=', 'invoice_previews.id')
            ->where('user_invoice_previews.id', $id)
            ->first();
        return view('invoicetemplate::edit', compact('preview'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $preview = DB::table('user_invoice_previews')->where('id',$id)->first();
        $logo1 = $preview->logo_1;
        $logo2 = $preview->logo_2;
        $logos = $preview->footer_logos;

        /* Image Intervention */
        if ($request->logo_1) {
            $request->validate($request, ['logo_1' => 'mimes:jpg,jpeg,png,bmp,tiff |max:4096',]);

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
                $file->move(public_path().'/images',$name);
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
        return redirect()->route('invoice-templates.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
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
        return redirect()->route('invoice-templates.index');
    }

    // Service
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

    public function serviceCreate()
    {
        return view('invoicetemplate::service-bank.create');
    }

    public function serviceStore(Request $request)
    {
        $request->validate([
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
        return redirect()->route('invoice-templates.index');
    }

    public function serviceedit($slug)
    {    
        $details = ServiceBank::where('slug', $slug)->first();
        return view('invoicetemplate::service-bank.edit',compact('details'));
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
        return redirect()->route('invoice-templates.index');
    }
}
