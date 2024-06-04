<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function handleLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = DB::table('users')
            ->where('email', $email)
            ->where('password', $password)
            ->first();
        if ($user) {
            if (Hash::check($password, $user->password)) {
                return redirect('home');
            }
            return redirect('/login')->with('error', "Login failed");
        }
    }

    public function handleLogout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function handleRegister(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $confirm_password = $request->input('confirm_password');
        if ($confirm_password != $password) {
            return redirect('/register')->with('error', 'Password not match');
        } else {
            try {
                DB::table('users')->insert([
                    'id' => (string) Uuid::uuid4(),
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make($password)
                ]);
                return redirect('/login');
            } catch (QueryException $e) {
                return redirect('/register')->with('error', $e->getMessage());
            }
        }
    }

    public function __invoke()
    {
        return view('home');
    }
}
