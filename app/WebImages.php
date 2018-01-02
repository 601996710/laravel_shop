<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebImages extends Model
{
    //
    protected $table = 'web_images';
    protected $fillable = [
        'name',
        'link',
        'sort',
        'file_name',
        'image',
    ];


}
