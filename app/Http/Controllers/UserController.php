<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id) {
    	$user = User::findOrFail($id);

    	return view('posts.index')
    		->with('title', "Články uživateľa " . "<b>" . $user->name . "</b>")
    		->with('posts', $user->posts);
    }
}