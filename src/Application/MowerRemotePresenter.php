<?php

namespace App\Application;

use App\Domain\DTO\Orders;

class MowerRemotePresenter
{
    private function __construct(private readonly Orders $orders)
    {
    }

    public static function write(Orders $orders): self
    {
        return new static($orders);
    }

    public function read(): array
    {
        $data = [];
        foreach ($this->orders->mowers() as $order) {
            $data[] = $order->coordinates()->x() . " " . $order->coordinates()->y() . " " . $order->orientation()->value;
        }
        return $data;
    }
}