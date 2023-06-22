<?php

namespace App\Infrastructure\Repository;

use App\Domain\Mower;
use App\Domain\MowersRepository;

class FileRepository implements MowersRepository
{

    public function findOrders(string $path): array
    {
        $content = file_get_contents($path);
        $content = preg_split('/\r\n|\r|\n/', $content);
        $plateauSize = $content[0];
        array_splice($content, 0, 1);
        $orders = [];
        for ($index = 0, $indexMax = count($content); $index < $indexMax; $index += 2) {
            $initialPosition = explode(' ', $content[$index]);
            $movements = str_split($content[$index + 1]);
            $orders[] = Mower::fromPrimitive(
                $initialPosition[0],
                $initialPosition[1],
                $initialPosition[2],
                $movements
            );
        }
        return [
            'plateau_size' => $plateauSize,
            'orders' => $orders
        ];
    }
}