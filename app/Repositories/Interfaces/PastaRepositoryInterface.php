<?php

namespace App\Repositories\Interfaces;

use App\Models\Pasta;
use Prettus\Repository\Contracts\RepositoryInterface;

interface PastaRepositoryInterface extends RepositoryInterface
{
    public function getPasta(string $hash);

    public function model();
}
