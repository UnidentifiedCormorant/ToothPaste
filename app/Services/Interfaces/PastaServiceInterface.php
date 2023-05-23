<?php

namespace App\Services\Interfaces;

use App\Domain\DTO\PastaData;
use App\Models\Pasta;
use App\Models\User;

interface PastaServiceInterface
{
    public function store(PastaData $data, User $user) : Pasta;
}
