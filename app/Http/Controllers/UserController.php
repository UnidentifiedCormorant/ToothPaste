<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function __construct(
        public UserRepositoryInterface $userRepository
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
        $user = $this->userRepository->getUserById($id);

        $user->banned = !$user->banned;
        $user->save();

        return redirect()->route('platform.systems.users');
    }
}
