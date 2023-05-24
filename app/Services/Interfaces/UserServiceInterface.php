<?php

namespace App\Services\Interfaces;

use App\Domain\DTO\AuthData;
use App\Domain\DTO\UserData;
use App\Domain\Entity\AuthEntity;
use App\Models\User;

interface UserServiceInterface
{
    public function store(UserData $data): User;

    public function attemptAuth(AuthData $data) : AuthEntity;

}
