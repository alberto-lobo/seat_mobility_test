<?php

namespace App\Domain;

use App\Shared\Domain\UuidGenerator;

class Mower
{
    private function __construct(
        private string               $id,
        private readonly Coordinates $coordinates,
        private Orientation          $orientation,
        private readonly Movements   $movements
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

    public function executeMovements(): void
    {
        foreach ($this->movements->items() as $movement) {
            switch ($movement) {
                case Movement::M:
                    $this->move();
                    break;
                case Movement::L:
                    $this->rotateLeft();
                    break;
                case Movement::R:
                    $this->rotateRight();
                    break;
            }
        }
    }

    private function move(): void
    {
        switch ($this->orientation) {
            case Orientation::N:
                $this->coordinates->moveToNorth();
                break;
            case Orientation::E:
                $this->coordinates->moveToEast();
                break;
            case Orientation::S:
                $this->coordinates->moveToSouth();
                break;
            case Orientation::W:
                $this->coordinates->moveToWest();
                break;
        }
    }

    private function rotateRight(): void
    {
        switch ($this->orientation) {
            case Orientation::N:
                $this->orientation = Orientation::E;
                break;
            case Orientation::E:
                $this->orientation = Orientation::S;
                break;
            case Orientation::S:
                $this->orientation = Orientation::W;
                break;
            case Orientation::W:
                $this->orientation = Orientation::N;
                break;
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
}