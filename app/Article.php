<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $table = 'article';
    protected $fillable = ['title','cate_id','keyword','link','sort','content','image'];
}
