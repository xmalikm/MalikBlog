<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likeables';

    protected $fillable = [
    	'user_id',
    	'likeable_id',
    	'likeable_type',
    ];

    public function posts() {
    	return $this->morphedByMany('App\Post', 'likeable');
    }

    public function comments() {
    	return $this->morphedByMany('App\Comment', 'likeable');
    }
}
