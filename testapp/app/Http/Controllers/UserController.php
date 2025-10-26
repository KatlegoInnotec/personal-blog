<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function login(Request $request) {
        $incomingFields = $request->validate([
            'username' => 'required',
            'loginpassword' => 'required'
        ]);

        $attempted = false;

        // Try email login if the username looks like an email
        if (filter_var($incomingFields['username'], FILTER_VALIDATE_EMAIL)) {
            $attempted = auth()->attempt([
                'email' => $incomingFields['username'],
                'password' => $incomingFields['loginpassword']
            ]);
        }

        // If not attempted via email or it failed, try username (name) login
        if (! $attempted) {
            $attempted = auth()->attempt([
                'name' => $incomingFields['username'],
                'password' => $incomingFields['loginpassword']
            ]);
        }

        if ($attempted) {
            $request->session()->regenerate();
            return redirect('/api/i/write-blog')->with('status', 'Login successful');
        }

        // On failure, redirect back with an error (could be shown server-side)
        return redirect('/')->withErrors(['username' => 'Invalid credentials provided.']);
    }

    public function logout() {
        auth()->logout();
        return redirect('/');
    }
    public function register(Request $request) {
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', Rule::unique('users','name') ],
            'email' => ['required','email', Rule::unique('users','email')],
            'password' => ['required', 'min:6']
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        //Returns an instance of a user 
        $user = User::create($incomingFields);

        auth()->login($user);

        return redirect('/');
    }
}
