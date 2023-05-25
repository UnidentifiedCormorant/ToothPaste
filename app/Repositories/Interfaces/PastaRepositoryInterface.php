<?php

namespace App\Repositories\Interfaces;

use App\Models\Pasta;
use App\Models\User;
use Prettus\Repository\Contracts\RepositoryInterface;

interface PastaRepositoryInterface extends RepositoryInterface
{
    public function getPastaByHash(string $hash): Pasta;

    public function getUserPastasPaginated(User $user);

    public function getPastaById(string $id): Pasta;

    public function softDeletePasta(string $id): void;
}
