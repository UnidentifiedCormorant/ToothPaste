<?php

namespace App\Services\Interfaces;

use App\Domain\DTO\ComplaintData;
use App\Domain\DTO\PastaData;
use App\Models\Complaint;
use App\Models\Pasta;
use App\Models\User;

interface ComplaintServiceInterface
{
    public function store(ComplaintData $data, User $user) : Complaint;
}
