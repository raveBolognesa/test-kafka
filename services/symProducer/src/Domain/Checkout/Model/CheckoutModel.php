<?php

namespace App\Domain\Checkout\Model;

use App\Domain\Checkout\Entity\Checkout;
use App\Domain\Checkout\Request\CheckoutRequest;
use Symfony\Component\HttpFoundation\Request;

class CheckoutModel
{
    public const TIME_FORMAT = 'Y-d-s H:i:s';

    public function __construct(
        private string $item,
        private \DateTime $time,
    ) {

    }


    /**
     * @return \DateTime
     */public function getTime(): \DateTime
    {
        return $this->time;
    }

    /**
     * @return string
     */
    public function getItem(): string
    {
        return $this->item;
    }



    /**
     * @return string
     */
    public function getTimeFormatted(): string
    {
        $time = clone $this->getTime();

        return $time->format(self::TIME_FORMAT);
    }

    public static function fromRequest(CheckoutRequest $request): self
    {
        return new self($request->getItem(), $request->getTime());
    }


    public static function fromEntity(Checkout $checkout): self
    {
        return new self($checkout->getItem(), $checkout->getTime());
    }


}