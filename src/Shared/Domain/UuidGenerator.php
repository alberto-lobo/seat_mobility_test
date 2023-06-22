<?php

namespace App\Shared\Domain;

use Symfony\Component\Uid\Uuid;

class UuidGenerator
{
    public static function uuidV4(): string
    {
        return Uuid::v4()->toRfc4122();
    }
}