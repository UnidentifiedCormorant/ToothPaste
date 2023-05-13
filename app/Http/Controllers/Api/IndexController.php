<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AccessType;
use Illuminate\Http\Request;
use Illuminate\View\View;
use phpDocumentor\Reflection\Types\Collection;

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
