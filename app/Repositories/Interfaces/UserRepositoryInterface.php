<?php

namespace App\Repositories\Interfaces;

use App\Domain\DTO\AuthData;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Prettus\Repository\Contracts\RepositoryInterface;


interface UserRepositoryInterface extends RepositoryInterface
{
    public function getUserByEmail(string $email): User|null;

    public function getUserById(string $id): User;

    /**
     * @return Collection
     */
    public function getAllUsers(): Collection;
}
