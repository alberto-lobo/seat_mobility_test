<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Exceptions\InvalidCollectionObjectException;

abstract class Collection
{
    protected array $items;

    abstract protected function className(): string;

    private function __construct(array $items)
    {
        $this->validateObjectType($items);
        $this->items = $items;
    }

    public static function build(array $items): self
    {
        return new static($items);
    }

    private function validateObjectType(array $items): void
    {
        foreach ($items as $item) {
            if (false === is_a($item, $this->className())) {
                throw InvalidCollectionObjectException::withValues(get_class($item), $this->className());
            }
        }
    }
}
