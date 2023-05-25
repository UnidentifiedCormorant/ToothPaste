<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function __construct(
        public UserServiceInterface $userService
    )
    {
    }

    /**
     * Банит или разбанивает пользователя
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function changeBan(string $id) : RedirectResponse
    {
        $this->userService->changeBan($id);

        return redirect()->route('platform.systems.users');
    }
}
