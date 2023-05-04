<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PastaController extends Controller
{
    /**
     * Возвращает пасту по хэшу
     *
     * @param $hash
     * @return View
     */
    public function show($hash) : View
    {
        dd('show lullen');
    }

    /**
     * Добавляет объект в базу на осонове данных с формы
     *
     * @return RedirectResponse
     */
    public function store() : RedirectResponse
    {
        return redirect()->route('/');
    }
}
