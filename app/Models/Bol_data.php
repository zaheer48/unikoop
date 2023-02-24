<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bol_data extends Model
{
   protected $table = 'bol_data';
   public $timestamps = false;

   function bol_rec() {
      return $this->belongsTo(Bol_rec::class);
   }
}
