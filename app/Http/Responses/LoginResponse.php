<?php
// app/Http/Responses/LoginResponse.php
namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        $home = (Auth::user()->is_admin || Auth::user()->is_admin == 2) ? config('fortify.dashboard') : config('fortify.home');
            
        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect($home);
    }

}
?>