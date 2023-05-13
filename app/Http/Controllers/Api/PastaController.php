<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PastaRequest;
use App\Jobs\HidePastaJob;
use App\Models\Pasta;
use App\Repositories\Interfaces\PastaRepositoryInterface;
use App\Repositories\PastaRepository;
use App\Services\PastaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PastaController extends Controller
{
    /**
     * Возвращает пасту по хэшу
     *
     * @param string $hash
     * @param PastaRepositoryInterface $repository
     * @return View
     */
    public function show(string $hash, PastaRepositoryInterface $repository) : View
    {
        $pasta = $repository->getPasta($hash);

        $pasta->privateCheck();

        return view('pastas.show', compact('pasta'));
    }

    /**
     * Возвращает все пасты авторизованного пользователя
     *
     * @return View|\Illuminate\Foundation\Application|void
     */
    public function myPastas()
    {
        if (Auth::check())
        {
            $pastas = Auth::user()->pastas()->paginate(10);
            return view('pastas.myPastas', compact('pastas'));
        }
        else
        {
            abort(403);
        }
    }

    /**
     * Добавляет объект в базу на осонове данных с формы
     *
     * @param PastaRequest $request
     * @param PastaService $service
     * @return RedirectResponse
     */
    public function store(PastaRequest $request, PastaService $service) : RedirectResponse
    {
        $data = $request->validated();

        $pasta = $service->store($data);

        if ($request['expirationTime'] != null)
        {
            HidePastaJob::dispatch($pasta->id)->delay(now()->addMinutes($data['expirationTime']));
        }

        return redirect()->route('pastas.show', $pasta->hash);
    }
}
