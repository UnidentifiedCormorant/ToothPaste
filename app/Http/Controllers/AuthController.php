<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * @return View
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * @return View
     */
    public function register()
    {
        return view ('auth.register');
    }

    /**
     * @param AuthRequest $request
     * @return View|\Exception
     */
    public function auth(AuthRequest $request)
    {
        $data = $request->validated();

        $user = User::where([
            ['email', $data['email']],
            ['password', $data['password']]
        ])->firstOrFail();

        \Auth::login($user);

        return view('index');
    }

    /**
     * @param RegisterRequest $request
     * @return View
     */
    public function newUser(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = User::firstOrCreate($data);
        \Auth::login($user);

        return view('index');
    }
}