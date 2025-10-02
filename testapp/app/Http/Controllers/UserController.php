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

        if(auth()->attempt(['name' => $incomingFields['username'], 
            'password' => $incomingFields['loginpassword']])) {

                $request->session()->regenerate();
        }

        return redirect('/');
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
