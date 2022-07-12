<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        // validate the request
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);


        // attempt to log in
        if (!auth()->attempt($attributes)) {
            return back()->withInput()->withErrors(['email' => 'Your provided credentials could not be verified.']); // $errors
            /*
             * ValidationException::withMessages(['email' => 'wrong credentials']);
             * This does the same thing as the above line
             */
        }

        // prevent session fixation (security measure)
        session()->regenerate();

        // redirect with a success flash message
        return redirect('/')->with('success', 'Welcome back!');
    }


    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Successfully logged out.');
    }
}
