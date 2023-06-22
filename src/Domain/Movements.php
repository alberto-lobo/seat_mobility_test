<?php

namespace App\Domain;

use App\Shared\Domain\Collection;

class Movements extends Collection
{
    protected function className(): string
    {
        return Movement::class;
    }

    public static function fromArray(array $array): self
    {
        return static::build(
            array_map(
                static function ($item) {
                    return Movement::build($item);
                },
                $array
            )
        );
    }
}