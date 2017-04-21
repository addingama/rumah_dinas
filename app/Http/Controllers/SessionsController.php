<?php

namespace App\Http\Controllers;

use Session;
use Validator;
use Auth;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function login() {
//        dd(Session::get('error'));
        return view('authentications.login');
    }

    public function doLogin(Request $request) {

        $rules = array(
            'email' => 'required',
            'password' => 'required|min:3'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('login')
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            $remember = $request->get('remember');
            $remember_me = false;
            if ($remember == 1) {
                $remember_me = true;
            }

            $user_data = array(
                'email' => $request->get('email'),
                'password' => $request->get('password'),
            );

            if (Auth::attempt($user_data, $remember_me)) {
                return redirect('dashboard')
                    ->with('info', 'Welcome '. Auth::user()->name);
            } else {
                return back()
                    ->withInput()
                    ->with('error', 'Email/password yang anda masukkan salah.');
            }

        }

    }

    public function logout() {
        Auth::logout();
        return redirect('/')->with('success');
    }
}
