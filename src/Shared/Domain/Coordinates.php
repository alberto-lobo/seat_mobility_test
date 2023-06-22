<?php

namespace App\Shared\Domain;

class Coordinates
{
    private function __construct(private int $x, private int $y)
    {
    }

    public static function fromString(string $x, string $y): self
    {
        return new static((int)$x, (int)$y);
    }
}