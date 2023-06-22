<?php

namespace App\Tests\Shared\Domain;

use App\Shared\Domain\Coordinates;
use PHPUnit\Framework\TestCase;

class CoordinatesTest extends TestCase
{

    public function testMoveCoordinatesToEast(): void
    {
        $x = '2';
        $y = '4';
        $coordinates = Coordinates::fromString($x, $y);
        $coordinates->moveToEast();
        self::assertEquals((int)$x + 1, $coordinates->x());
    }
    public function testMoveCoordinatesToWest(): void
    {
        $x = '2';
        $y = '4';
        $coordinates = Coordinates::fromString($x, $y);
        $coordinates->moveToWest();
        self::assertEquals((int)$x - 1, $coordinates->x());
    }
    public function testMoveCoordinatesToNorth(): void
    {
        $x = '2';
        $y = '4';
        $coordinates = Coordinates::fromString($x, $y);
        $coordinates->moveToNorth();
        self::assertEquals((int)$y + 1, $coordinates->y());
    }
    public function testMoveCoordinatesToSouth(): void
    {
        $x = '2';
        $y = '4';
        $coordinates = Coordinates::fromString($x, $y);
        $coordinates->moveToSouth();
        self::assertEquals((int)$y - 1, $coordinates->y());
    }
}
