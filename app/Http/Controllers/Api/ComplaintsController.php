<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComplaintRequest;
use App\Models\Complaint;
use App\Models\Pasta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ComplaintsController extends Controller
{
    /**
     * Отправляет на страницу для создания жалобы
     *
     * @param string $pastaId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(string $pastaId) : View
    {
        $pasta = Pasta::find($pastaId);
        return view('complaints.create', compact('pasta'));
    }

    /**
     * Создаёт жалобу
     *
     * @param ComplaintRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ComplaintRequest $request) : RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;

        Complaint::create($data);

        return redirect(route('index'));
    }
}
