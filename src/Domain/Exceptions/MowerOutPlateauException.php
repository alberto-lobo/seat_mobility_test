<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

use DomainException;

class MowerOutPlateauException extends DomainException
{
    public static function withValue(string $maxRange): self
    {
        return new static(sprintf('The mower is out the plateau range, maximum range is %s.', $maxRange));
    }
}
