<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = [
		'title', 'text', 'slug', 'category_id', 'blog_photo'
	];

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

	public function setTitleAttribute($value) {
		$this->attributes['title'] = ucfirst($value);
		$this->attributes['slug'] = $this->str_slug($value);
	}

	public function setTextAttribute($value) {
		$this->attributes['text'] = ucfirst($value);
	}

	public function user() {
		return $this->belongsTo('App\User');
	}

	public function category() {
		return $this->belongsTo('App\Category');
	}

	public function tags() {
		return $this->belongsToMany('App\Tag');
	}

	public function str_slug($text) {
      // replace non letter or digits by -
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);

      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

      // trim
      $text = trim($text, '-');

      // remove duplicate -
      $text = preg_replace('~-+~', '-', $text);

      // lowercase
      $text = strtolower($text);

      if (empty($text)) {
        return 'n-a';
      }

      return $text;
    }
}
