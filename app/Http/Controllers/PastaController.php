<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PastaRequest;
use App\Jobs\HidePastaJob;
use App\Models\Pasta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PastaController extends Controller
{
    /**
     * Возвращает пасту по хэшу
     *
     * @param $hash
     * @return View
     */
    public function show($hash): View
    {
        dd('show lullen');
    }

    /**
     * Добавляет объект в базу на осонове данных с формы
     *
     * @param PastaRequest $request
     * @return RedirectResponse
     */
    public function store(PastaRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if (\Auth::check())
        {
            $data['user_id'] = auth()->user()->id;
        }

        $data['hash'] = Hash::make(Str::random(3));

        $pasta = Pasta::create($data);

        if ($data['expirationTime'] != null)
        {
            HidePastaJob::dispatch($pasta->id)->delay(now()->addMinute());
        }

        return redirect()->route('index');
    }
}
