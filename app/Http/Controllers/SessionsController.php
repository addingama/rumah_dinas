<?php

namespace App\Http\Controllers;

use Session;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function login() {
//        dd(Session::get('error'));
        return view('authentications.login');
    }

    public function doLogin(Request $request) {

        return back()->with('error', 'tesdf adsf asdf adsf asdf asdft');
    }
}
