<?php
declare(strict_types=1);
namespace App\Infrastructure\Checkout\Repository;

use App\Domain\Checkout\Entity\Checkout;
use App\Domain\Checkout\Model\CheckoutModel;
use App\Domain\Checkout\Repository\CheckoutRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Checkout>
 *
 * @method Checkout|null find($id, $lockMode = null, $lockVersion = null)
 * @method Checkout|null findOneBy(array $criteria, array $orderBy = null)
 * @method Checkout[]    findAll()
 * @method Checkout[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CheckoutRepository extends ServiceEntityRepository implements CheckoutRepositoryInterface
{

    public function __construct(ManagerRegistry $registry, string $entityClass= Checkout::class)
    {
        parent::__construct($registry, $entityClass);
    }

    public function save(CheckoutModel $checkoutModel): CheckoutModel
    {
        $checkout = new Checkout();
        $checkoutEntity= $checkout->createFromModel($checkoutModel);
        $this->getEntityManager()->persist($checkoutEntity);
        $this->getEntityManager()->flush();
        return $checkoutModel;
    }
}