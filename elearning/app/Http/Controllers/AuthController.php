<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $result = User::where('username', $username)->first();

        if ($result && Hash::check($password, $result->password)) {
            return redirect()->intended('/home');
        } else {
            return back()->withErrors(['username' => 'Invalid username or password'])->withInput();
        }
    }
}
