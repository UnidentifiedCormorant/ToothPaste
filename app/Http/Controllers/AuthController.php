<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Orchid\Alert\Toast;

class AuthController extends Controller
{
    /**
     * Возвращает форму для авторизации
     *
     * @return View
     */
    public function login() : View
    {
        return view('auth.login');
    }

    /**
     * Возвращает форму для регистарции
     *
     * @return View
     */
    public function register() : View
    {
        return view ('auth.register');
    }

    /**
     * Осуществляет вход в приложение
     *
     * @param AuthRequest $request
     * @return RedirectResponse|\Exception
     */
    public function auth(AuthRequest $request) : RedirectResponse|\Exception
    {
        $data = $request->validated();

        if(Auth::attempt(array(
            'email' => $data['email'],
            'password' => $data['password']
        )))
        {
            $user = User::where([
                'email' => $data['email'],
            ])->first();

            if($user->banned)
            {
                return abort(404);
            }

            return redirect()->route('index');
        }
        else
        {
            return abort(404);
        }
    }

    /**
     * Создаёт нового пользователя
     *
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function newUser(RegisterRequest $request) : RedirectResponse
    {
        $data = $request->validated();

        $data['password'] = \Hash::make($data['password']);

        $user = User::firstOrCreate($data);
        Auth::login($user);

        return redirect()->route('index');
    }

    /**
     * Позволяет разлогиниться
     *
     * @return RedirectResponse
     */
    public function logout() : RedirectResponse
    {
        Auth::logout();

        return redirect()->route('index');
    }
}
