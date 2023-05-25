<?php

namespace App\Http\Controllers\Api;

use App\Domain\DTO\PastaData;
use App\Http\Controllers\Controller;
use App\Http\Requests\PastaRequest;
use App\Http\Resources\Pasta\PastaCollection;
use App\Http\Resources\Pasta\PastaResource;
use App\Jobs\HidePastaJob;
use App\Models\Pasta;
use App\Models\User;
use App\Repositories\Interfaces\PastaRepositoryInterface;
use App\Repositories\PastaEloquent;
use App\Services\Interfaces\PastaServiceInterface;
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
    public function __construct(
        public PastaRepositoryInterface $pastaRepository,
        public PastaServiceInterface $pastaService
    )
    {
    }

    /**
     * Возвращает пасту по хэшу
     *
     * @param string $hash
     * @return PastaResource
     */
    public function show(string $hash): PastaResource
    {
        /** @var User $user */
        $user = Auth::user();
        $pasta = $this->pastaService->show($hash, $user);

        return new PastaResource($pasta);
    }

    /**
     * Возвращает все пасты авторизованного пользователя
     *
     * @return PastaCollection
     */
    public function myPastas(): PastaCollection
    {
        /** @var User $user */
        $user = Auth::user();
        $pastas = $this->pastaService->myPastas($user);

        return new PastaCollection($pastas);
    }

    /**
     * Добавляет объект в базу на основе данных с фронта
     *
     * @param PastaRequest $request
     * @return PastaResource
     */
    public function store(PastaRequest $request): PastaResource
    {
        $data = PastaData::create(
            $request->validated()
        );

        /** @var User $user */
        $user = Auth::user();
        $pasta = $this->pastaService->store($data, $user);

        if ($data->expiration_time != null) {
            HidePastaJob::dispatch($pasta->id)->delay(now()->addMinutes($request['expirationTime']));
        }

        return new PastaResource($pasta);
    }
}
