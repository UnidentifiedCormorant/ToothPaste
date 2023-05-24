<?php

namespace App\Services\Interfaces;

use App\Domain\DTO\PastaData;
use App\Models\Pasta;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface PastaServiceInterface
{
    public function store(PastaData $data, User $user) : Pasta;
    public function show(string $hash, ?User $user): Pasta;
    public function myPastas(?User $user): LengthAwarePaginator;
}
