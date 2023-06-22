<?php

namespace App\Tests\Application;

use App\Application\MowerRemoteHandler;
use App\Infrastructure\Repository\FileRepository;
use PHPUnit\Framework\TestCase;

class MowerRemoteHandlerTest extends TestCase
{
    public function testShouldExecuteMovementsForAMower(): void
    {
        $handler = new MowerRemoteHandler(new FileRepository());
        $expectedResponse = [
            "1 3 N",
            "5 1 E"
        ];
        $response = $handler->__invoke('tests/Input.txt');

        self::assertEquals($expectedResponse, $response->read());
    }
}
