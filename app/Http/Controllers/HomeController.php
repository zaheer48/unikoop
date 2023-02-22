<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function adminDashboard()
    {
        $users = User::where('is_admin',0)->count();
        $subadmins = User::where('is_admin',2)->count();
        $user_requests = Notification::all()->count();
        return view('admin.admin_dashboard',compact('users','subadmins','user_requests'));
    }
}
