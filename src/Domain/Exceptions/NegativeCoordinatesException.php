<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

use DomainException;

class NegativeCoordinatesException extends DomainException
{
    public static function withValues(int $x, int $y): self
    {
        return new static(sprintf('Invalid Coordinates value x: %s, y: %s. Values must be higher than 0', $x, $y));
    }
}
