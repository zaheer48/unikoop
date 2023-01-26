<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use Session;
use Auth;
use DB;

class UserEmailTemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = DB::table('email_templates')->where('user_id',Auth::id())->orderBy('id','desc')->get();
        return view('emails.templates.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('emails.templates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = \DB::table('email_templates')->where('user_id',Auth::id())->where('status',1)->first();
        $set = ($status) ? 0 : 1;

        $temp = new EmailTemplate();
        $temp->user_id = Auth::id();
        $temp->email_type = $request->email_type;
        $temp->email_subject = $request->email_subject;
        $temp->email_body = $request->email_body;
        $temp->status = $set;
        $temp->save();
        Session::flash('success','Email template added');
        return redirect('/email-templates');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $template = EmailTemplate::find($id);
        return view('emails.templates.show', compact('template'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $template = EmailTemplate::find($id);
        return view('emails.templates.edit', compact('template'));
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
        $temp = EmailTemplate::findOrFail($id);
        $data = $request->all();
        $temp->update($data);
        Session::flash('success','Email template updated.');
        return redirect('/email-templates');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $template = EmailTemplate::find($request->id);
        $template->delete();

        Session::flash('success','Email template deleted.');
        return redirect('/email-templates');
    }

    public function setDefault($id)
    {
        DB::table('email_templates')->where('user_id',Auth::id())->update(['status' => 0]);
        DB::table('email_templates')->where('id',$id)->update(['status' => 1]);
        Session::flash('success','Email template set to default.');
        return redirect('/email-templates');
    }
}
