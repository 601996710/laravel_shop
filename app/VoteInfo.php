<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteInfo extends Model
{

    protected $table = 'vote_info';
    protected $fillable = ['name','type','data','sort','vote_id'];


    public function vote(){
        return $this->belongsTo("App\VoteInfo");
    }
}
