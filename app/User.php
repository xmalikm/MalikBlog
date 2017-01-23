<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'about', 'profile_photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // uzivatel moze napisat mnoho clankov
    public function posts() {
        return $this->hasMany('App\Post');
    }

    // uzivatel moze napisat mnoho komentarov
    public function comments() {
        return $this->hasMany('App\Comment');
    }

    // uzivatelovi sa moze pacit viecero clankov
    public function likedPosts() {
        return $this->morphedByMany('App\Post', 'likeable');
    }

    // vrati priemernu popularitu clankov uzivatela
    public function getAvgPopularityAttribute() {
        // osetrenie situacie, ked je pocet clankov uzivatela 0 -> pretoze avg(0) == null
        // vtedy vratime 0, inak sa vrati priemerna hodnota
        if(!$this->posts->avg('popularity'))
            return 0;
        else
            return $this->posts->avg('popularity');
    }

    // vrati priemernu citanost clankov uzivatela
    public function getAvgReadabilityAttribute() {
        // osetrenie situacie, ked je pocet clankov uzivatela 0 -> pretoze avg(0) == null
        // vtedy vratime 0, inak sa vrati priemerna hodnota
        if(!$this->posts->avg('unique_views'))
            return 0;
        else
            return $this->posts->avg('unique_views');
    }

    // vrati pocet clankov uzivatela
    public function getNumOfArticlesAttribute() {
        return $this->posts->count();
    }

}
