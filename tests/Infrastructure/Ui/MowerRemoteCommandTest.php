<?php

namespace App\Tests\Infrastructure\Ui;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class MowerRemoteCommandTest extends KernelTestCase
{
    public function testShouldFailWithInvalidInput() : void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('mower:send-movement');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);

        $commandTester->assertCommandIsSuccessful();

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Enter the orders: ', $output);
        $this->assertStringContainsString('1 3 N\n5 1 E', $output);
    }
}
