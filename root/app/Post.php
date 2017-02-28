<?php
/**
 *	Eloquent model - clanky
 */
namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
	protected $fillable = [
		'title', 'text', 'slug', 'category_id', 'blog_photo', 'unique_views'
	];

	/**
	 *	vrat datum vytvorenia clanku
	 */
	public function getCreatedAtAttribute($value) {
		$c = Carbon::parse($value);
        return $c->format('d.m.Y') .' o '. $c->format('H:i');
	}

	/**
	 *	vrat datum upravy clanku
	 */
	public function getUpdatedAtAttribute($value) {
		$c = Carbon::parse($value);
        return $c->format('d.m.Y') .' o '. $c->format('H:i');
	}

	/**
	 *	vrat uryvok z clanku - 122 znakov
	 */
	public function getTextTeaserAttribute() {
		return (strlen($this->text) > 122) ? substr($this->text, 0, 122).'...' : $this->text;
	}

	/**
	 *	vrat uryvok z clanku - 25 znakov
	 */
	public function getTitleTeaserAttribute() {
		return (strlen($this->title) > 25) ? substr($this->title, 0, 23).'...' : $this->title;
	}

	/**
	 *	vrat uryvok z clanku - 14 znakov
	 */
	public function getSidebarTitleTeaserAttribute() {
		return (strlen($this->title) > 14) ? substr($this->title, 0, 14).'...' : $this->title;
	}

	/**
	 *	vrat cely text clanku
	 */
	public function getFullTextAttribute() {
		return nl2br($this->text);
	}

	/**
	 *	uprav nadpis clanku
	 */
	public function setTitleAttribute($value) {
		$this->attributes['title'] = ucfirst($value);
		$this->attributes['slug'] = $this->str_slug($value);
	}

	/**
	 *	uprav text clanku
	 */
	public function setTextAttribute($value) {
		$this->attributes['text'] = ucfirst($value);
	}

	/**
	 *	clanok moze byt napisany jednym uzivatelom
	 */
	public function user() {
		return $this->belongsTo('App\User');
	}

	/**
	 *	clanok moze patrit iba do jednej kategorie
	 */
	public function category() {
		return $this->belongsTo('App\Category');
	}

	/**
	 *	clanok moze obsahovat viacero tagov
	 */
	public function tags() {
		return $this->belongsToMany('App\Tag');
	}

	/**
	 *	clanok moze mat viacero videni
	 */
	public function views() {
		return $this->hasMany('App\View');
	}

	/**
	 *	clanok moze mat viacero komentarov
	 */
	public function comments() {
		return $this->hasMany('App\Comment');
	}

	/**
	 *	clanok moze dostat viecero likov od jednotlivych uzivatelov
	 */
	public function likes() {
		return $this->morphToMany('App\User', 'likeable');
	}

	/**
	 *	zistuje, ci aktualne prihlaseny uzivatel lajkol clanok
	 */
	public function getIsLikedAttribute()
    {
        $like = $this->likes()->whereUserId(Auth::id())->first();
        return (!is_null($like)) ? true : false;
    }

    /**
     *	vytvara slug k clanku
     */
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
