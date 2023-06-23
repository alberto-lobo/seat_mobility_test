<?php

namespace App\Tests\Unit\Application;

use App\Application\MowerRemoteHandler;
use App\Domain\Exceptions\MowerOutPlateauException;
use App\Infrastructure\Repository\FileRepository;
use PHPUnit\Framework\TestCase;

class MowerRemoteHandlerTest extends TestCase
{
    private MowerRemoteHandler $handler;
    protected function setUp(): void
    {
        $this->handler = new MowerRemoteHandler(new FileRepository());
    }

    public function testShouldExecuteMovementsForAMower(): void
    {
        $expectedResponse = [
            "1 3 N",
            "5 1 E"
        ];
        $response = $this->handler->__invoke('tests/Input.txt');

        self::assertEquals($expectedResponse, $response->read());
    }

    public function testGivenMowerOutOfPlateauRangeShouldThrowException(): void
    {
        $this->expectException(MowerOutPlateauException::class);

        $this->handler->__invoke('tests/InputWithSmallPlateau.txt');
    }
}
