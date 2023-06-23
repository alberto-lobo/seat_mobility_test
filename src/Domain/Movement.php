<?php

namespace App\Domain;

use App\Domain\Exceptions\InvalidMovementException;

enum Movement: string
{
    case L = 'L';
    case R = 'R';
    case M = 'M';

    public static function build(string $value): self
    {
        $type = self::tryFrom($value);
        if (null === $type) {
            throw InvalidMovementException::withValues($value, implode(',', array_map(
                    static fn(self $status) => $status->value,
                    self::cases()
                ))
            );
        }

        return $type;
    }
}