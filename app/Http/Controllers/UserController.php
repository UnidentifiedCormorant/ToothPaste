<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * @param string $id
     *
     * Банит или разбанивает пользователя
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function changeBan(string $id) : RedirectResponse
    {
        $user = User::find($id);

        if ($user->banned == 0)
        {
            $user->banned = 1;
        } else
        {
            $user->banned = 0;
        }
        $user->save();

        return redirect('http://127.0.0.1:8000/admin/users');
    }
}
