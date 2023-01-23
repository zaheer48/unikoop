<?php

namespace Modules\Bol\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailTemplate extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Bol\Database\factories\EmailTemplateFactory::new();
    }
}
