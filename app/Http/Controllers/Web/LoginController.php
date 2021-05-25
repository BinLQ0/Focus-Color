<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Show Login form
     * 
     * @return \Illuminate\Http\Response 
     */
    public function view()
    {
        if (auth()->check()) {
            return redirect()->intended('/');
        }
        return view('pages.login');
    }

    /**
     * Authenticate user's login
     * 
     * @param  \Illuminate\Http\Request  $request 
     * @return \Illuminate\Http\Response
     */
    public function attempt(Request $request)
    {
        if (!auth()->attempt($request->only('username', 'password'))) {
            return redirect()->back()->withInput($request->only('username', 'password'))->withErrors([
                'password' => 'Wrong password'
            ]);
        }
        return redirect()->intended('/');
    }

    /**
     * Logout User's
     */
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
