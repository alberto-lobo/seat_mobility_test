<?php

namespace App\Domain;

use App\Domain\DTO\Orders;

interface MowersRepository
{
    public function findOrders(string $path): Orders;
}