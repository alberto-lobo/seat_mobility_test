<?php

namespace App\Tests\Acceptance\Infrastructure\Ui;

use App\Domain\Exceptions\NegativeCoordinatesException;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class MowerRemoteCommandTest extends KernelTestCase
{
    public function testShouldReturnMowersCoordinates(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('mower:send-movement');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'file' => 'tests/Input.txt'
        ]);
        $commandTester->assertCommandIsSuccessful();
    }

    public function testGivenInvalidCoordinatesShouldThrowNegativeCoordinatesException(): void
    {
        $this->expectException(NegativeCoordinatesException::class);
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('mower:send-movement');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'file' => 'tests/InputWithNegativeCoordinates.txt'
        ]);
    }
}
