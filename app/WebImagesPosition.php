<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebImagesPosition extends Model
{
    //
    //
    protected $table = 'web_images_position';
    protected $fillable = [
        'name',
        'web_images_id',
        'link',
        'sort',
        'file_name',
        'image',
    ];
}
