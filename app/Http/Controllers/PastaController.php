<?php

namespace App\Http\Controllers;

use App\Domain\DTO\PastaData;
use App\Http\Requests\PastaRequest;
use App\Models\User;
use App\Services\Interfaces\PastaServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class PastaController extends Controller
{

    public function __construct(
        public PastaServiceInterface $pastaService
    )
    {
    }

    /**
     * Возвращает пасту по хэшу
     *
     * @param string $hash
     * @return View
     */
    public function show(string $hash): View
    {
        /** @var User $user */
        $user = Auth::user();
        $pasta = $this->pastaService->show($hash, $user);

        return view('pastas.show', ['pasta' => $pasta]);
    }

    /**
     * Возвращает все пасты авторизованного пользователя
     *
     * @return View
     */
    public function myPastas(): View
    {
        /** @var User $user */
        $user = Auth::user();
        $pastas = $this->pastaService->myPastas($user);

        return view('pastas.myPastas', ['pastas' => $pastas]);
    }

    /**
     * Добавляет объект в базу на основе данных с формы
     *
     * @param PastaRequest $request
     * @return RedirectResponse
     */
    public function store(PastaRequest $request): RedirectResponse
    {
        $data = PastaData::create(
            $request->validated()
        );

        /** @var User $user */
        $user = Auth::user();
        $pasta = $this->pastaService->store($data, $user);

        return redirect()->route('show', $pasta->hash);
    }
}
