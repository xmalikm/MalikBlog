<?php
/**
 *  Eloquent model - komentare k clanku
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{

	protected $fillable = ['post_id', 'user_id', 'body'];

    /**
     *    vrat clanok, ku ktoremu post patri
     */
    public function post() {
    	return $this->belongsTo('App\Post');
    }

    /**
     *    vrat uzivatela, ktory napisal komentar
     */
    public function user() {
    	return $this->belongsTo('App\User');
    }

    /**
     *    komentar moze dostat viecero likov od jednotlivych uzivatelov
     */
	public function likes() {
		return $this->morphToMany('App\User', 'likeable');
	}

    /**
     *    zistuje, ci je komentar lajknuty aktualne prihlasenym uzivatelom
     */
	public function getIsLikedAttribute()
    {
        $like = $this->likes()->whereUserId(Auth::id())->first();
        return (!is_null($like)) ? true : false;
    }

}
