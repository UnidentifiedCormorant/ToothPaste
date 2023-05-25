<?php

namespace App\Services;

use App\Domain\DTO\AuthData;
use App\Domain\DTO\UserData;
use App\Domain\Entity\AuthEntity;
use App\Exceptions\AuthException;
use App\Exceptions\BanException;
use App\Exceptions\NotFoundException;
use App\Exceptions\WrongLoginOrPasswordException;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
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
    public function store(UserData $data): User
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
    public function attemptAuth(AuthData $data): AuthEntity
    {
        /** @var User $user */
        if ($user = $this->userRepository->getUserByEmail($data->email)) {
            if (\Hash::check($data->password, $user->password)) {

                if($user->banned){
                    throw new BanException();
                }
                Auth::login($user);
                $token = $user->createToken(config('app.name'));

                return new AuthEntity($user, $token->plainTextToken);
            } else {
                throw new WrongLoginOrPasswordException();
            }
        } else {
            throw new WrongLoginOrPasswordException();
        }
    }

    public function changeBan(string $id): User{
        $user = $this->userRepository->getUserById($id);

        $user->banned = !$user->banned;
        $user->save();

        return $user;
    }
}
