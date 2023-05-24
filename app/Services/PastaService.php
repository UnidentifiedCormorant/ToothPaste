<?php

namespace App\Services;

use App\Domain\DTO\PastaData;
use App\Exceptions\AuthException;
use App\Exceptions\NotFoundException;
use App\Models\Pasta;
use App\Models\User;
use App\Repositories\Interfaces\PastaRepositoryInterface;
use App\Services\Interfaces\PastaServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Prettus\Validator\Exceptions\ValidatorException;

class PastaService implements PastaServiceInterface
{
    public function __construct(
        public PastaRepositoryInterface $pastaRepository
    )
    {
    }

    /**
     * Добавляет пасту в базу данных
     *
     * @param mixed $data
     * @param User|null $user
     * @return Pasta
     */
    public function store(PastaData $data, ?User $user): Pasta
    {
        return $this->pastaRepository->create([
            'title' => $data->title,
            'content' => $data->content,
            'hash' => substr(md5(time() + rand(1, 10000)), 0, 16),
            'user_id' => ($user !== null) ? $user->id : null,
            'access_type' => $data->access_type->value
        ]);
    }

    /**
     * Возвращает пасту по хэшу с проверкой права доступа пользователя
     *
     * @param string $hash
     * @param User|null $user
     * @return mixed
     */
    public function show(string $hash, ?User $user): Pasta
    {
        $pasta = $this->pastaRepository->getPastaByHash($hash);

        if ($pasta->access_type == 3) {
            if (!$user) {
                throw new AuthException();
            } elseif ($pasta->user_id != $user->id) {
                throw new NotFoundException();
            }
        }

        return $pasta;
    }

    /**
     * Возвращает пасты авторизованного пользователя
     *
     * @param User|null $user
     * @return LengthAwarePaginator
     */
    public function myPastas(?User $user): LengthAwarePaginator
    {
        if($user) {
            return $this->pastaRepository->getUserPastasPaginated($user);
        }else{
            throw new AuthException();
        }
    }
}
