<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

use DomainException;

class InvalidCollectionObjectException extends DomainException
{
    public static function withValues(string $class, string $expected): self
    {
        return new static(sprintf('The type %s is not a valid class for this collection. Allowed class is %s ', $class, $expected));
    }
}
