<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //show register form
    public function register(){

        return view('auth.register');
    }

    // store user
    public function store(Request $request){
        
        $validationData = $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required| confirmed'
        ]);

        // hash password
        $validationData['password'] = bcrypt($validationData['password']);

        // create user
        $user = User::create($validationData);

        // start login session with current user
        auth()->login($user);

        // redirect user to homepage
        return redirect('/')->with('success', 'User created and logged in');

    }


    // logout user
    public function logout(Request $request){
        // logout user
        auth()->logout();

        // invalidate the user's session
        $request->session()->invalidate();
        // regenerate the user's CSRF token
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out!');
    }

    // show login form
    public function login(){
        return view('auth.login');
    }


    // authenticate user
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/')->with('success', 'Login successful');
        }
 
        // return back with errors and with input email
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


}
