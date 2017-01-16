<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $fillable = [
    	'post_id',
        'ip',
    	'created_at',
    	'updated_at'
    ];

    public function post() {
    	return $this->belongsTo('App\Post');
    }
}
