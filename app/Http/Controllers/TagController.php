<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show($id) {
    	$tag = Tag::findOrFail($id);

    	return view('tags.indexTag')
    		->with('title', "Články s tagom " . "<b>" . $tag->name . "</b>")
    		->with('tag', $tag);
    }
}
