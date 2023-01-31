<?php

namespace App\Domain\Checkout\Response;

class CheckoutResponse
{
    public function __construct(
        private string $item,
        private \DateTime $time,
    ) {}

    public function toArray(): array
    {
        return [
            'item' => $this->item,
            'time' => $this->time
        ];
    }
}