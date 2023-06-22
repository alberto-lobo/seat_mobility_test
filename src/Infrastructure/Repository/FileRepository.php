<?php

namespace App\Infrastructure\Repository;

use App\Domain\DTO\Orders;
use App\Domain\Mower;
use App\Domain\MowersRepository;
use App\Domain\Plateau;

class FileRepository implements MowersRepository
{

    public function findOrders(string $path): Orders
    {
        $content = file_get_contents($path);
        $content = preg_split('/\r\n|\r|\n/', $content);
        $plateauSize = Plateau::fromString($content[0]);
        array_splice($content, 0, 1);
        $mowers = [];
        for ($index = 0, $indexMax = count($content); $index < $indexMax; $index += 2) {
            $initialPosition = explode(' ', $content[$index]);
            $movements = str_split($content[$index + 1]);
            $mowers[] = Mower::fromPrimitive(
                $initialPosition[0],
                $initialPosition[1],
                $initialPosition[2],
                $movements
            );
        }
        return Orders::build($plateauSize, $mowers);
    }
}