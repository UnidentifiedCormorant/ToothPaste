<?php

namespace App\Http\Controllers\Api;

use App\Domain\DTO\ComplaintData;
use App\Http\Controllers\Controller;
use App\Http\Requests\ComplaintRequest;
use App\Http\Resources\Complaint\ComplaintResource;
use App\Repositories\Interfaces\ComplaintRepositoryInterface;
use App\Services\Interfaces\ComplaintServiceInterface;
use Illuminate\Support\Facades\Auth;

class ComplaintsController extends Controller
{
    public function __construct(
        public ComplaintRepositoryInterface $complaintRepository,
        public ComplaintServiceInterface    $complaintService
    )
    {
    }

    /**
     * Создаёт жалобу
     *
     * @param ComplaintRequest $request
     * @return ComplaintResource
     */
    public function store(ComplaintRequest $request): ComplaintResource
    {
        $data = ComplaintData::create(
            $request->validated()
        );

        $complaint = $this->complaintService->store($data, Auth::user());

        return new ComplaintResource($complaint);
    }
}
