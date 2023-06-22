<?php

namespace App\Domain;

interface MowersRepository
{
    public function findOrders(string $path): array;
}