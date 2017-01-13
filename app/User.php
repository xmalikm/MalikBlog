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

    public function posts() {
        return $this->hasMany('App\Post');
    }

    // metoda vracia priemernu citanost clankov usera
    public function getAvgReadability() {
        // celkovy pocet videni vsetkych clankov usera
        $count = 0;
        // pocet clankov usera
        $allArticles = $this->num_of_articles;

        foreach ($this->posts as $post) {
            $count += $post->unique_views;
        }

        return round($count/$allArticles, 2);
    }
}
