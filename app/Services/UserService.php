<?php

namespace App\Services;

use App\Domain\DTO\UserData;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
    public function __construct(
        public UserRepositoryInterface $userRepository
    )
    {
    }

    /**
     * @param mixed $data
     * @return User
     */
    public function store(UserData $data) : User
    {
        return $this->userRepository->create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => \Hash::make($data->password)
        ]);
    }

    /**
     * @param mixed $data
     * @return bool
     */
    public function attemptAuth(mixed $data) : bool
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
                return false;
            }

            return true;
        }
        else
        {
            return false;
        }
    }
}
