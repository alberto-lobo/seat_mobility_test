<?php

namespace App\Domain;

use App\Domain\Exceptions\NegativeCoordinatesException;

class Coordinates
{
    private function __construct(private int $x, private int $y)
    {
        $this->validate();
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

    private function validate(): void
    {
        if ($this->x < 0 || $this->y < 0) {
            throw NegativeCoordinatesException::withValues($this->x, $this->y);
        }
    }
}