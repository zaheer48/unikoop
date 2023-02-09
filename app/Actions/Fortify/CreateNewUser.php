<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();
        
       $url = $input['url'];

      if($url == route('home')) {
        return User::create([
            'username' => $input['username'],
            'email' => $input['email'],
            'user_type' => 'vendor',
            'password' => Hash::make($input['password']),
            
        ]);
    }
      else{
          return User::create([
            'username' => $input['username'],
            'email' => $input['email'],
            'user_type' => 'vendor',
            'password' => Hash::make($input['password']),
            
        ]);
      }
    }
}
