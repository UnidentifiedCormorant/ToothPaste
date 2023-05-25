<?php

namespace App\Http\Controllers;

use App\Domain\DTO\ComplaintData;
use App\Http\Requests\ComplaintRequest;
use App\Models\User;
use App\Services\Interfaces\ComplaintServiceInterface;
use App\Services\Interfaces\PastaServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;

class ComplaintsController extends Controller
{
    public function __construct(
        public ComplaintServiceInterface $complaintService,
        public PastaServiceInterface $pastaService,
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
        $pasta = $this->pastaService->getPastaById($pastaId);
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

        /** @var User $user */
        $user = Auth::user();
        $this->complaintService->store($data, $user);

        return redirect(route('pastas.index'));
    }
}
