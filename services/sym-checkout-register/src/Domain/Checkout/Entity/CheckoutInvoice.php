<?php
declare(strict_types=1);
namespace App\Domain\Checkout\Entity;

use App\Infrastructure\Checkout\Repository\CheckoutInvoiceRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;
use Doctrine\Persistence\ManagerRegistry;

#[ORM\Entity(repositoryClass: CheckoutInvoiceRepository::class)]
#[Table(name: 'checkout_invoice')]
class CheckoutInvoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $amount;

    #[ORM\Column]
    private string $item;

    public function createFromData(string $item,
    ): self {
        $this->item = $item;
        $this->amount = strlen($item);
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getItem(): string
    {
        return $this->item;
    }

}
