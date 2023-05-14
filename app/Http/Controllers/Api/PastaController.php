<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PastaRequest;
use App\Http\Resources\Pasta\PastaCollection;
use App\Http\Resources\Pasta\PastaResource;
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
     * @return PastaResource
     */
    public function show(string $hash, PastaRepositoryInterface $repository) : PastaResource
    {
        $pasta = $repository->getPasta($hash);

        $pasta->privateCheck();

        return new PastaResource($pasta);
    }

    /**
     * Возвращает все пасты авторизованного пользователя
     *
     * @return PastaCollection
     */
    public function myPastas() : PastaCollection
    {
        if (Auth::check())
        {
            return new PastaCollection(Auth::user()->pastas()->paginate(10));
        }
        else
        {
            abort(403);
        }
    }

    /**
     * Добавляет объект в базу на осонове данных с фронта
     *
     * @param PastaRequest $request
     * @param PastaService $service
     * @return PastaResource
     */
    public function store(PastaRequest $request, PastaService $service) : PastaResource
    {
        $data = $request->validated();

        $pasta = $service->store($data, $request['language']);

        if ($request['expirationTime'] != null)
        {
            HidePastaJob::dispatch($pasta->id)->delay(now()->addMinutes($request['expirationTime']));
        }

        return new PastaResource($pasta);
    }
}
