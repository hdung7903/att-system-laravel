<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $email = $request->email;
        $password = $request->password;

        $user = DB::table('users')->select('email', 'name')->where('email', $email)->where('password', $password)->first();

        if ($user) {
            $request->session()->put('name', $user->name);
            redirect('/home');
        }
    }
}
