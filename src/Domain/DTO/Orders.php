<?php

namespace App\Domain\DTO;

use App\Domain\Mower;
use App\Domain\Plateau;

class Orders
{
    private function __construct(
        private readonly Plateau $plateau,
        private readonly array   $mowers
    )
    {
    }

    public static function build(Plateau $plateauSize, array $mowers): self
    {
        return new static($plateauSize, $mowers);
    }

    /**
     * @return Mower[]
     */
    public function mowers(): array
    {
        return $this->mowers;
    }
}