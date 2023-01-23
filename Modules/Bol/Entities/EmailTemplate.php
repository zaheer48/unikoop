<?php

namespace Modules\Bol\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailTemplate extends Model
{
    use HasFactory;

    protected $table = 'email_templates';
    protected $fillable = ['user_id','email_type','email_subject','email_body','status'];
    public $timestamps = false;

    protected static function newFactory()
    {
        return \Modules\Bol\Database\factories\EmailTemplateFactory::new();
    }
    
}
