<?php

namespace App\Services\Interfaces;

use App\Domain\DTO\UserData;
use App\Models\User;

interface UserServiceInterface
{
    public function store(UserData $data): User;
}
