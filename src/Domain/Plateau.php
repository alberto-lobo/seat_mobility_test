<?php

namespace App\Domain;

use App\Shared\Domain\Coordinates;

class Plateau
{
    private function __construct(private readonly Coordinates $coordinates)
    {
    }

    public static function fromString(string $value): self
    {
        $coordinates = explode(' ', $value);

        return new self(Coordinates::fromString($coordinates[0], $coordinates[1]));
    }
}