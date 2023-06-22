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
            foreach ($mower->movements()->items() as $movement) {
                $mower->nextPosition($movement);
            }
        }

        return MowerRemotePresenter::write($orders);
    }
}