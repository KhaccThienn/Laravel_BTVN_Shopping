<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\UserLoginRequest;
use App\Http\Requests\User\UserRegisterRequest;

class UserController extends Controller
{
    public function store(UserRegisterRequest $req)
    {
        $password = Hash::make($req->password);
        User::create([
            "name" => $req->name,
            "email" => $req->email,
            "password" => $password,
        ]);

        return redirect()->route('user.sign-in')->with('alert', 'Sign Up Successfully !');
    }

    public function profile()
    {
        return view('customers.account.profile');
    }

    public function sign_in()
    {
        return view('customers.account.signin');
    }

    public function login(UserLoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('home.index');
        } else {
            return redirect()->back()->with('alert', 'Login Failed');
        }
    }

    public function sign_out()
    {
        Auth::logout();
        return redirect()->route('home.index');
    }

    public function logon()
    {
        return view('admin.login');
    }

    public function doLogon(UserLoginRequest $request)
    {
        // dd(Auth::user());

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 1])) {
            return redirect()->route('admin.index');
        } else {
            return redirect()->back()->with('message', 'Login Failed');
        }
    }
}
