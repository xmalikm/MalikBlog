<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	public function getCreatedAtAttribute($value) {
		$c = Carbon::parse($value);
        return $c->format('Y-m-d') .' o '. $c->format('H:i');
	}

	public function getTextTeaserAttribute() {
		return substr($this->text, 0, 140);
	}

	public function getFullTextAttribute() {
		return nl2br($this->text);
	}

	public function user() {
		return $this->belongsTo('App\User');
	}

	public function tags() {
		return $this->belongsToMany('App\Tag');
	}
}
