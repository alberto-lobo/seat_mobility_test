<?php

namespace App\Domain;

use App\Shared\Domain\UuidGenerator;

class Mower
{
    private function __construct(
        private string      $id,
        private string      $x,
        private string      $y,
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
            $x,
            $y,
            Orientation::build($orientation),
            Movements::fromArray($movements)
        );
    }
}