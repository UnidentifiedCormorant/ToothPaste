<?php

namespace App\Repositories\Interfaces;

use App\Domain\DTO\UserData;
use App\Models\User;
use Prettus\Repository\Contracts\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function model();
}
