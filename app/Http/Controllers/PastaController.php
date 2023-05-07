<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PastaRequest;
use App\Jobs\HidePastaJob;
use App\Models\Pasta;
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
     * @return View
     */
    public function show(string $hash) : View
    {
        $pasta = Pasta::where('hash', $hash)->first();

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
            $pastas = Auth::user()->pastas;
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
     * @return RedirectResponse
     * @return string $url: упаковывает ссылку на созданную пасту
     */
    public function store(PastaRequest $request) : RedirectResponse
    {
        $data = $request->validated();

        if (Auth::check())
        {
            $data['user_id'] = auth()->user()->id;
        }

        $data['hash'] = substr(md5(time()), 0, 16);

        $pasta = Pasta::create($data);

        if ($data['expirationTime'] != null)
        {
            //$url = URL::temporarySignedRoute('pastas.show', now()->addMinutes($data['expirationTime']), ['id' => $pasta]);
            HidePastaJob::dispatch($pasta->id)->delay(now()->addMinutes($data['expirationTime']));
        }

        return redirect()->route('pastas.show', $pasta->hash);
    }
}
