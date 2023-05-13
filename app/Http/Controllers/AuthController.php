<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\AuthService;
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
     * @param AuthService $service
     * @return RedirectResponse|\Exception
     */
    public function auth(AuthRequest $request, AuthService $service) : RedirectResponse|\Exception
    {
        $data = $request->validated();

        return $service->attemptAuth($data);
    }

    /**
     * Создаёт нового пользователя
     *
     * @param RegisterRequest $request
     * @param AuthService $service
     * @return RedirectResponse
     */
    public function newUser(RegisterRequest $request, AuthService $service) : RedirectResponse
    {
        $data = $request->validated();

        $user = $service->store($data);

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
