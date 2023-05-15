<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Complaint\ComplaintCollection;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    /**
     * Банит или разбанивает пользователя
     *
     * @param string $id
     * @return UserResource
     */
    public function changeBan(string $id) : UserResource
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

        return new UserResource($user);
    }

    /**
     * Возвращает всех пользователей
     *
     * @return UserCollection
     */
    public function users() :UserCollection
    {
        return new UserCollection(User::paginate(10));
    }

    public function complaints()
    {
        return new ComplaintCollection(Complaint::paginate(10));
    }
}
