<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Complaint\ComplaintCollection;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Services\Interfaces\ComplaintServiceInterface;
use App\Services\Interfaces\UserServiceInterface;

class AdminController extends Controller
{
    public function __construct(
        public UserServiceInterface    $userService,
        public ComplaintServiceInterface $complaintService
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
        return new UserCollection($this->userService->getAllUsers());
    }

    /**
     * Возвращает все жалобы
     *
     * @return ComplaintCollection
     */
    public function complaints(): ComplaintCollection
    {
        return new ComplaintCollection($this->complaintService->getAllComplaints());
    }
}
