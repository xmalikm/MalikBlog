<?php
/**
 *    Eloquent model - lajky clankov a komentarov
 */
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

    /**
     *    vrat vsetkych uzivatelov, ktorim sa paci dany clanok
     */
    public function posts() {
    	return $this->morphedByMany('App\Post', 'likeable');
    }

    /**
     *    vrat vsetkych uzivatelov, ktorim sa paci dany komentar
     */
    public function comments() {
    	return $this->morphedByMany('App\Comment', 'likeable');
    }
}
