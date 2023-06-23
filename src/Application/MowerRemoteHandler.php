<?php

namespace App\Application;


use App\Domain\Exceptions\MowerOutPlateauException;
use App\Domain\Mower;
use App\Domain\MowersRepository;
use App\Domain\Plateau;

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
            if (!$orders->plateau()->isInside($mower->coordinates())) {
                throw MowerOutPlateauException::withValue($orders->plateau()->maxRange());
            }
        }

        return MowerRemotePresenter::write($orders);
    }
}