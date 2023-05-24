<?php

namespace App\Http\Controllers\Api;

use App\Domain\DTO\AuthData;
use App\Domain\DTO\UserData;
use App\Exceptions\BanException;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\User\AuthResource;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Orchid\Alert\Toast;

class AuthController extends Controller
{
    public function __construct(
        public UserServiceInterface    $userService,
        public UserRepositoryInterface $userRepository
    )
    {
    }

    /**
     * @param AuthRequest $request
     * @return AuthResource
     */
    public function auth(AuthRequest $request): AuthResource
    {
        $data = AuthData::create(
            $request->validated()
        );

        $user = $this->userService->attemptAuth($data);

        return new AuthResource($user);
    }

    /**
     * Создаёт нового пользователя
     *
     * @param RegisterRequest $request
     * @return UserResource
     */
    public function newUser(RegisterRequest $request): UserResource
    {
        $data = UserData::create(
            $request->validated()
        );

        $user = $this->userService->store($data);

        Auth::login($user);

        return new UserResource($user);
    }

    /**
     * Позволяет разлогиниться
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        Auth::logout();

        return \response()->json([
            'status' => 'You logouted'
        ]);
    }
}
