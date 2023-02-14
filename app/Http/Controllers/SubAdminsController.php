<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SubAdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $subadmins = User::where('is_admin', 2)->orderBy('id', 'DESC')->get();
        return view('admin.subadmins.index', compact('subadmins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subadmins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'username' => 'required|string|alpha_dash|regex:/^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/',
        ]);

        $user = new User;
        $user->password_hint = $request->password;
        $user->terms_condition = 1;
        $user->is_active = 1;
        $user->status = 3;
        $user->is_admin = 2;
        $user->dashboard_status = 1;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->create_by = Auth::user()->id;
        if($request->subadmin_activity_notify == 'on')
          $user->subadmin_activity_notify_status = 1;
        else
            $user->subadmin_activity_notify_status = 0;
        if ($request->privilege)
            $user->privilages = implode(",", $request->privilege);
        else
            $user->privilages = null;
        $user->save();
        return redirect()->route('subadmins.index')->with('success', 'Sub Admin Created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subadmin = User::find($id);
        $privileges = explode(",", $subadmin->privilages);
        return view('admin.subadmins.show', compact('subadmin', 'privileges'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subadmin = User::find($id);
        $privileges = explode(",", $subadmin->privilages);
        return view('admin.subadmins.update', compact('subadmin', 'privileges'));
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
        $subadmin = User::find($id);
        $this->validate($request, [
            'email' => 'required|email|unique:users,email,'.$subadmin->id,
            'password' => 'required|min:8',
            'username' => 'required|string|alpha_dash|regex:/^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/',
        ]);


        $subadmin->password_hint = $request->password;
        $subadmin->email = $request->email;
        $subadmin->username = $request->username;
        $subadmin->password = bcrypt($request->password);
        if($request->subadmin_activity_notify == 'on')
            $subadmin->subadmin_activity_notify_status = 1;
        else
            $subadmin->subadmin_activity_notify_status = 0;
        if ($request->privilege)
            $subadmin->privilages = implode(",", $request->privilege);
        else
            $subadmin->privilages = null;
        $subadmin->update();
        return redirect()->route('subadmins.index')->with('success', 'Record Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('subadmins.index')->with('success', 'Sub Admin Deleted successfully');
    }
}
