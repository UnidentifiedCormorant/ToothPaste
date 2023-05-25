<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Complaint\ComplaintCollection;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\Complaint;
use App\Models\User;
use App\Repositories\Interfaces\ComplaintRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;

class AdminController extends Controller
{
    public function __construct(
        public UserRepositoryInterface $userRepository,
        public UserServiceInterface    $userService,

        public ComplaintRepositoryInterface $complaintRepository,
    )
    {
    }

    /**
     * Банит или разбанивает пользователя
     *
     * @param string $id
     * @return UserResource
     */
    public function changeBan(string $id): UserResource
    {
        $user = $this->userService->changeBan($id);

        return new UserResource($user);
    }

    /**
     * Возвращает всех пользователей
     *
     * @return UserCollection
     */
    public function users(): UserCollection
    {
        return new UserCollection($this->userRepository->getAllUsers());
    }

    /**
     * Возвращает все жалобы
     *
     * @return ComplaintCollection
     */
    public function complaints(): ComplaintCollection
    {
        return new ComplaintCollection($this->complaintRepository->getAllComplaints());
    }
}
