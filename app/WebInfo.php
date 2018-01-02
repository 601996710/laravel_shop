<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebInfo extends Model
{
    //
    protected $table = 'web_info';
    protected $fillable = ['key','value'];
}
