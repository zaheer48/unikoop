<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nwidart\Modules\Facades\Module;

class UserController extends Controller
{
    public function dashboard()
    {
        $available_modules = Module::all();
        return view('dashboard', compact('available_modules'));
    }
}
