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

    public function moveToNorth(): void
    {
        ++$this->y;
    }

    public function moveToEast(): void
    {
        ++$this->x;
    }

    public function moveToSouth(): void
    {
        --$this->y;
    }

    public function moveToWest(): void
    {
        --$this->x;
    }

    public function x(): int
    {
        return $this->x;
    }

    public function y(): int
    {
        return $this->y;
    }
}