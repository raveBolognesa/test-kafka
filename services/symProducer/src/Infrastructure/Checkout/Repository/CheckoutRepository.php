<?php
declare(strict_types=1);
namespace App\Infrastructure\Checkout\Repository;

use App\Domain\Checkout\Entity\Checkout;
use App\Domain\Checkout\Model\CheckoutModel;
use App\Domain\Checkout\Repository\CheckoutRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CheckoutRepository extends ServiceEntityRepository implements CheckoutRepositoryInterface
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Checkout::class);
    }

    public function save(CheckoutModel $checkoutModel): CheckoutModel
    {
        $checkout = new Checkout();
        $checkout->createFromModel($checkoutModel);
        $this->getEntityManager()->persist();
        // TODO: Implement save() method.
        return $checkoutModel;
    }
}