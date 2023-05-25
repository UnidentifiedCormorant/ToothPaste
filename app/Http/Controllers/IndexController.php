<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class IndexController extends Controller
{
    /**
     * Возвращает главную страницу
     *
     * @return View
     */
    public function index() : View
    {
        return view('index');
    }
}
