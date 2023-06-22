<?php

namespace App\Application;


use App\Domain\MowersRepository;

class MowerRemoteHandler
{
    public function __construct(private readonly MowersRepository $mowersRepository)
    {
    }

    public function __invoke(string $file): MowerRemotePresenter
    {
        $orders = $this->mowersRepository->findOrders($file);

        foreach ($orders->mowers() as $mower) {
            $mower->executeMovements();
        }

        return MowerRemotePresenter::write($orders);
    }
}