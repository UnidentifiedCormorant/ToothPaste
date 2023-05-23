<?php

namespace App\Http\Controllers;

use App\Domain\DTO\UserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Orchid\Alert\Toast;

class AuthController extends Controller
{
    public function __construct(
        public UserServiceInterface $userService,
        public UserRepositoryInterface $userRepository
    )
    {
    }

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
     * @param UserService $service
     * @return RedirectResponse|\Exception
     */
    public function auth(AuthRequest $request) : RedirectResponse|\Exception
    {
        $data = $request->validated();

        return $this->userService->attemptAuth($data) ? redirect()->route('pastas.index') :  abort(404);
    }

    /**
     * Создаёт нового пользователя
     *
     * @param RegisterRequest $request
     * @param UserService $service
     * @return RedirectResponse
     */
    public function newUser(RegisterRequest $request) : RedirectResponse
    {
        $data = UserData::create(
            $request->validated()
        );

        $user = $this->userService->store($data);

        Auth::login($user);

        return redirect()->route('pastas.index');
    }

    /**
     * Позволяет разлогиниться
     *
     * @return RedirectResponse
     */
    public function logout() : RedirectResponse
    {
        Auth::logout();

        return redirect()->route('pastas.index');
    }
}
