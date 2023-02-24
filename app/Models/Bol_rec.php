<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bol_rec extends Model
{
   protected $table = 'bol_rec';
   public $timestamps = false;

   function bol_data() {
      return $this->hasMany(Bol_data::class);
   }
}
