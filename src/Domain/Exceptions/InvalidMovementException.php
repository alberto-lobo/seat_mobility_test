<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

use DomainException;

class InvalidMovementException extends DomainException
{
    public static function withValues(string $class, string $expected): self
    {
        return new static(sprintf('The value %s is not a valid movement. Allowed class is %s ', $class, $expected));
    }
}
