<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{

	protected $fillable = ['post_id', 'user_id', 'body'];

    public function post() {
    	return $this->belongsTo('App\Post');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

    // komentar moze dostat viecero likov od jednotlivych uzivatelov
	public function likes() {
		return $this->morphToMany('App\User', 'likeable');
	}

	public function getIsLikedAttribute()
    {
        $like = $this->likes()->whereUserId(Auth::id())->first();
        return (!is_null($like)) ? true : false;
    }


}
