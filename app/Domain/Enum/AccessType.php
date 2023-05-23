<?php

namespace App\Domain\Enum;

enum AccessType: int
{
    case Public = 1;
    case Unlisted = 2;
    case Private = 3;

    public function title(): string
    {
        return match ($this) {
            AccessType::Public => 'Public',
            AccessType::Unlisted => 'Unlisted',
            AccessType::Private => 'Private',
        };
    }
}
