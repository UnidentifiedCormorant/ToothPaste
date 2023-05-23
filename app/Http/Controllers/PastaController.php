<?php

namespace App\Http\Controllers;

use App\Domain\DTO\PastaData;
use App\Http\Requests\PastaRequest;
use App\Jobs\HidePastaJob;
use App\Repositories\Interfaces\PastaRepositoryInterface;
use App\Services\Interfaces\PastaServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PastaController extends Controller
{

    public function __construct(public PastaRepositoryInterface $pastaRepository,
                                public PastaServiceInterface    $pastaService)
    {
    }

    /**
     * @param string $hash
     * @return View
     */
    public function show(string $hash): View
    {
        $pasta = $this->pastaService->show($hash, Auth::user());

        return view('pastas.show', ['pasta' => $pasta]);
    }

    /**
     * Возвращает все пасты авторизованного пользователя
     *
     * @return View|\Illuminate\Foundation\Application|void
     */
    public function myPastas()
    {
        $pastas = $this->pastaService->myPastas(Auth::user());

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

        $pasta = $this->pastaService->store($data, Auth::user());

        if ($data->expiration_time != null) {
            HidePastaJob::dispatch($pasta->id)->delay(now()->addMinutes($request['expirationTime']));
        }

        return redirect()->route('show', $pasta->hash);
    }
}
