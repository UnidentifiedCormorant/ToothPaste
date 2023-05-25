<?php

namespace App\Http\Controllers\Api;

use App\Domain\DTO\ComplaintData;
use App\Http\Controllers\Controller;
use App\Http\Requests\ComplaintRequest;
use App\Http\Resources\Complaint\ComplaintResource;
use App\Models\User;
use App\Services\Interfaces\ComplaintServiceInterface;
use Illuminate\Support\Facades\Auth;

class ComplaintsController extends Controller
{
    public function __construct(
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

        /** @var User $user */
        $user = Auth::user();

        $complaint = $this->complaintService->store($data, $user);

        return new ComplaintResource($complaint);
    }
}
