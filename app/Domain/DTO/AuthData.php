<?php

namespace App\Domain\DTO;

use Atwinta\DTO\DTO;

class AuthData extends DTO
{
    public function __construct(
        public string $email,
        public string $password,
    )
    {
    }
}
