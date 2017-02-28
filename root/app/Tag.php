<?php
/**
 *	Eloquent model - tagy k clankom
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $fillable = [
		'name'
	];
	
    public $timestamps = false;

    /**
     *	vrat vsetky clanky s danym tagom
     */
    public function posts() {
		return $this->belongsToMany('App\Post');
	}
}