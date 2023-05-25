<?php

namespace App\Repositories;

use App\Domain\DTO\AuthData;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Exceptions\RepositoryException;
use function PHPUnit\Framework\returnArgument;

class UserEloquent extends BaseRepository implements UserRepositoryInterface
{
    public function model()
    {
        return User::class;
    }

    /**
     * @param string $email
     * @return User|null
     * @throws RepositoryException
     */
    public function getUserByEmail(string $email): User|null
    {
        /** @var Builder $builder */
        $builder = $this->makeModel();

        return $builder->where([
            'email' => $email,
        ])->first();
    }

    /**
     * @param string $id
     * @return User
     * @throws RepositoryException
     */
    public function getUserById(string $id): User
    {
        /** @var Builder $builder */
        $builder = $this->makeModel();

        return $builder->find($id);
    }

    /**
     * @inheritDoc
     */
    public function getAllUsers(): Collection
    {
        return $this->makeModel()->all();
    }
}
