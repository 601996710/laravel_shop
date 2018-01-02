<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebLink extends Model
{
    //
    protected  $table = 'web_links';
    protected   $fillable = [
        'name',
        'link',
        'type',
        'sort',
        'file_name',
        'image',
    ];
}
