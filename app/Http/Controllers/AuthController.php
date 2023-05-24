<?php

namespace App\Http\Controllers;

use App\Domain\DTO\AuthData;
use App\Domain\DTO\UserData;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function __construct(
        public UserServiceInterface    $userService,
        public UserRepositoryInterface $userRepository
    )
    {
    }

    /**
     * Возвращает форму для регистарции
     *
     * @return View
     */
    public function register(): View
    {
        return view('auth.register');
    }

    /**
     * Осуществляет вход в приложение
     *
     * @param AuthRequest $request
     * @return RedirectResponse
     */
    public function auth(AuthRequest $request): RedirectResponse
    {
        $data = AuthData::create(
            $request->validated()
        );

        $this->userService->attemptAuth($data);

        return redirect()->route('pastas.index');
    }

    /**
     * Создаёт нового пользователя
     *
     * @param RegisterRequest $request
     * @param UserService $service
     * @return RedirectResponse
     */
    public function newUser(RegisterRequest $request): RedirectResponse
    {
        $data = UserData::create(
            $request->validated()
        );

        $user = $this->userService->store($data);

        Auth::login($user);

        return redirect()->route('pastas.index');
    }

    /**
     * Возвращает форму для авторизации
     *
     * @return View
     */
    public function login(): View
    {
        return view('auth.login');
    }

    /**
     * Позволяет разлогиниться
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('pastas.index');
    }
}
