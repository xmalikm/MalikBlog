<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show($id) {
    	$tag = Tag::findOrFail($id);

    	return view('posts.index')
    		->with('title', "Články s tagom " . "<b>" . $tag->name . "</b>")
    		->with('posts', $tag->posts);
    }
}
