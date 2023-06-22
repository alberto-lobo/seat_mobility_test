<?php

namespace App\Domain;

use App\Shared\Domain\Coordinates;
use App\Shared\Domain\UuidGenerator;

class Mower
{
    private function __construct(
        private string      $id,
        private Coordinates $coordinates,
        private Orientation $orientation,
        private Movements   $movements
    )
    {
    }

    public static function fromPrimitive(
        string $x,
        string $y,
        string $orientation,
        array  $movements,
    ): self
    {
        return new static(
            UuidGenerator::uuidV4(),
            Coordinates::fromString($x, $y),
            Orientation::build($orientation),
            Movements::fromArray($movements)
        );
    }

    public function nextPosition(Movement $movement): void
    {
        switch ($movement) {
            case Movement::M:
                $this->move();
                return;
            case Movement::L:
                $this->rotateLeft();
                return;
            case Movement::R:
                $this->rotateRight();
                return;
        }
    }

    private function move(): void
    {
        switch ($this->orientation) {
            case Orientation::N:
                $this->coordinates->moveToNorth();
                return;
            case Orientation::E:
                $this->coordinates->moveToEast();
                return;
            case Orientation::S:
                $this->coordinates->moveToSouth();
                return;
            case Orientation::W:
                $this->coordinates->moveToWest();
                return;
        }
    }

    private function rotateRight(): void
    {
        switch ($this->orientation) {
            case Orientation::N:
                $this->orientation = Orientation::E;
                return;
            case Orientation::E:
                $this->orientation = Orientation::S;
                return;
            case Orientation::S:
                $this->orientation = Orientation::W;
                return;
            case Orientation::W:
                $this->orientation = Orientation::N;
                return;
        }
    }

    private function rotateLeft(): void
    {
        switch ($this->orientation) {
            case Orientation::N:
                $this->orientation = Orientation::W;
                return;
            case Orientation::W:
                $this->orientation = Orientation::S;
                return;
            case Orientation::S:
                $this->orientation = Orientation::E;
                return;
            case Orientation::E:
                $this->orientation = Orientation::N;
                return;
        }
    }

    public function coordinates(): Coordinates
    {
        return $this->coordinates;
    }

    public function orientation(): Orientation
    {
        return $this->orientation;
    }

    public function movements(): Movements
    {
        return $this->movements;
    }
}