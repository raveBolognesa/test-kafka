<?php

namespace App\Domain\Checkout\Entity;

use App\Domain\Checkout\Model\CheckoutModel;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'checkout')]
class Checkout
{
    #[Id]
    #[GeneratedValue(strategy: 'SEQUENCE')]
    #[SequenceGenerator(sequenceName: 'message_seq', initialValue: 1, allocationSize: 100)]
    protected int $id;

    #[Column(length: 250)]
    private string $item;

    #[Column(name: 'time', type: Types::DATETIME)]
    private $time;

    public function createFromModel(CheckoutModel $checkoutModel): self
    {
        $this->item = $checkoutModel->getItem();
        $this->time = $checkoutModel->getTime();
        return $this;
    }

}