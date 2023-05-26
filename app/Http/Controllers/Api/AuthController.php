<?php

namespace App\Http\Controllers\Api;

use App\Domain\DTO\AuthData;
use App\Domain\DTO\UserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\User\AuthResource;
use App\Http\Resources\User\UserResource;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(
        public UserServiceInterface $userService,
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
     * @return AuthResource
     */
    public function newUser(RegisterRequest $request): AuthResource
    {
        $data = UserData::create(
            $request->validated()
        );

        $user = $this->userService->store($data);

        return new AuthResource($user);
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
