<?php

namespace Modules\PackingListTemplate\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Nwidart\Modules\Facades\Module;
use Session;
use Image;
use Auth;
use DB;

class PackingListTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
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
        return view('packinglisttemplate::index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('packinglisttemplate::create');
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
        $preview = DB::table('user_packlist_previews')
            ->select('*')
            ->join('packinglist_previews', 'packinglist_previews.id', '=', 'user_packlist_previews.packlist_preview_id')
            ->where('user_packlist_previews.id',$id)
            ->first();
        return view('packinglisttemplate::show', compact('preview'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $preview = DB::table('packinglist_previews')
            ->select('*')
            ->join('user_packlist_previews', 'user_packlist_previews.packlist_preview_id', '=', 'packinglist_previews.id')
            ->where('user_packlist_previews.id', $id)
            ->first();
        return view('packinglisttemplate::edit', compact('preview'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
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
        return redirect()->route('packinglist-templates.index');
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
}
