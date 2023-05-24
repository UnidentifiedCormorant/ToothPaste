<?php

namespace App\Repositories;

use App\Models\Pasta;
use App\Models\User;
use App\Repositories\Interfaces\PastaRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Exceptions\RepositoryException;

class PastaEloquent extends BaseRepository implements PastaRepositoryInterface
{
    /**
     * Возвращает пасту по хэшу
     *
     * @param string $hash
     * @return Pasta
     */
    public function getPastaByHash(string $hash) : Pasta
    {
        return Pasta::where('hash', $hash)->first();
    }

    public function model()
    {
        return Pasta::class;
    }

    /**
     * Возвращает посты, созданные авторизованным пользователем
     *
     * @param User $user
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @throws RepositoryException
     */
    public function getUserPastasPaginated(User $user): LengthAwarePaginator
    {
        /** @var Builder $builder */
        $builder = $this->makeModel();

        return $builder->where('user_id', $user->id)->paginate(10);
    }

    /**
     * Возвращает пасту по id
     *
     * @param string $id
     * @return Pasta
     * @throws RepositoryException
     */
    public function getPastaById(string $id): Pasta
    {
        /** @var Builder $builder */
        $builder = $this->makeModel();

        return $builder->find($id);
    }
}
