<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function index()
    {
        return view('auth.login');
    }

    function login(Request $request)
    {   
        // Validation 
        $request->validate([
            'email'=>'required|email', // Ensure the email field is required and valid
            'password'=>'required|min:6', // Ensure the password is required and at least 6 characters long
            ]);

        $user_details = [
            "email" => $request->email,
            "password" => $request->password
        ];

        if (Auth::attempt($user_details)) {
            $request->session()->regenerate();
            return redirect('/gemstones');
        }
        // Redirect back with error message if login fails
        return back()->withErrors(['email'=>'Invalid email or password.',]);
    }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function registrationForm()
    {
        return view('auth.register');
    }

    public function register (Request $request)
    {
        // Validation 
        $request->validate([
            'name' => 'required|string|max:255|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'email' => 'required|string|max:255|email|unique:users,email', //Unique email
            'password' => 'required|string|min:6|confirmed', // Must have a minimum 6 characters and passwards match
        ]);
        
        $user = User::create([
            "name"=>$request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password.

        ]);

        auth()->login($user); //This will automatically log in the user

        return redirect('/gemstones');

    }
}
