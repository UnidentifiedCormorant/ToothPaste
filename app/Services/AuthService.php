<?php

namespace App\Services;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * @param mixed $data
     * @return User
     */
    public function store(mixed $data) : User
    {
        $data['password'] = \Hash::make($data['password']);

        return User::firstOrCreate($data);
    }

    /**
     * @param mixed $data
     * @return RedirectResponse|never
     */
    public function attemptAuth(mixed $data) : RedirectResponse|\Exception
    {
        if(Auth::attempt(array(
            'email' => $data['email'],
            'password' => $data['password']
        )))
        {
            $user = User::where([
                'email' => $data['email'],
            ])->first();

            if($user->banned)
            {
                return abort(404);
            }

            return redirect()->route('index');
        }
        else
        {
            return abort(404);
        }
    }
}
