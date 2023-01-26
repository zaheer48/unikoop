<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicebank extends Model
{
    protected $table = 'servicebank';
     protected $fillable = [
    			'user_id',
                'slug',
    			'bank_name',
    			'iban',
                'bic',
                'bank_name_2',
                'iban_2',
                'bic_2',
    ];
}
