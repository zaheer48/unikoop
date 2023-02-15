<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.website-settings.index');
    }

    public function edit()
    {
        return view('admin.website-settings.edit');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'site_title' => 'required',
        ]);
        $data = [];
        $files = null;
        $services = null;

        $settings = DB::table('website_settings')->first();
        if ($settings) {

            $files = $settings->partners_logo;
            $services = $settings->services_logo;
            $logo = $settings->site_logo;
            $fav = $settings->site_fav_icon;

            if ($request->has('site_logo')) {
                if (file_exists(public_path('/portal/'.$logo)))
                    unlink(public_path('/portal/'.$logo));
                $file = $request->site_logo;
                $logo = time().$file->getClientOriginalName();
                $logo = str_replace(" ","",strip_tags(trim($logo)));
                $file->move('portal',$logo);
            }

            if ($request->has('site_fav_icon')) {
                if (file_exists(public_path('/portal/'.$fav)))
                    unlink(public_path('/portal/'.$fav));
                $file = $request->site_fav_icon;
                $fav = time().$file->getClientOriginalName();
                $fav = str_replace(" ","",strip_tags(trim($fav)));
                $file->move('portal',$fav);
            }

            if ($request->file('files')) {
                foreach ($request->file('files') as $file) {
                    $name = time() . $file->getClientOriginalName();
                    $name = str_replace(" ","",strip_tags(trim($name)));
                    $file->move(public_path() . '/portal/', $name);
                    $data[] = $name;
                }
                if($files){
                    $old_files = explode(",",$settings->partners_logo);
                    $files_arr = array_merge($old_files,$data);
                    $files = implode(",", $files_arr);
                }
                else{
                 $files = implode(",", $data);   
                }
                }

            if ($request->file('services')) {
                foreach($request->file('services') as $file)
                {
                    $name1 = time().$file->getClientOriginalName();
                    $name1 = str_replace(" ","",strip_tags(trim($name1)));
                    $file->move(public_path().'/portal/', $name1);
                    $data1[] = $name1;
                }
                if($services){
                    $old_services = explode(",",$settings->services_logo);
                    $files_arr1 = array_merge($old_services,$data1);
                    $services = implode(",", $files_arr1);
                }
                else{
                     $services = implode(",", $data1);
                }
            }
            DB::table('website_settings')->where('id',1)->update([
                'site_title' => $request->site_title,
                'site_logo' => $logo,
                'site_fav_icon' => $fav,
                'partners_logo' => $files,
                'services_logo' => $services,
            ]);

        } else {
            $this->validate($request, [
                'site_title' => 'required',
                'site_logo' => 'required',
                'site_fav_icon' => 'required',
            ]);



            if ($request->file('files')) {
                foreach($request->file('files') as $file)
                {
                    $name = time().$file->getClientOriginalName();
                    $name = str_replace(" ","",strip_tags(trim($name)));
                    $file->move(public_path().'/portal/', $name);
                    $data[] = $name;
                }

                $files = implode(",",$data);
            }
            if ($request->file('services')) {
                foreach($request->file('services') as $file)
                {
                    $name1 = time().$file->getClientOriginalName();
                    $name1 = str_replace(" ","",strip_tags(trim($name1)));
                    $file->move(public_path().'/portal/', $name1);
                    $data1[] = $name1;
                }

                $services = implode(",",$data1);
            }

            $file = $request->site_logo;
            $logo = time().$file->getClientOriginalName();
            $logo = str_replace(" ","",strip_tags(trim($logo)));
            $file->move('portal',$logo);

            $file = $request->site_fav_icon;
            $fav = time().$file->getClientOriginalName();
            $fav = str_replace(" ","",strip_tags(trim($fav)));
            $file->move('portal',$fav);

            DB::table('website_settings')->insert([
                'site_title' => $request->site_title,
                'site_logo' => $logo,
                'site_fav_icon' => $fav,
                'partners_logo' => $files,
                'services_logo' => $services,
            ]);
        }

        Session::flash('success','Site settings updated');
        return redirect('/site-settings');
    }

    public function deletePartner(Request $request)
    {
        if ($request->type == 'service') {
            $settings = \DB::table('website_settings')->first();
            unlink(public_path('/portal/'.$request->value));
            $files = explode(",",$settings->services_logo);
            foreach ($files as $key => $value) {
                if ($value == $request->value)
                    unset($files[$key]);
            }
            $new = implode(",", $files);
            DB::table('website_settings')->where('id',1)->update([
                'services_logo' => $new
            ]);
            return $request->value;
        }
        
        if ($request->type == 'partner') {
            $settings = \DB::table('website_settings')->first();
            unlink(public_path('/portal/'.$request->value));
            $files = explode(",",$settings->partners_logo);
            foreach ($files as $key => $value) {
                if ($value == $request->value)
                    unset($files[$key]);
            }
            $new = implode(",", $files);
            DB::table('website_settings')->where('id',1)->update([
                'partners_logo' => $new
            ]);
            return $request->value;
        }
    }
}