<?php

namespace App\Services\Interfaces;

use App\Domain\DTO\AuthData;
use App\Domain\DTO\UserData;
use App\Domain\Entity\AuthEntity;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserServiceInterface
{
    public function store(UserData $data): AuthEntity;

    public function attemptAuth(AuthData $data): AuthEntity;

    public function changeBan(string $id): User;

    public function getAllUsers(): Collection;
}
