<?php
/**
 *	controller tag modelu
 */
namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
	/**
	 *	vrat view so zoznam clankov s danym tagom
	 */
    public function show($id) {
    	$tag = Tag::findOrFail($id);

    	return view('tags.indexTag')
    		->with('title', "Články s tagom " . "<span class = 'text-highlighter'>" . $tag->name . "</span>")
    		->with('tag', $tag);
    }
}
