<?php

namespace Modules\InvoiceTemplate\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\ServiceBank;
use Session;
use Auth;
use DB;

class ServiceTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('invoicetemplate::service-bank.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
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

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $details = ServiceBank::where('id', $id)->first();
        return view('invoicetemplate::service-bank.edit',compact('details'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
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

        ServiceBank::where('id',$id)->update([
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

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
