<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComplaintRequest;
use App\Http\Resources\Complaint\ComplaintResource;
use App\Models\Complaint;
use App\Models\Pasta;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ComplaintsController extends Controller
{
    /**
     * Создаёт жалобу
     *
     * @param ComplaintRequest $request
     * @return ComplaintResource
     */
    public function store(ComplaintRequest $request) : ComplaintResource
    {
        $data = $request->validated();

        if(Auth::check())
        {
            $data['user_id'] = Auth::user()->id;
        }

        $complaint = Complaint::create($data);

        return new ComplaintResource($complaint);
    }
}
