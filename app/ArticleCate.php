<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleCate extends Model
{
    //
    protected $table = 'article_cate';
    protected $fillable = ['name','sort','description','pid'];
}
