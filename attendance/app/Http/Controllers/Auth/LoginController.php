<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credential = $request->input('credential');
        $password = $request->input('password');

        $user = User::where('username', $credential)
            ->orWhere('email', $credential)
            ->first();

        if ($user && Hash::check($password, $user->password)) {

            $user->load('roles');

            Auth::login($user);
            Session::put('username', $user->username);

            return redirect('/');
        } else {
            return back()->withErrors(['error' => "Invalid information, Check out your account and try again"]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
