<?php

namespace App\Domain\DTO;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Atwinta\DTO\DTO;

class UserData extends DTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    )
    {
    }
}
