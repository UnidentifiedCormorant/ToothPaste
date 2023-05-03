<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view ('auth.register');
    }

    public function auth(AuthRequest $request)
    {
        dd($request->all());
    }

    public function newUser(RegisterRequest $request)
    {
        dd($request->all());
    }
}
