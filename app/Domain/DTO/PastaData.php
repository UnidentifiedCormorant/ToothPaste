<?php

namespace App\Domain\DTO;

use Atwinta\DTO\DTO;

class PastaData extends DTO
{
    public function __construct(
        public string $content,
        
    )
    {
    }
}
