<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Orchid\Alert\Toast;

class AuthController extends Controller
{
    /**
     * @param AuthRequest $request
     * @param AuthService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function auth(AuthRequest $request, AuthService $service): UserResource
    {
        $data = $request->validated();

        return $service->attemptAuth($data) ? new UserResource(Auth::user()) : abort(404);
    }

    /**
     * Создаёт нового пользователя
     *
     * @param RegisterRequest $request
     * @param AuthService $service
     * @return JsonResponse
     */
    public function newUser(RegisterRequest $request, AuthService $service): JsonResponse
    {
        $data = $request->validated();

        $user = $service->store($data);

        Auth::login($user);

        return \response()->json([
            'status' => 'You registered now'
        ]);
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
