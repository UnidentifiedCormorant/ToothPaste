<?php

namespace App\Repositories;

use App\Models\Pasta;
use App\Models\User;
use App\Repositories\Interfaces\PastaRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Prettus\Repository\Eloquent\BaseRepository;

class PastaEloquent extends BaseRepository implements PastaRepositoryInterface
{
    /**
     * Возвращает пасту по хэшу
     *
     * @param string $hash
     * @return Pasta
     */
    public function getPasta(string $hash) : Pasta
    {
        return Pasta::where('hash', $hash)->first();
    }

    public function model()
    {
        return Pasta::class;
    }

    /**
     * Возвращает посты, созданные пользователем
     *
     * @param User $user
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUserPastasPaginated(User $user): LengthAwarePaginator
    {
        /** @var Builder $builder */
        $builder = $this->makeModel();
        return $user->pastas()->paginate(10);
    }
}
