<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function logIn(Request $request) {

        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        //check insert email user
        $user = User::where('role','admin')
                        ->where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Log the user in
            Auth::login($user);

            // Redirect to the welcome page
            return redirect()->route('welcome')->with('success', 'Logged in successfully!');
        } else {
            // Redirect back to the login page with an error
            return redirect()->route('login')->withErrors(['login_error' => 'Invalid credentials. Please try again.']);
        }
    }

}
