<?php

namespace App\Domain;

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

    public function isInside(Coordinates $position): bool
    {
        return $position->x() <= $this->coordinates->x() && $position->y() <= $this->coordinates->y();
    }

    public function maxRange(): string
    {
        return $this->coordinates->x() . " " . $this->coordinates->y();
    }
}