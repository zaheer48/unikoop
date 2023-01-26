<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use Image;

class UserPacklistTemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = DB::table('user_packlist_previews')->where('user_id',Auth::id())->get();
        if($templates->count() <= 0) {
            $packlist_previews= DB::table('packinglist_previews')->get();
            foreach($packlist_previews as $preview){
                DB::table('user_packlist_previews')->insert([
                    'user_id' =>Auth::id(),
                    'packlist_preview_id' =>$preview->id,
                ]);
            }
            $templates = DB::table('user_packlist_previews')->where('user_id',Auth::id())->get();
        }
        return view('packinglist.templates.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $preview = DB::table('packinglist_previews')
            ->select('*')
            ->join('user_packlist_previews', 'user_packlist_previews.packlist_preview_id', '=', 'packinglist_previews.id')
            ->where('user_packlist_previews.id', $id)
            ->first();
        return view('packinglist.templates.edit', compact('preview'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $preview = DB::table('user_packlist_previews')->where('id',$id)->first();
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
//                Image::make($thumbnailImage->getRealPath())->resize(120, 37)->save($path);
                $file->move(public_path().'/images',$name);
                $data[] = $name;
            }

            $logos = implode(",", $data);
        }

        $status = DB::table('user_packlist_previews')->where('user_id',\Auth::id())->where('as_default',1)->first();
        $set = ($status) ? 0 : 1;
        DB::table('user_packlist_previews')->where('id',$id)->update([
            'logo_1' => $logo1,
            'logo_2' => $logo2,
            'footer_logos' => $logos,
            'body_text' => $request->body_text,
            'as_default' => $set,
            'as_complete' => 1
        ]);

        Session::flash('success', 'Packing List template configured.');
        return redirect('/packinglist-templates');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       //

    }
    public function preview($id)
    {
        $preview = DB::table('user_packlist_previews')
            ->select('*')
            ->join('packinglist_previews', 'packinglist_previews.id', '=', 'user_packlist_previews.packlist_preview_id')
            ->where('user_packlist_previews.id',$id)
            ->first();
        return view('packinglist.templates.preview', compact('preview'));
    }
    public function setDefault($id)
    {
        DB::table('user_packlist_previews')
            ->where('user_id',\Auth::id())
            ->update([
                'as_default' => 0
            ]);

        DB::table('user_packlist_previews')->where('id',$id)->update([
            'as_default' => 1
        ]);

        Session::flash('success', 'Packing List template set to default.');
        return redirect()->route('packinglist-templates.index');
    }

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
        $pdf = \PDF::loadView('packinglist.templates.download_packlist', compact('record','preview'));
        $file = $record->voornaam_verzending.' '.$record->achternaam_verzending.' Invoice bestelnummer #'.$id.'.pdf';
        return $pdf->download($file);
    }
}
