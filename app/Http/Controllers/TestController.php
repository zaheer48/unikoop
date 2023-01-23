<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tenant;
use Nwidart\Modules\Facades\Module;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function test(){
        // Module
        dd(Module::has('Bol'));



        // Tenant
        $tenant1 = Tenant::create(['id' => 'foo']);
        $tenant1->domains()->create(['domain' => 'foo.localhost']);

        $tenant2 = Tenant::create(['id' => 'bar']);
        $tenant2->domains()->create(['domain' => 'bar.localhost']);
    }
}
