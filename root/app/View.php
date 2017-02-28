<?php
/**
 *	Eloquent model - views clanku
 */
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

    /**
     *	vrat clanok, ku ktoremu dane view patri
     */
    public function post() {
    	return $this->belongsTo('App\Post');
    }
}
