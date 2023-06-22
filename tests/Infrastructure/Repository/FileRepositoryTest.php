<?php

namespace App\Tests\Infrastructure\Repository;

use App\Domain\Mower;
use App\Infrastructure\Repository\FileRepository;
use PHPUnit\Framework\TestCase;

class FileRepositoryTest extends TestCase
{
    private FileRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new FileRepository();
    }


    public function testCreateMowersFromRawData(): void
    {
        $path = __DIR__ . "/test.txt";
        $orders = $this->repository->findOrders($path);

        self::assertEquals('5 5', $orders['plateau_size']);

        foreach ($orders['orders'] as $order) {
            self::assertInstanceOf(Mower::class, $order);
        }
    }
}
