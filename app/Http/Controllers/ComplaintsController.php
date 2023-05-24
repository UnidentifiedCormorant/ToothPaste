<?php

namespace App\Http\Controllers;

use App\Domain\DTO\ComplaintData;
use App\Domain\DTO\PastaData;
use App\Http\Controllers\Controller;
use App\Http\Requests\ComplaintRequest;
use App\Models\Complaint;
use App\Models\Pasta;
use App\Repositories\Interfaces\ComplaintRepositoryInterface;
use App\Repositories\Interfaces\PastaRepositoryInterface;
use App\Services\Interfaces\ComplaintServiceInterface;
use App\Services\Interfaces\PastaServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ComplaintsController extends Controller
{
    public function __construct(
        public ComplaintRepositoryInterface $complaintRepository,
        public ComplaintServiceInterface $complaintService,
        public PastaRepositoryInterface $pastaRepository,
    )
    {
    }

    /**
     * Отправляет на страницу для создания жалобы
     *
     * @param string $pastaId
     * @return View
     */
    public function create(string $pastaId) : View
    {
        $pasta = $this->pastaRepository->getPastaById($pastaId);
        return view('complaints.create', ['pasta' => $pasta]);
    }

    /**
     * Создаёт жалобу
     *
     * @param ComplaintRequest $request
     * @return RedirectResponse
     */
    public function store(ComplaintRequest $request) : RedirectResponse
    {
        $data = ComplaintData::create(
            $request->validated()
        );

        $this->complaintService->store($data, Auth::user());

        return redirect(route('pastas.index'));
    }
}
