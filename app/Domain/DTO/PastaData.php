<?php

namespace App\Domain\DTO;

use App\Domain\Enum\AccessType;
use Atwinta\DTO\DTO;

class PastaData extends DTO
{
    public function __construct(
        public string $title,
        public string $content,
        public int $expiration_time,
        public AccessType $access_type,
        public string $language,
    )
    {
    }
}
