<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Students;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\PendingUserDetails;

class RegisterController extends Controller
{
    public function index()
    {
        return view("auth.register");
    }

    public function register(RegisterRequest $request)
    {
        $username = $request->input("username");
        $password = $request->input("password");
        $firstname = $request->input("firstname");
        $lastname = $request->input("lastname");
        $email = $request->input("email");
        $dob = $request->input("dob");
        $gender = $request->input("gender");

        User::create([
            "username" => $username,
            "password" => bcrypt($password),
            "email" => $email,
            "is_pending" => 1,
        ]);

        $user_id = User::where("username", $username)->first()->id;

        PendingUserDetails::create([
            "user_id" => $user_id,
            "firstname" => $firstname,
            "lastname" => $lastname,
            "dob" => $dob,
            "gender" => $gender,
        ]);

        return redirect("/");
    }
}
