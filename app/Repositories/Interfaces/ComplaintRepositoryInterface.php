<?php

namespace App\Repositories\Interfaces;

use App\Models\Pasta;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Prettus\Repository\Contracts\RepositoryInterface;

interface ComplaintRepositoryInterface extends RepositoryInterface
{
    public function getAllComplaints(): Collection;
}
