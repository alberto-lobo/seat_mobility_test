<?php

namespace App\Tests\Acceptance\Infrastructure\Ui;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class MowerRemoteCommandTest extends KernelTestCase
{
    public function testShouldFailWithInvalidInput(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('mower:send-movement');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'file' => __DIR__ . '/test.txt'
        ]);
        $commandTester->assertCommandIsSuccessful();
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('1 3 N', $output);
        $this->assertStringContainsString('5 1 E', $output);
    }
}
