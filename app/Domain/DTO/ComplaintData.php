<?php

namespace App\Domain\DTO;

use Atwinta\DTO\DTO;

class ComplaintData extends DTO
{
    public function __construct(
        public string $content,
        public string $pasta_id,
    )
    {
    }
}
