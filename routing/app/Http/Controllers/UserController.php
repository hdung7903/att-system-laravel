<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function handleLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = DB::table('users')->
            where('email', $email)->
            where('password', $password)
            ->first();

        if ($user) {
            Auth::login($user);
            $request->session()->put('email', $user->email);
            return redirect('/home');
        } else {
            return redirect('/login')->withErrors(['login' => 'Invalid email or password.']);
        }
    }

    public function register()
    {
        return view('register');
    }

    public function handleRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $name = $request->input('name');
            $email = $request->input('email');
            $password = $request->input('password');

            DB::table('users')->
                insert([
                    'name' => $name,
                    'email' => $email,
                    'password' => $password
                ]);
            return redirect('/login');
        } catch (QueryException $e) {
            return redirect('/register')->with('error', 'An error occurred during registration. Please try again.');
        }
    }

        
}
