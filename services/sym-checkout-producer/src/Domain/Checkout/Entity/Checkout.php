<?php

namespace App\Domain\Checkout\Entity;

use App\Domain\Checkout\Model\CheckoutModel;
use App\Infrastructure\Checkout\Repository\CheckoutRepository;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping as ORM;

#[Entity(repositoryClass: CheckoutRepository::class, readOnly: false)]
#[Table(name: 'checkout')]
class Checkout
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected int $id;

    #[ORM\Column]
    private string $item;

    #[ORM\Column]
    private \DateTime $time;

    public function createFromModel(CheckoutModel $checkoutModel): self
    {
        $this->item = $checkoutModel->getItem();
        $this->time = $checkoutModel->getTime();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getItem(): string
    {
        return $this->item;
    }

}