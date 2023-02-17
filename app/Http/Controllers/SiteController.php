<?php
namespace App\Http\Controllers;

use App\Bol_data;
use App\User;
use DB;
use Auth;
use Illuminate\Http\Request;
use App\Site;

class SiteController extends Controller
{
    public function index()
    {
        return Site::all();
    }

    public function show(Site $site)
    {
        return $site;
    }

    public function store(Request $request)
    {
        $site = Site::create($request->all());

        return response()->json($site, 201);
    }

    public function update(Request $request, Site $site)
    {
        $site->update($request->all());

        return response()->json($site, 200);
    }

    public function delete(Site $site)
    {
        $site->delete();

        return response()->json(null, 204);
    }
    public function searching(Request $request)
    {
        $userId = Auth::id();
		$bol_rec = DB::table('bol_rec')->where('user_id', $userId)->orderBy('id', 'DESC')->paginate(10);
        $keyword = $request->search;

        $searchings = DB::table('bol_data')->select('*')
            ->join('bol_rec', 'bol_rec.id', '=', 'bol_data.bol_rec_id')
            ->where('bol_rec.user_id',Auth::id())
       ->where('bol_data.bestelnummer', 'LIKE', '%' . $keyword . '%')
       ->orWhere('bol_data.voornaam_verzending', 'LIKE', '%' . $keyword . '%')
       ->orWhere('bol_data.achternaam_verzending', 'LIKE', '%' . $keyword . '%')
       ->orWhere('bol_data.trackerCode', 'LIKE', '%' . $keyword . '%')
       ->orWhere('bol_data.postcode_verzending', 'LIKE', '%' . $keyword . '%')
       ->orWhere('bol_data.land_facturatie', 'LIKE', '%' . $keyword . '%')
       ->orWhere('bol_data.adres_verz_straat', 'LIKE', '%' . $keyword . '%')
       ->orWhere('bol_data.email_status', 'LIKE', '%' . $keyword . '%')
       ->paginate(9);
        $searchings->appends(['search' => $keyword]);

        return view('searching', compact('searchings', 'keyword','bol_rec'));
    }
}
