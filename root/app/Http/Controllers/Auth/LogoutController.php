<?php

namespace App\Http\Controllers\Auth;
	
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;

class LogoutController extends LoginController
{


	public function logout(Request $request) {
		$this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
	}
}