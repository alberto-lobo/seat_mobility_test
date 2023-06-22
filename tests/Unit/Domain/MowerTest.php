<?php

namespace App\Tests\Unit\Domain;

use App\Domain\Movement;
use App\Domain\Mower;
use App\Domain\Orientation;
use PHPUnit\Framework\TestCase;

class MowerTest extends TestCase
{
    public function testGivenOrderToMoveShouldReturnNextPosition(): void
    {
        $x = 0;
        $y = 0;
        $orientation = 'N';
        $mower = Mower::fromPrimitive($x, $y, $orientation, []);

        $mower->nextPosition(Movement::M);
        self::assertEquals($y + 1, $mower->coordinates()->y());
        $mower->nextPosition(Movement::L);
        self::assertEquals(Orientation::W, $mower->orientation());
        $mower->nextPosition(Movement::R);
        self::assertEquals(Orientation::N, $mower->orientation());
    }
}
