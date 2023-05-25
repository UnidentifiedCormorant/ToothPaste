<?php

namespace App\Services\Interfaces;

use App\Domain\DTO\ComplaintData;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface ComplaintServiceInterface
{
    public function store(ComplaintData $data, User $user): Complaint;

    public function getAllComplaints(): Collection;
}
