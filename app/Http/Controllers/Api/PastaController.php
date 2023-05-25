<?php

namespace App\Http\Controllers\Api;

use App\Domain\DTO\PastaData;
use App\Http\Controllers\Controller;
use App\Http\Requests\PastaRequest;
use App\Http\Resources\Pasta\PastaCollection;
use App\Http\Resources\Pasta\PastaResource;
use App\Models\User;
use App\Services\Interfaces\PastaServiceInterface;
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

        return new PastaResource($pasta);
    }
}
