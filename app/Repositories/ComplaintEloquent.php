<?php

namespace App\Repositories;

use App\Models\Complaint;
use App\Repositories\Interfaces\ComplaintRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

class ComplaintEloquent extends BaseRepository implements ComplaintRepositoryInterface
{
    public function model()
    {
        return Complaint::class;
    }

    public function getAllComplaints(): Collection
    {
        return $this->makeModel()->all();
    }
}
