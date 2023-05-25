<?php

namespace App\Services;

use App\Domain\DTO\ComplaintData;
use App\Models\Complaint;
use App\Models\User;
use App\Repositories\Interfaces\ComplaintRepositoryInterface;
use App\Services\Interfaces\ComplaintServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class ComplaintService implements ComplaintServiceInterface
{
    public function __construct(
        public ComplaintRepositoryInterface $complaintRepository
    )
    {
    }

    public function store(ComplaintData $data, User $user): Complaint
    {
        return $this->complaintRepository->create([
            'content' =>$data->content,
            'pasta_id' => $data->pasta_id,
            'user_id' => $user->id,
        ]);
    }

    public function getAllComplaints(): Collection
    {
        return $this->complaintRepository->getAllComplaints();
    }
}
