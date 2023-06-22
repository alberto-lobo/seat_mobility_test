<?php

namespace App\Domain;

enum Orientation: string
{
    case N = 'N';
    case S = 'S';
    case E = 'E';
    case W = 'W';

    public static function build(string $value): self
    {
        $type = self::tryFrom($value);

        if (null === $type) {
            throw new \DomainException(sprintf('Orientation %s not valid. Only %s values are valid', $value, implode(',', self::cases())));
        }

        return $type;
    }
}