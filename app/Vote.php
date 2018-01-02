<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    //

    protected $table = 'vote';
    protected $fillable = ['name'];


    public function voteInfo()
    {
        return $this->hasMany('App\VoteInfo','vote_id', 'id');
    }
}
