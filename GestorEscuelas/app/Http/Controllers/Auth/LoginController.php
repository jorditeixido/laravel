<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{
    /**
     * Force guest authentication.
     *
     */
    public function __constructor()
    {
        $this->middleware('guest',['only' => 'showLoginForm']);
    }

    /**
     * Show Login Form.
     *
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login ()
    {
        $credentials = $this->validate(request(),[
            'email'     => 'email|required|string',
            'password'  => 'required|string'
        ]);

        if (Auth::attempt($credentials))
        {
            return redirect()->route('dashboard');
        }
        
        return back()
                ->withErrors(['email' => trans('auth.failed')])
                ->withInput(request(['email']));
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
