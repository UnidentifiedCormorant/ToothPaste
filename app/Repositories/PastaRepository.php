<?php

namespace App\Repositories;

use App\Models\Pasta;
use App\Repositories\Interfaces\PastaRepositoryInterface;

class PastaRepository implements PastaRepositoryInterface
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
}
