<?php

namespace App\Domain;

enum Movement: string
{
    case L = 'L';
    case R = 'R';
    case M = 'M';

    public static function build(string $value): self
    {
        $type = self::tryFrom($value);

        if (null === $type) {
            throw new \DomainException(sprintf('Movement %s not valid. Only %s values are valid', $value, implode(',', self::cases())));
        }

        return $type;
    }
}