<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //Show register form
    public function create() {
        return view('users.create');
    }

    //Store user
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email', //unique in users table, email column
            'password' => 'required|min:6|confirmed', //password confirmation
        ]);

        $formFields['password'] = bcrypt($formFields['password']); //encrypt password

        $user = User::create($formFields);

        auth()->login($user);

        return redirect('/')->with('success', 'User created and logged in');
    }

    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully!');
    }

    public function login() {
        return view('users.login');
    }

    // Authenticate user
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => 'required|email', //unique in users table, email column
            'password' => 'required', //password confirmation
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate(); //regenerate session id

            return redirect('/')->with('success', 'Logged in successfully!');
        }

        //only return email failure message, keep only email input
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}
