<?php
/**
 *	Eloquent model - kategorie clankov
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	protected $fillable = [
		'name'
	];

	public $timestamps = false;

	/**
	 *	vrat clanky danej kategorie
	 */
    public function posts() {
    	return $this->hasMany('App\Post');
    }
}